# ProjetEnCours

1) Refonte architecture du site
	14/08 :
		- Créer fichier php/form_inscription.php : modal d'inscription
		- Créer fichier php/form_connexion.php : moal de connexion
		- Fichier access.php : mettre les fonctions en liens avec la connexion et l'inscription
		- VOir commmentaire sur init.php et index.php
		- Tester la connexion et l'inscription
		- Création d'enchère avec photo (voir comment stocker photo en BDD)
		- Welcome.php : créer deux carrousels pour enchère terminé et enchères en cours
			=> Requete php qui récupère les img des bids où sold=0 ou =1. Mettre un LIMIT 5 (ou +)
			. Penser à include nav_welome dans welcome
			. Enlever header.php de welcome.php ( deja mis dans index.php)