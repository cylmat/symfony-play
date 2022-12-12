SHELL := /bin/bash

##########################
# Php Quality Assurance  #
#  @see https://phpqa.io #
##########################

define all-scripts
	make all-fix
	make all-linters
	make all-behav
	@echo -e "\033[1;32m------------\n- All good -\n------------ \033[0m"
endef

all-lints:
	@$(call all-scripts)

.PHONY: install-all-bin composer-install-dev all-fix all-linters all-behav all-builds grump

### Test config from host
# docker run --rm -it -v tmpvar:/var/www php:7.4-fpm sh -c "apt update && apt install -y git rsync unzip && bash"
###

	
###########
# RUN ALL #
###########

all-fix:
	make csfixer
# make cbf

.PHONY: lints all-lints all-linters
lints: 
	@make all-linters
all-lints: 
	@make all-linters
all-linters:
	make paralint
	make cpd
	make cs
	make md
	make stan
#	make phan
# make psalm
	@echo -e "\033[1;32m------------\n- All good -\n------------ \033[0m"

all-behav:
	make codecept
	make phpspec
	@echo -e "\033[1;32m------------\n- All good -\n------------ \033[0m"

.PHONY: build all-builds
build:
	@make all-builds
all-builds:
#   make phing
	@make npm-build

watch: npm run watch

cache:
	rm var/cache/* -rf
	bin/console cache:clear

###########
# GRUMPHP #
# @see https://github.com/phpro/grumphp
###########

grump: 
	bin/grumphp run
	@echo -e "\033[1;32m------------\n- All good -\n------------ \033[0m"

grump-tasks:
	bin/grumphp run --tasks=$(ts)

############
# BEHAVIOR #
############

behat:
#	@[ -f features/bootstrap/FeatureContext.php ] || bin/behat --init
	bin/behat -c behat.yml

# @see https://codeception.com
codecept:
	bin/codecept run -c tools/test/codeception.yml
	@echo -e "\033[1;32mAll good \033[0m"

spec:
	@make phpspec
.PHONY: spec

# @see http://phpspec.net
phpspec:
	bin/phpspec run --config=tools/test/phpspec.yml
	@echo -e "\033[1;32mAll good \033[0m"

# @see https://docs.behat.org
# behat:

##########
# FIXERS #
# Please use one or other to avoid conflicts
##########

# @see https://cs.symfony.com
csfixer:
	bin/php-cs-fixer fix --config tools/linter/.php-cs-fixer.php -v
	@echo -e "\033[1;32mAll good \033[0m"

# @see https://github.com/squizlabs/PHP_CodeSniffer
cbf:
	bin/phpcbf --colors --standard=tools/linter/phpcs.xml -v

###########
# LINTERS #
###########

# @see https://github.com/php-parallel-lint/PHP-Parallel-Lint
paralint:
	bin/parallel-lint src --exclude vendor

# @see https://github.com/sebastianbergmann/phpcpd
cpd:
	bin/phpcpd src

# @see https://squizlabs.github.io/HTML_CodeSniffer
cs:
	bin/phpcs --colors --standard=tools/linter/phpcs.xml -s

# @see https://phpmd.org
md:
	bin/phpmd src ansi tools/linter/phpmd.xml --reportfile=STDOUT

# @see https://phpstan.org
stan:
	bin/phpstan analyse --level 8 --configuration tools/linter/phpstan.neon --memory-limit 2G

# @see https://github.com/phan/phan/wiki
# --allow-polyfill-parser avoid to use ast-ext
phan: 
	PHAN_ALLOW_XDEBUG=0 bin/phan --config-file tools/linter/phan.config.php --allow-polyfill-parser

# Caution: can be slow
# @see https://psalm.dev
psalm:
	bin/psalm -c tools/linter/psalm.xml --memory-limit=2G --threads=4

############
# BUILDING #
############

# @see https://www.phing.info
phing:
	bin/phing -f tools/build.xml

#############
# STRUCTURE #
#############

structure:
	mkdir -p ../shared	
	mkdir -p ./var 		    && mv ./var ../shared/ 		    && ln -s ../shared/var ./var
	mkdir -p ./vendor       && mv ./vendor ../shared/       && ln -s ../shared/vendor ./vendor
	mkdir -p ./node_modules && mv ./node_modules ../shared/ && ln -s ../shared/node_modules ./node_modules

##########
# DEPLOY #
##########

# @see https://deployer.org
npm-build:
	npm run build
.PHONY: npm-build

# @see https://deployer.org
deploy:
	bin/deployer deploy -f tools/deployer.yaml -vvv

#######
# SSH #
#######
ssh-memo:
	@echo -e "\n\033[1;34mUse following to create an ed25519 ssh key:\033[0m"
	@echo -e "apt update && apt install -y ssh"
	@echo -e 'ssh-keygen -t ed25519 -C "your_email@example.com"'
	@echo 'eval "$$(ssh-agent -s)"'
	@echo "ssh-add ~/.ssh/id_ed25519"
	@echo -e "\n\033[1;34mUse following to send an ssh key on remote host:\033[0m"
	@echo -e "ssh-copy-id -i ~/.ssh/id_ed25519.pub user@remote-host.com \n"
.PHONY: ssh-memo
