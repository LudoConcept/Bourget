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

	include_once($p.'action/bdd_connect.php');
	
	// check des conditions + prépa des valeurs de retour
	$data = [];
	$data["erreur"] = false;
	
	if (!cookieExists(COOKIE_MISSIONS)) {
		$data['erreur'] = true;
		throw new Exception("Erreur, aucune donnée dans les cookies. Je crains que vous ne deviez <a href=\"./\">recommencer le jeu...</a>");
	}
	if (!isset($_POST['team']) && !isset($_POST['start']) && !isset($_POST['end']) && !isset($_POST['duree']) && !isset($_POST['rep_juste']) && is_numeric($_POST['start']) && is_numeric($_POST['end']) && is_numeric($_POST['duree']) && is_numeric($_POST['rep_juste'])) {
		$data['erreur'] = true;
		throw new Exception("Erreur, aucune donnée envoyées via le formulaire. ");
	}
	
	if (!data['erreur']) {
		// formulaire envoyé : insérer la team dans la bdd !
		// INSERT INTO `utilisateur` (`nom`, `prenom`, `email`) VALUES ('Durantay', 'Quentin', 'quentin@gmail.com');
		$array = ["nom" => $_POST['team'], "start" => intval($_POST['start']), "end" => intval($_POST['end']), "rep" => intval($_POST['rep_juste']), "duree" => intval($_POST['duree'])];
		$sql = "INSERT INTO `game` (`nom`, `start`, `end`, `reponsejuste`, `duree`) VALUES (:nom, :start, :end, :rep, :duree)";
		$statement = $conn->prepare($sql);
		$statement->execute($array);
		
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