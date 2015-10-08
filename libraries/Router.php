<?php
require './database.php';

    function router($controller,$action,$query_data="") {
    $param = is_array($query_data) ? http_build_query($query_data) : "$query_data";
    $url = APP_URL."index.php?controller=$controller&action=$action&$param";
    return $url;
}
    function relativeRouter ($controller,$action,$query_data=""){
    $param = is_array($query_data) ? http_build_query($query_data) : "$query_data";
    $url = "index.php?controller=$controller&action=$action&$param";
    return $url;
}
    function redirectToOriginalUrl() {
        $url = $_SERVER['HTTP_REQUEST_URI'];
        header("location: $url");
    }
    
    function switchAction ($controller, $action) {
        $r = router($controller, $action);
        header("location:$r", true, 302);
    }
