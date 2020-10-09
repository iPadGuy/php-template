<?php # config.inc.php

date_default_timezone_set('America/Toronto');
define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/***** Project Settings *****/
$appTitle = "Patrick is a Techie";
$time = date("l, F jS, Y  H:i:s  P T");

// Errors are emailed here:
$contact_email = 'patrick@localhost';

// Determine whether we're working on a local server
// or on the real server:
$root = pathinfo($_SERVER['SCRIPT_FILENAME']);
$host = (PHP_SAPI != 'cli') ? substr($_SERVER['HTTP_HOST'], 0, 5);
if (!isset($host) {
	$local = TRUE
} elseif (in_array($host, array('local', '127.0', '192.1'))) {
	$local = TRUE;
} else {
	$local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

	// Always debug when running locally:
	$debug = TRUE;

	// Define the constants:
	define('BASE_FOLDER', 	basename($root['dirname']));
	define('BASE_URI', 		realpath(dirname(__FILE__)));
	define('BASE_URL', 		'http://'.$_SERVER['HTTP_HOST'].'/'.BASE_FOLDER);
	define('BASE_URI2', 	'/path/to/html/folder/');
	define('BASE_URL2', 	'http://localhost/directory/');
	define('DBCONFIG', 		'configs/pdo-twitter.inc.php');
	// define('SESSCONFIG',	'includes/session.inc.php');
} else {
	define('BASE_FOLDER', 	basename($root['dirname']));
	define('BASE_URI', 		realpath(dirname(__FILE__)));
	define('BASE_URL', 		'http://'.$_SERVER['HTTP_HOST'].'/'.BASE_FOLDER);
	define('BASE_URI2', 	'/path/to/live/html/folder/');
	define('BASE_URL2', 	'http://www.example.com/');
	define('DBCONFIG', 		'include/db-config.inc.php');
	// define('SESSCONFIG',	'includes/session.inc.php');
}

/*
 *  Most important setting!
 *  The $debug variable is used to set error management.
 *  To debug a specific page, add this to the index.php page:

if ($p == 'thismodule') $debug = TRUE;
require('./includes/config.inc.php');

 *  To debug the entire site, do

$debug = TRUE;

 *  before this next conditional.
 */

// Assume debugging is off.
if (!isset($debug)) {
	$debug = FALSE;
}

/***** Error Management *****/

require_once('PhpConsole/__autoload.php');		// PHP Console

require_once('includes/error-mgmt.inc.php');	// Error Management

require_once(DBCONFIG);							// Database configuration

// require_once(SESSCONFIG);					// Session Configuration

require_once('includes/utilities.inc.php');		// Utilities

// Call debug from PhpConsole\Handler
$handler = PhpConsole\Handler::getInstance();
// $handler->setPassword('jewel74', true);
$handler->start();
// $handler->debug('called from handler debug', 'some.three.tags');

/*
// Call debug from PhpConsole\Connector (if you don't use PhpConsole\Handler in your project)
PhpConsole\Connector::getInstance()->getDebugDispatcher()->dispatchDebug('called from debug dispatcher without tags');

// Call debug from global PC class-helper (most short & easy way)
PhpConsole\Helper::register(); // required to register PC class in global namespace, must be called only once
PC::debug('called from PC::debug()', 'db');
PC::db('called from PC::__callStatic()'); // means "db" will be handled as debug tag
*/


/***** Path Names *****/

/* echo '<div class="debugInfo"><pre>$root'.EOL
	.'__FILE__        => '.__FILE__.EOL
	.'BASE_FOLDER     => '.BASE_FOLDER.EOL
	.'BASE_URI        => '.BASE_URI.EOL
	.'BASE_URL        => '.BASE_URL.EOL
	.'BASE_URI2       => '.BASE_URI2.EOL
	.'BASE_URL2       => '.BASE_URL2.EOL
	.'DBCONFIG        => '.DBCONFIG.EOL
	.'</pre></div>';
*/

// $handler->debug('$root', $root);
$handler->debug(__FILE__, 		'__FILE__'		);
$handler->debug(BASE_FOLDER, 	'BASE_FOLDER'	);
$handler->debug(BASE_URI, 		'BASE_URI'		);
$handler->debug(BASE_URL, 		'BASE_URL'		);
$handler->debug(BASE_URI2, 		'BASE_URI2'		);
$handler->debug(BASE_URL2, 		'BASE_URL2'		);
$handler->debug(DBCONFIG, 		'DBCONFIG'		);

?>
