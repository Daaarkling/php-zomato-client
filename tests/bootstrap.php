<?php

if (!@include __DIR__.'/../vendor/autoload.php') {
	echo 'Please install required components using "composer install".';
	exit(1);
}

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

define('TMPDIR', '/temp/tests');

@mkdir(TMPDIR, 0777, true); // @ - base directory may already exist

register_shutdown_function(function () {
	Tester\Helpers::purge(TMPDIR);
	rmdir(TMPDIR);
});