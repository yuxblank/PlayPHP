<?php
error_reporting( E_ALL & ~( E_NOTICE | E_STRICT | E_DEPRECATED ) );
include_once 'controller/Frontend.php';
include_once 'PlayPHP/class/Router.php';
include_once 'PlayPHP/class/http/Request.php';
//require 'libraries/Router.php';
/*
 * ** ROUTING SETTINGS **
 */
$app_root = $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["PHP_SELF"])."/";
$app_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
define("APP_URL",$app_url);
define("APP_ROOT",$app_root);


$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1));
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));


    $root = ltrim ($uri, '/');
    //$paths = explode("/", $uri);
    $paths = parse_url($root, PHP_URL_PATH);
    $route = explode("/",$paths);
    $request = new Request();
        
$redirect = Router::findAction($paths);
if ($redirect) {

    $rest = $_SERVER['REQUEST_METHOD'];
    switch ($rest) {
        case 'PUT':
            //rest_put($request);
            break;
        case 'POST':
            if (Router::checkRoutes($redirect->action, "POST")) {
                foreach ($_POST as $name => $value) {
                    $request->setPost($name,$value);
                }
                break;
              
            } else {
                Router::notFound($redirect->action,"POST");
            }
        break;
        case 'GET':
            if (Router::checkRoutes($redirect->action, "GET")) {
               //preg_match("[\d-aA-zZ\/]+", $app_root); // drop {}
                    
                for ($i = 1; $i < count($route); $i++) {
                    // TODO odd routes should trow an exception
                    $request->setGet($route[$i], $route[++$i]);
           
                }
                break;
                
            } else {
                Router::notFound($redirect->action,"GET");
            }
            break;
        case 'HEAD':
            //rest_head($request);
            break;
        case 'DELETE':
            //rest_delete($request);
            break;
        case 'OPTIONS':
            //rest_options($request);
            break;
        default:
            //rest_error($request);
            break;
    }

    
    $c = Router::inverseRoute($redirect);
 
    if($redirect) {
    include_once APP_ROOT.'controller/'.$c[0].'.php';
    $controller = new $c[0]();
    $controller->$c[1]($request);
    }
} else {
    Router::notFound($route[0], "GET");
}

