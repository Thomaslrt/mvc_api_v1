<?php 
// Type de contenu à exploiter
header('Content-Type: application/json; charset=utf-8');
session_start();
error_reporting(E_ERROR | E_PARSE);

// Variables globales
define("MEDOO", 1);
define("DB_MANAGER", MEDOO);
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));

// Liste des fichiers à inclure
include_once ("./librairies/medoo/Medoo.php");
require_once "controllers/ErrorController.php";
require_once "controllers/VillesController.php";


try {
    if (empty($_GET['page'])) {
        $controller = new ErrorController();
        $controller->index();
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case "index":
                $controller = new ErrorController();
                $controller->index();
                break;

            case "ville":
                // Récupère le code postal via le premier paramètre passé dans l'url
                $code_postal = $url[1] ;
                // Définie si .../update est demandé ou non
                $update = $url[2] ;
                $controller = new VillesController();
                $controller->ville($code_postal, $update);
                break;

            case "villes":
                // Récupère le département via le premier paramètre passé dans l'url
                $departement = $url[1] ;
                // Récupère le canton via le premier paramètre passé dans l'url
                $canton = $url[2] ;
                $controller = new VillesController();
                $controller->villes($departement, $canton);
                break;

            case "superficie":
                // Récupère le code postal via le premier paramètre passé dans l'url
                $code_postal = $url[1] ;
                $controller = new VillesController();
                $controller->superficie($code_postal);
                break;

            case "population":
                // Récupère le code postal via le premier paramètre passé dans l'url
                $code_postal = $url[1] ;
                $controller = new VillesController();
                $controller->population($code_postal);
                break;

            default:
                $controller = new ErrorController();
                $controller->exception(null);
        }
    }
} catch (Exception $e) {
    // En cas d'exception, un message contenant l'erreur est renvoyé en JSON
    $controller = new ErrorController();
    $controller->exception($e->getMessage());
}
?>

