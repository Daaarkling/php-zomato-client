<?php

if (!@include __DIR__.'/../vendor/autoload.php') {
	echo 'Please install required components using "composer install".';
	exit(1);
}

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');
