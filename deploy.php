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
host('176.57.215.122')
	->user('root')
	->identityFile('~/.ssh/id_rsa_chitora_timeweb')
	->set('deploy_path', '/var/www/api/production')
	->set('branch', 'master')
	->stage('production');

set('default_stage', 'production');


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
