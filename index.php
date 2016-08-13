header.php
SI isconnect False
	affiche page d'acceuil
	si $session["admin"] affiche espace admin
	Si $session["accestoken"] affiche espace client
footer.php