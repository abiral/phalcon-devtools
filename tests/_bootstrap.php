<?php

error_reporting(-1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
setlocale(LC_ALL, 'en_US.utf-8');

date_default_timezone_set('UTC');

if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('utf-8');
}
if (function_exists('mb_substitute_character')) {
    mb_substitute_character('none');
}

clearstatcache();

$root = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

defined('TESTS_PATH')   || define('TESTS_PATH', $root);
defined('PROJECT_PATH') || define('PROJECT_PATH', dirname(TESTS_PATH) . DIRECTORY_SEPARATOR);
defined('PATH_DATA')    || define('PATH_DATA', $root .  '_data' . DIRECTORY_SEPARATOR);
defined('PATH_CACHE')   || define('PATH_CACHE', $root . '_cache' . DIRECTORY_SEPARATOR);
defined('PATH_OUTPUT')  || define('PATH_OUTPUT', $root .  '_output' . DIRECTORY_SEPARATOR);
defined('PATH_FIXTURES')|| define('PATH_FIXTURES', $root .  '_fixtures' . DIRECTORY_SEPARATOR);

require_once $root .
    DIRECTORY_SEPARATOR . '_ci' .
    DIRECTORY_SEPARATOR . 'functions.php';

unset($root);

require_once PROJECT_PATH . 'vendor/autoload.php';
require_once TESTS_PATH . 'shim.php';

if (extension_loaded('xdebug')) {
    ini_set('xdebug.cli_color', 1);
    ini_set('xdebug.collect_params', 0);
    ini_set('xdebug.dump_globals', 'on');
    ini_set('xdebug.show_local_vars', 'on');
    ini_set('xdebug.max_nesting_level', 100);
    ini_set('xdebug.var_display_max_depth', 4);
}

$defaults = [
    // Postgresql
    "TEST_DB_POSTGRESQL_HOST"   => '127.0.0.1',
    "TEST_DB_POSTGRESQL_PORT"   => 5432,
    "TEST_DB_POSTGRESQL_USER"   => 'postgres',
    "TEST_DB_POSTGRESQL_PASSWD" => '',
    "TEST_DB_POSTGRESQL_NAME"   => 'devtools',
    "TEST_DB_POSTGRESQL_SCHEMA" => 'public',
];

foreach ($defaults as $key => $defaultValue) {
    if (defined($key)) {
        continue;
    }

    $value = getenv($key) ?: $defaultValue;

    define($key, $value);
}
