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

	if (cookieExists(COOKIE_MISSIONS) && isset($_POST['key']) && is_numeric($_POST['key']) && (intval($_POST['key']) >= 0) && (intval($_POST['key']) <= NBR_MISSIONS) && isset($_POST['test'])) {
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		$missioncourante = intval($_POST['key']);
		$data['m'] = $missioncourante;
		$data['erreurcookie'] = false;
		$key_error = isErrorCode($info_missions[$missioncourante], strtoupper($_POST['test']));
		if (isCodeValid($info_missions[$missioncourante], strtoupper($_POST['test']))) {
			$etatmissions = finirMission($etatmissions, $missioncourante); 
			createCookie(COOKIE_MISSIONS, serialize($etatmissions));
			$data['succes'] = true;
			$data['display'] = $info_missions[$missioncourante][DISPLAY_VALIDATION_SUCCESS];
			$data['info'] = $info_missions[$missioncourante][VALIDATION_SUCCESS];
			$data['next'] = $info_missions[$missioncourante][MISSION_SUIVANTE];
		}
		elseif ($info_missions[$missioncourante][DISPLAY_VALIDATION_FAIL]) {
			$data['succes'] = false;
			$data['display'] = true;
			$data['info'] = $info_missions[$missioncourante][VALIDATION_FAIL][$key_error];
		}
		else {
			$data['succes'] = false;
			$data['display'] = false;
			$data['info'] = "";
		}
	}
	else {
		// si on est là, c'est soit qu'on a pas le cookie, soit que l'utilisateur tente de gruger l'appli sans finesse. On le remballe.
		throw new Exception("Validation impossible. Erreur cookie. Je crains que vous ne deviez <a href=\"./\">recommencer le jeu...</a>");
	}
	// on envoie un JSON en réponse. Cela permet d'organiser les données envoyées et de les traiter efficacement.
	//echo "TEST ERREUR kodfskfodkspof:;)";
}
catch(Throwable $e){
	$data['erreurcookie'] = true;
	$data['succes'] = false;
	$data['display'] = true;
	$data['info'] = "<p>Merci de recharger votre page, il semble qu'une erreur soit survenue.</p><p>".$e->getMessage()."</p>";	
}
finally{
	restore_error_handler();
	echo json_encode($data);
}
?>