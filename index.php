<?php
include "init.php";
include "php_html/header.php";
if(isConnected()){
	if($_SESSION['admin']){
		include "php_html/espace_admin.php";
	}
	else{ 
		include "php_html/espace_client.php";
	}
}else{
	include "php_html/welcome.php";
}
include "php_html/footer.php"
?>
