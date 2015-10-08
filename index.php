<?php
require 'controller/Frontend.php';
require 'Class/Router.php';

//require 'libraries/Router.php';
/*
 * ** ROUTING SETTINGS **
 */
$app_root = $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["PHP_SELF"])."/";
$app_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
define("APP_URL",$app_url);
define("APP_ROOT",$app_root);


$routes = json_decode(file_get_contents(APP_ROOT.'config/routes.json'));
print_r($routes);



$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1));
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
//echo $uri;
if ($uri == "/") {
    $frontend = new Frontend();
    $frontend->index();
} else {
    $root = ltrim ($uri, '/');
    //$paths = explode("/", $uri);
    $paths = parse_url($root, PHP_URL_PATH);
    $route = explode("/",$paths);
    $request = new \PlayPhp\Classes\Request();
    for ($i=2; $i<count($route);$i++) {
            $request->setGet($route[$i], $route[++$i]);
    }

    if ($_POST) {
        foreach ($_POST as $name => $value) {
            $request->setPost($name,$value);
        }
    }
    $c = $route[0];
    $a = $route[1];
    include_once APP_ROOT.'controller/'.$c.'.php';
    $controller = new $c();
    $controller->$a();

    
}
