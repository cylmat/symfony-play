SHELL := /bin/bash

##########################
# Php Quality Assurance  #
#  @see https://phpqa.io #
##########################

define all-scripts
	make all-fix
	make all-linters
	@echo -e "\033[1;32m------------\n- All good -\n------------ \033[0m"
endef

all-lints:
	@$(call all-scripts)

.PHONY: all-fix all-linters all-builds

### Test config from host
# docker run --rm -it -v tmpvar:/var/www php:7.4-fpm sh -c "apt update && apt install -y git rsync unzip && bash"
###

###########
# RUN ALL #
###########

all-builds:
#   make phing
	@make npm-build

watch: npm run watch

cache:
	rm var/cache/* -rf
	bin/console cache:clear

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
