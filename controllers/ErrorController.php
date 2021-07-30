<?php 

/*
Fichier en charge de la gestion des erreurs, en cas de soucis de fonctionnement un JSON est renvoyé
contenant l'ensemble des informations concernant l'erreur survenue.
*/

class ErrorController {

    public function __construct() {
    }

    public function index() {
        $message = array( "status" => "error",
                          "message" => "Merci de rentrer des paramètres dans l'URL"
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function notFound() {
        $message = array( "status" => "error",
                          "message" => "Impossible de trouver une ville correspondant au code postal demandé."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function notFound2() {
        $message = array( "status" => "error",
                          "message" => "Impossible de trouver une ville correspondant au département demandé."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function notFound3() {
        $message = array( "status" => "error",
                          "message" => "Impossible de trouver une ville correspondant au département et au canton demandé."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function notFound4() {
        $message = array( "status" => "error",
                          "message" => "Vous devez fournir les informations à modifier via un fichier JSON. Aucun fichier n'a pu être trouvé."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function erreurDoublon() {
        $message = array( "status" => "error",
                          "message" => "Plusieurs villes ont été trouvées pour ce code postal. Veuillez spécifier un nom ou un ID à modifier."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function erreurPrecisions() {
        $message = array( "status" => "error",
                          "message" => "Plusieurs correspondances ont été trouvées pour ce code postal. Veuillez spécifier un ID ou un nom afin de modifier une ville."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function erreurPrecisions2() {
        $message = array( "status" => "error",
                          "message" => "Merci de saisir au moins une information à changer sur la ville choisie (département, nom, code postal, canton, population, densité ou surface)."
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function exception($erreur) {
        if (!$erreur) $erreur = "L'URL demandée n'existe pas.";
        $message = array( "status" => "error",
                          "message" => $erreur
        );
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
        die;
    }
}


?>