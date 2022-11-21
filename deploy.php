<?php

/**
 *  Deployer
 * @see https://deployer.org
 *
 * Usage:
 * - bin/dep deploy prod --hosts prod:pre:local --roles build,test_role
 * - bin/dep ssh
 * - bin/dep rollback
 */

namespace Deployer;

require 'recipe/common.php';

/**
 * Read .env files
 * Priority: Environment, .deploy.local, .deploy, .deploy.dist
 */
foreach ([__DIR__ . '/.env.deploy.local', __DIR__ . '/.env.deploy', __DIR__ . '/.env.deploy.dist'] as $env) {
    if (\file_exists($env) && $env = new \SplFileObject($env)) {
        foreach ($env as $line) {
            if (
                preg_match('/^((VCS_|REMOTE_|LOCAL_).+)\=(.+)/', $line, $match)
                && !getenv($match[1])
            ) {
                putenv($match[0]);
            }
        }
    }
}

if (!(
($VCS_REPOSITORY   = trim($_ENV['VCS_REPOSITORY'] ?? getenv('VCS_REPOSITORY')) ?? null) &&
($VCS_BRANCH_NAME  = trim($_ENV['VCS_BRANCH_NAME'] ?? getenv('VCS_BRANCH_NAME') ?? 'main')) &&
($REMOTE_USER      = trim($_ENV['REMOTE_USER'] ?? getenv('REMOTE_USER')) ?? null) &&
($REMOTE_HOST      = trim($_ENV['REMOTE_HOST'] ?? getenv('REMOTE_HOST')) ?? null) &&
($REMOTE_DIRECTORY = trim($_ENV['REMOTE_DIRECTORY'] ?? getenv('REMOTE_DIRECTORY')) ?? null) &&
($LOCAL_SSH_KEY    = trim($_ENV['LOCAL_SSH_KEY'] ?? getenv('LOCAL_SSH_KEY')) ?? null)
 )) {
    throw new \Exception("Impossible to find all constants, neither in .env.deploy(.local) file nor in environment.");
 }

/*** COMMON PARAMS ***/

// Project //
set('repository', $VCS_REPOSITORY);
set('branch', $VCS_BRANCH_NAME);
set('deploy_path', $REMOTE_DIRECTORY);

// Stage //

/** If deployed with https, it must contains https://user:vcs_api_key@<vcs>/<vendor>/<repo>.git */
// Make sur you add Ssh public key in "SSH" section or repository's "Deploy key" of vcs
// Test Ssh with "ssh -T git@github.com"
set('shared_dirs', ['node_modules', 'vendor', 'var']);

// others //
set('clear_paths', []);
set('copy_dirs', []);
set('env', []);
set('keep_releases', 10);

/*** SPECIFIC HOST STAGES ***/

host($REMOTE_HOST)
    // Can be used with "bin/dep deploy stage=prod".
    ->setLabels(['stage' => 'prod'])
    ->setRemoteUser($REMOTE_USER)
    ->setIdentityFile($LOCAL_SSH_KEY)
    ->setForwardAgent(true)
;

/*** CUSTOM TASKS ***/

task('local:upload', function () {
    upload(__DIR__ . "/", '{{release_path}}');
});

task('commit:hash', function () {
    cd('{{release_path}}');
    run("echo $(git rev-parse HEAD) > ./public/COMMIT_ID");
});

task('vendors', function () {
    $php_bin_path = '/usr/local/php7.4/bin/php';
    cd('{{release_path}}');
    run("$php_bin_path bin/composer install --no-dev --no-scripts --no-plugins");
});

task('cache:clear', function () {
    $php_bin_path = '/usr/local/php7.4/bin/php';
    cd('{{release_path}}');
    run("rm ./var/cache/* -rf");
    //run("$php_bin_path bin/console cache:clear --env=prod");
    //run("$php_bin_path bin/composer dump-autoload");
});

task('build', function () {
    cd('{{release_path}}');
    run('npm install');
});

/*** RUN TASKS ***/

# @see https://deployer.org/docs/7.x/recipe/symfony
desc('Deploy your project');
task('deploy', [
    # Run info,setup,lock,release,update_code,shared,writable
    'deploy:prepare',

    'vendors',
    'cache:clear',

    # Run symlink,unlock,cleanup,success
    'deploy:publish',
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
fail('deploy:release', 'deploy:unlock');
