<?php
namespace Deployer;
require 'recipe/laravel.php';

// Project name
set('application', 'api');

// Project repository
set('repository', 'https://github.com/timurlatypov/chito-ra-api.git');
// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);
// Writable dirs by web server
add('writable_dirs', []);

// Hosts
set('default_stage', 'dev');
set('branch', 'master');

host('194.58.120.209')
	->user('root')
	->identityFile('~/.ssh/id_rsa_chitora')
	->set('deploy_path', '/var/www/api/prod')
	->set('master', 'master')
	->stage('prod');

host('194.58.120.209')
	->user('root')
	->identityFile('~/.ssh/id_rsa_chitora')
	->set('deploy_path', '/var/www/api/dev')
	->set('master', 'master')
	->stage('dev');

set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --no-scripts');
set('keep_releases', 15);
set('cleanup_use_sudo', true);
// Tasks
task('build', function () {
	run('cd {{release_path}} && build');
});
desc('Composer dump autoload');
task('composer:dump:autoload', function () {
	run('cd {{release_path}} && composer dump-autoload');
});
task('reload:php-fpm', function () {
	run('sudo service php7.3-fpm restart');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');
