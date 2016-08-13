
<?php
include "php/header.php";
if(isConnected()){
	if($_SESSION['admin']){
		include "php/espace_admin.php";
	}
	if($_SESSION['accesstoken']){
		include "php/espace_client.php";
	}
}else{
	include "php/welcome.php";
}
include "php/footer.php"
?>