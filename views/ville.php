<?php 

/*
Vue, qui récupère l'ensemble des données traitées afin de retourner à l'utilisateur un JSON
contenant l'ensemble des informations qui ont été récupérées.
*/

if ($glob) {
  // On insert les données de la ville dans un tableau
  foreach ($glob as $villes) {
    $message [] = array( "id" => $villes->getId(),
                         "departement" => $villes->getDepartement(),
                         "nom" => $villes->getNom(),
                         "code_postal" => $villes->getCodePostal(),
                         "canton" => $villes->getCanton(),
                         "population" => $villes->getPopulation(),
                         "densite" => $villes->getDensite(),
                         "surface" => $villes->getSurface());                
  }
  // Lequel est inséré dans un second tableau contenant "status" et "message" afin de rendre plus simple l'utilisation et l'affichage de l'API sur une interface.
  $message = array( "status" => "Liste des villes correspondant au code postal ".$villes->getCodePostal(0)."",
                    "message" => $message);
  echo json_encode($message, JSON_UNESCAPED_UNICODE);
} 


else if ($glob2) {
  // En cas d'update de la ville, si celle-ci a réussi on retourne le message défini dans la vue, avec le nom de la ville
  $message = array( "status" => "ok",
                    "message" => $glob2);
  echo json_encode($message, JSON_UNESCAPED_UNICODE);
} 


else if ($glob3) {
  // Récupère et insert dans un tableau la liste des villes récupérées
  foreach ($glob3 as $villes) {
    $message [] = array( "id" => $villes->getId(),
                    "departement" => $villes->getDepartement(),
                    "nom" => $villes->getNom(),
                    "code_postal" => $villes->getCodePostal(),
                    "canton" => $villes->getCanton(),
                    "population" => $villes->getPopulation(),
                    "densite" => $villes->getDensite(),
                    "surface" => $villes->getSurface());                
  }
  // Lui même inséré dans un tableau avec le message et un status affichant un message personnalisé avec le département et le canton.
  if ($canton) $infos = " (canton : ".$villes->getCanton().")"; else $infos = "";
  $message = array( "status" => "Liste des villes présentes dans le département ".$villes->getDepartement(0).$infos."",
                    "message" => $message);
  echo json_encode($message, JSON_UNESCAPED_UNICODE);
} 


else if ($glob4) {
  // Définit les deux variables qui vont être utilisées
  $i = 0;
  $total = 0;
  // Boucle sur chaque ville et calcul le total à chaque tours
  foreach ($glob4 as $villes) {
      $total = $total + $villes->getPopulation();
      $i++;       
  }
  // Le message renvoyé change selon si une seule ou plusieurs villes ont été récupérées.
  if ($i > 1) {
      $message = array( "status" => "Le code postal ".$villes->getCodePostal(0)." comprends ".$i++." villes. Leur population a été additionnée",
                        "message" => array("population" => $total));   
  } else {
      $message = array( "status" => "Population pour la ville correspondant au code postal ".$villes->getCodePostal(0)."",
                        "message" => array("population" => $total));   
  }
  echo json_encode($message, JSON_UNESCAPED_UNICODE);
} 


else if ($glob5){
  // Définit les deux variables qui vont être utilisées
  $i = 0;
  $total = 0;
  // Boucle sur chaque ville et calcul le total à chaque tours
  foreach ($glob5 as $villes) {
      $total = $total + $villes->getSurface();
      $i++;       
  }
  // Le message renvoyé change selon si une seule ou plusieurs villes ont été récupérées.
  if ($i > 1) {
      $message = array( "status" => "Le code postal saisi comprends ".$i++." villes. Leur surface a été additionnée",
                        "message" => array("surface" => round($total,2)));   
  } else {
      $message = array( "status" => "Le code postal saisi comprends une seul ville",
                        "message" => array("surface" => round($total,2)));   
  }  
  echo json_encode($message, JSON_UNESCAPED_UNICODE);
}

?>