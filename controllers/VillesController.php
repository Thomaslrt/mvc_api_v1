<?php 
require_once "models/VillesManager.class.php";

class VillesController {

    private $ville;

    public function __construct() {
    }

    public function ville($code_postal, $update) {
        // Vérifie si le paramètres $update a été passé dans l'url. Si non, affiche la ville correspondant au code postal...
        if (!$update) {
            $this->ville = new VillesManager();
            $glob = $this->ville->loadVille($code_postal);
            require_once "views/ville.php";
        } else {
        // ... Si oui, récupère le json contenant les informations et lance la modification (si existant), puis informe l'utilisateur de la réussite ou non de l'opération.
            $json = file_get_contents('php://input');
            if (!$json) {
                $controller = new ErrorController();
                $controller->notFound4();
                die;
            }
            $data = json_decode($json, true);
            $this->ville = new VillesManager();
            $glob2 = $this->ville->modifierVille($code_postal, $data);
            require_once "views/ville.php";
        }
    }

    public function villes($departement, $canton) {
        // Récupère le département et le canton puis les passes en paramètres de la fonction loadDepartement(), 
        // qui est assurée d'établir une liste de toutes les villes inclus dans le département + canton (optionnel) demandé.
        $this->ville = new VillesManager();
        $glob3 = $this->ville->loadDepartement($departement, $canton);
        require_once "views/ville.php";
    }

    public function population($code_postal) {
        // Récupère le code postal saisi et va chercher la/les ville(s) concernée(s) afin d'en calculer la population totale.
        $this->ville = new VillesManager();
        $glob4 = $this->ville->loadVille($code_postal);
        require_once "views/ville.php";
    }

    public function superficie($code_postal) {
        // Récupère le code postal saisi et va chercher la/les ville(s) concernée(s) afin d'en calculer la superficie totale.
        $this->ville = new VillesManager();
        $glob5 = $this->ville->loadVille($code_postal);
        require_once "views/ville.php";    
    }
}


?>