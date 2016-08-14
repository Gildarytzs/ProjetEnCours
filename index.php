<?php
include "init.php";
include "php/header.php";
if(isConnected()){
	if($_SESSION['admin']){
		include "php/espace_admin.php";
	}
	if($_SESSION['accesstoken']){ // else suffit car si isConnected true alors $_Session["accestoken"];
		include "php/espace_client.php";
	}
}else{
	include "php/welcome.php";
}
include "php/footer.php"
?>