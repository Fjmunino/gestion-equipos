<?php

use Controller\AdministrationController;
use Controller\PublicController;

include 'config.php';
include 'controller/PublicController.php';
include 'controller/AdministrationController.php';

session_start();

$url = $_SERVER["REQUEST_URI"];
$uriRequest = ltrim(str_replace(BASE, '', $url), '/');
$route = explode('/', $uriRequest);


if(empty($route[0])){
    $controller = new PublicController();
    $controller->home();
}else{
    switch($route[0]){
        case 'administration':
            $controller = new AdministrationController();
            if(isset($route[1])){
                $method = lcfirst(str_replace('-','',ucwords($route[1], '-')));
                if(isset($route[2])){
                    $controller->$method($route[2]);
                }else{
                    $controller->$method();
                }
                break;
            }
            $controller->index();
            break;
        case 'futbol':
            $controller = new PublicController();
            if(isset($route[1])){
                $method = lcfirst(str_replace('-','',ucwords($route[1], '-')));
                if(isset($route[2])){
                    $controller->$method($route[2]);
                }else{
                    $controller->$method();
                }
                break;
            }
            $controller->futbol();
            break;
        case 'baloncesto':
            $controller = new PublicController();
            if(isset($route[1])){
                $method = lcfirst(str_replace('-','',ucwords($route[1], '-')));
                if(isset($route[2])){
                    $controller->$method($route[2]);
                }else{
                    $controller->$method();
                }
                break;
            }
            $controller->baloncesto();
            break;
        case 'rugby':
            $controller = new PublicController();
            if(isset($route[1])){
                $method = lcfirst(str_replace('-','',ucwords($route[1], '-')));
                if(isset($route[2])){
                    $controller->$method($route[2]);
                }else{
                    $controller->$method();
                }
                break;
            }
            $controller->rugby();
            break;
        case 'waterpolo':
            $controller = new PublicController();
            if(isset($route[1])){
                $method = lcfirst(str_replace('-','',ucwords($route[1], '-')));
                if(isset($route[2])){
                    $controller->$method($route[2]);
                }else{
                    $controller->$method();
                }
                break;
            }
            $controller->waterpolo();
            break;
        default:
            echo "404 - Recurso no encontrado";
            break;
    }
}