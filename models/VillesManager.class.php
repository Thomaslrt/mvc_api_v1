<?php

/*
Vue, qui récupère l'ensemble des données traitées afin de retourner à l'utilisateur un JSON
contenant l'ensemble des informations qui ont été récupérées.
*/

require_once "Model.class.php";
require_once "Villes.class.php";

class VillesManager extends Model
{
    private $ville;

    public function addVille($villes)
    {
        $this->ville[$villes->getId()] = $villes;
    }

    // Retourne un tableau.
    public function getAllVilles()
    {
        return $this->ville;
    }
	
	// Charge une ville en fonction de son code postal.
    public function loadVille($code_postal)
    {        
        if ($code_postal == null) {
			$controller = new ErrorController();
            $controller->index();
		} else if ($code_postal != null) {
            $id = $this->getDatabase()->select("villes_france", "id", ["code_postal" => $code_postal], ["LIMIT" => 2]);
        }

        // Vérifie déjà si une ville existe avant de traiter les données.
        if (empty($id)) {
            $controller = new ErrorController();
            $controller->notFound();
            die;
        } else {
        
        // Si une ou plusieurs villes existent, ajoute une instance à l'aide de new Ville() avec les informations récupérées en base de données.
        $this->ville = [];
        $ville = $this->getDatabase()->select("villes_france", "*", ["code_postal" => $code_postal]) ;

        foreach ($ville as $villes) {
            $new_ville = new Ville(
                $villes['id'],
                $villes['departement'],
                $villes['nom'],
                $villes['code_postal'],
                $villes['canton'],
                $villes['population'],
                $villes['densite'],
                $villes['surface']
            );
            $this->addVille($new_ville);
        }
           
        return $this->ville;
        }
    }

    public function loadDepartement($departement, $canton)
    {  
        // Vérifie si un département est saisi ou non      
        if ($departement == null) {
			$controller = new ErrorController();
            $controller->index();
		} else if ($departement != null) {
            $id = $this->getDatabase()->select("villes_france", "id", ["departement" => $departement], ["LIMIT" => 2]);
        }

        // Vérifie si au moins une ville existe au sein du département saisi (Renvoi une erreur si rien n'est trouvé.)   
        if (empty($id)) {
            $controller = new ErrorController();
            $controller->notFound2();
            die;
        } else if ($canton == null){
        // Si une ou plusieurs villes existent avec le département (sans canton), ajoute une instance à l'aide de new Ville() avec les informations récupérées en base de données.
        $this->ville = [];
        $ville = $this->getDatabase()->select("villes_france", "*", ["departement" => $departement]) ;

        foreach ($ville as $villes) {
            $new_ville = new Ville(
                $villes['id'],
                $villes['departement'],
                $villes['nom'],
                $villes['code_postal'],
                $villes['canton'],
                $villes['population'],
                $villes['densite'],
                $villes['surface']
            );
            $this->addVille($new_ville);
        }
           
        return $this->ville;

        } else if ($canton != null){
        // Si une ou plusieurs villes existent avec le département (avec canton), ajoute une instance à l'aide de new Ville() avec les informations récupérées en base de données.
        $this->ville = [];
        $ville = $this->getDatabase()->select("villes_france", "*", ["AND" => ["departement" => $departement, "canton" => $canton]]);

        if (empty($ville)) {
            $controller = new ErrorController();
            $controller->notFound3();
            die;
        }

        foreach ($ville as $villes) {
            $new_ville = new Ville(
                $villes['id'],
                $villes['departement'],
                $villes['nom'],
                $villes['code_postal'],
                $villes['canton'],
                $villes['population'],
                $villes['densite'],
                $villes['surface']
            );
            $this->addVille($new_ville);
        }
           
        return $this->ville;
        
        }
    }
   
    public function modifierVille($code_postal, $data) {
        if (!$data['departement'] && !$data['nom'] && !$data['code_postal'] && !$data['canton'] && !$data['population'] && !$data['densite'] && !$data['surface']){
            $controller = new ErrorController();
            $controller->erreurPrecisions2();
            die;
        }
        $id = $this->getDatabase()->select("villes_france", "id", ["code_postal" => $code_postal], ["LIMIT" => 2]);
        // $where est initialisé vide, et les valeurs nom et id sont nettoyées avant d'être utilisées.
        $where = "";
        if ($data['nom']) $data['nom'] = htmlentities($data['nom'], ENT_QUOTES, 'UTF-8');
        if ($data['id']) $data['id'] = htmlentities($data['id'], ENT_QUOTES, 'UTF-8');

        // Un tri est effectué dans les données si plusieurs villes sont trouvées pour le code postal. 
        // Si seulement l'ID est rentré, l'ID sera utilisé pour la requête.
        // Si seulement le nom est rentré, le nom sera utilisé pour la requête.
        // Si les deux sont saisis, l'ID sera utilisé pour la requête.
        if (count($id) > 1 && ($data['nom'] || $data['id'])) {
            if ($data['nom'] && !$data['id']) {
                 $where = ["nom" => $data['nom']];
            } else if ($data['id'] && !$data['nom']) {
                 $id[0]['id'] = $data['id'];
            } else {
                 $id[0]['id'] = $data['id'];
            }
        } else if (count($id) > 0) {
            if (!$where) {$where = ["id" => $id[0]['id']];}
            $prev = $this->getDatabase()->select("villes_france", "*", ["id" => $id[0]['id']]);
            
            // Nettoyage des données présentes dans le JSON + si les données n'ont pas été saisies, les anciennes sont récupérées.
            if (!$data['departement']){$data['departement'] = htmlentities($prev[0]['departement'], ENT_QUOTES, 'UTF-8');}
            if (!$data['nom']){$data['nom'] = htmlentities($prev[0]['nom'], ENT_QUOTES, 'UTF-8');}
            if (!$data['code_postal']){$data['code_postal'] = htmlentities($prev[0]['code_postal'], ENT_QUOTES, 'UTF-8');}
            if (!$data['canton']){$data['canton'] = htmlentities($prev[0]['canton'], ENT_QUOTES, 'UTF-8');}
            if (!$data['population']){$data['population'] = htmlentities($prev[0]['population'], ENT_QUOTES, 'UTF-8');}
            if (!$data['densite']){$data['densite'] = htmlentities($prev[0]['densite'], ENT_QUOTES, 'UTF-8');}
            if (!$data['surface']){$data['surface'] = htmlentities($prev[0]['surface'], ENT_QUOTES, 'UTF-8');}

            // Toutes les données sont insérés dans un update et mis à jour dans la base de données
            $this->getDatabase()->update("villes_france", ['departement' => $data['departement'],
                                                           'nom' => $data['nom'],
                                                           "code_postal" => $data['code_postal'],
                                                           "canton" => $data['canton'],
                                                           "population" => $data['population'],
                                                           "densite" => $data['densite'],
                                                           "surface" => $data['surface']
                                                          ], $where);

            // Une fois la ville mise à jour, une phrase informant l'utilisateur est retournée.
            return 'La ville de '.$prev[0]['nom'].' a correctement été modifiée.';

        // Si aucune ville ne correspond au code postal saisi et qu'aucune information (ID ou Nom) n'est saisi, une erreur est envoyée.
        } else if (!$data['nom'] && !$data['id']) {
            $controller = new ErrorController();
            $controller->erreurPrecisions();
            die;
        }
    }

}