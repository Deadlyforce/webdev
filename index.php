<?php
require_once('backoffice/connection.php');
session_start();

// Si un controleur et une action existent, je les stocke dans des variables. Sinon retour à l'accueil (en définissant les controleur et action "à la main").

if(isset($_GET['controller']) && isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}else{
    // Direction l'accueil
    $controller = 'news';
    $action = 'accueil';
}

// Si les controleur et action existent, et en plus ne sont pas vides, alors je charge une variable avec le chemin du fichier php correspondant à ce controleur. 

if(!empty($controller) && !empty($action)){

	$file_controller = 'controllers/'. $controller . '.php';
	
        
        // Si ce fichier php correspondant au controleur existe, je réalise l'inclusion du fichier (j'appelle le controleur et sa vue correspondante...la page en somme)
        // Ensuite, si la classe correspondante existe dedans, je l'instancie et crée un objet correspondant
        // Enfin, si dans cette classe une méthode correspondant à l'action existe, je l'appelle
	if(file_exists($file_controller)){
		include($file_controller);
            
		if(class_exists($controller)){
			$control = new $controller;
			if(method_exists($control, $action)){
				$control->$action();
			}
		}
	}
}




