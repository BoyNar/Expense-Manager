<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}

/**
 * Open Translation File
 * @return Response
*/
function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

/**
 * Save JSON File
 * @return Response
*/
function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('lang/'.$code.'.json'), stripslashes($jsonData));
}

?>
