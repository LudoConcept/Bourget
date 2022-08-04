<?php
set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
	/* error was suppressed with the @-operator */
	if (0 === error_reporting()) {
		return false;
	}
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try{
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

	if (cookieExists(COOKIE_MISSIONS)){
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		$check["erreur"] = false;
		$check["erreurinfo"] = false;		
		$check["mission1"] = $etatmissions[MOT_DE_PASSE] == ACTIVE; //Première mission
		$check["carte"] = 1;		
		if ($etatmissions[APPARITION] == FINISH)
		{
			$check["afficher_onglet3"] = True;
		} else {
			$check["afficher_onglet3"] = False;
		}		
		for ($i = 1; $i <= NOMBRE_CARTE; $i++)
		{
			if ( ($etatmissions[$map_global["afficher"][$i]] == ACTIVE) || ($etatmissions[$map_global["afficher"][$i]] == FINISH) )
				$check["carte"] = $i;
		}
	}
	else {
		throw new Exception("Impossible de lancer le jeu. Erreur cookie. Réessayez <a href=\"./\">depuis le début</a>, s'il vous plaît.");
	}
}
catch(Throwable $e){
	$check["erreur"] = true;
	$check["pizza"] = false;
	$check["distrib"] = false;
	$check["distrib_ok"] = false;
	$check["mission1"] = false;
	$check["carte"] = 1;
	$check["afficher_onglet3"] = false;
	$check["erreurinfo"] = $e->getMessage();
}
finally{
	restore_error_handler();
	echo json_encode($check);
}
?>