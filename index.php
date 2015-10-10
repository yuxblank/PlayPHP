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




//$r = Router::getInstance();
//print_r($r);
echo "<br><br>";
//print_r($r->routes[0]->method);


Router::checkRoutes("Frontend@blog", "GET");


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
    // controller
    $c = $route[0];
    // action
    $a = $route[1];

    $reverse = Router::inverseRoute($c,$a);

    $rest = $_SERVER['REQUEST_METHOD'];
    switch ($rest) {
        case 'PUT':
            //rest_put($request);
            break;
        case 'POST':
            if (Router::checkRoutes($reverse, "POST")) {
                foreach ($_POST as $name => $value) {
                    $request->setPost($name,$value);
                }
                break;
            } else {
                Router::notFound($reverse,"POST");
            }
        case 'GET':
            if (Router::checkRoutes($reverse, "GET")) {
                for ($i = 2; $i < count($route); $i++) {
                    $request->setGet($route[$i], $route[++$i]);
                }
                break;
            } else {
                Router::notFound($reverse,"GET");
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



    include_once APP_ROOT.'controller/'.$c.'.php';
    $controller = new $c();
    $controller->$a($request);

    
}
