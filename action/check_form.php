<?php
if (file_exists('../param/global.php')) // vérif nécessaire pour les appels ajax
{
	$p = "../";	
}
else
{
	$p = ".../";		
}
include_once($p.'param/global.php');
include_once($p.'fonctions/php_cookies.php');
include_once($p.'fonctions/php_mission.php');
include_once($p.'textes/textes.php');


?>