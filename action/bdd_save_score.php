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
	$data = [];
	$data["erreur"] = false;
	
	include_once($p.'action/bdd_connect.php');
	
	if (cookieExists(COOKIE_MISSIONS)) {
		if (isset($_POST['team'])) {
			// formulaire envoyé : insérer la team dans la bdd !
			// INSERT INTO `utilisateur` (`nom`, `prenom`, `email`) VALUES ('Durantay', 'Quentin', 'quentin@gmail.com');
			$array = ["nom" => $_POST['team'], "start" => $_POST['start'], "end" => $_POST['end'], "rep" => $_POST['rep_juste'], "duree" => $_POST['duree']];
			$sql = "INSERT INTO `game` (`nom`, `start`, `end`, `reponsejuste`, `duree`) VALUES (:nom, :start, :end, :rep, :duree)";
		}
		else {
			throw new Exception("Le formulaire n'a pas été envoyé correctement.");
		}
	} else {
		throw new Exception("Affichage impossible. Erreur cookie. Je crains que vous ne deviez <a href=\"./\">recommencer le jeu...</a>");
	}
	
}
catch(PDOException $e){
	$data["erreur"] = true;
	$data["msg"] = "<p>Erreur auprès de la base de données.</p><p>Requête : $sql</p><p>".$e->getMessage()."</p>";
}
catch(Exception $e){
	$data["erreur"] = true;
	$data["msg"] = "<p>Une exception est survenue. Merci de contacter un administrateur.</p><p>".$e->getMessage()."</p>";
}
catch(Error $e){
	$data["erreur"] = true;
	$data["msg"] = "<p>Une erreur est survenue. Merci de contacter un administrateur.</p><p>".$e->getMessage()."</p>";
}
finally{
	echo json_encode($data);
	restore_error_handler();
}

?>