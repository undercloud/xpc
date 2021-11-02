<?php

if (stripos(PHP_OS, 'WIN') !== false) {
	define('XPC_OS', 'WIN');
} elseif (stripos(PHP_OS, 'DAR') !== false) {
	define('XPC_OS', 'MAC');
} elseif (stripos(PHP_OS, 'LINUX') !== false) {
	define('XPC_OS', 'LINUX');
} else {
	define('XPC_OS', 'UNKNOWN');
}

if (XPC_OS === 'LINUX') {
	define('XPC_COLORIZE_ENABLED', true);
} else {
	define('XPC_COLORIZE_ENABLED', false);
}

if (false === defined('XPC_PHP_EOL'))   { define('XPC_PHP_EOL', PHP_EOL); }
if (false === defined('XPC_PHP_CR'))    { define('XPC_PHP_CR', "\r"); }
if (false === defined('XPC_TERM_SIZE')) { define('XPC_TERM_SIZE', 76); }
if (false === defined('XPC_PADDING'))   { define('XPC_PADDING', 4); }

if (false === defined('XPC_OK'))   { define('XPC_OK',   1); }
if (false === defined('XPC_FAIL')) { define('XPC_FAIL', 2); }
if (false === defined('XPC_INFO')) { define('XPC_INFO', 3); }
if (false === defined('XPC_WARN')) { define('XPC_WARN', 4); }

foreach (array('class', 'function') as $dir) {
	foreach (glob(__DIR__ . "/{$dir}/*.php") as $path) {
		require_once $path;
	}
}