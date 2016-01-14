<?php

/*
 * ** DB SETTINGS **
 */
define("DB_DRIVER", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "FlowSign");
define("DB_USER", "root");
define("DB_PSW", "");
define("DB_OPTIONS", "");
/*
 * ** DB 2 SETTINGS **
 */
define("DB2_DRIVER", "mysql");
define("DB2_HOST", "localhost");
define("DB2_NAME", "JoomlaOne");
define("DB2_USER", "root");
define("DB2_PSW", "");
define("DB2_OPTIONS", "");

/*
 * ** ROUTING SETTINGS **
 */
$app_root = $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["PHP_SELF"])."/";
$app_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
define("APP_URL",$app_url);
define("APP_ROOT",$app_root);

/**
 * ** Template Settings
 */
define ("TEMPLATE", "core");

/**
 * ** DEBUG **
 */
$debug = true;
define('APP_DEBUG', $debug);
if ($debug) {
    require '../libraries/3rdparty/kint/Kint.classes.php';
//    Kint::dump( $_SERVER );
    // or, even easier, use a shorthand:
//    d( $_SERVER );
    // or, to seize execution after dumping use dd();
//    dd( $_SERVER ); // same as d( $_SERVER ); die; 
    // to see trace:
//    Kint::trace();
    // or pass 1 to a dumper function
//    Kint::dump( 1 );
    // to disable all output
//    Kint::enabled(true);
    // further calls, this one included, will not yield any output
    //    d('Get off my lawn!'); // no effect
}