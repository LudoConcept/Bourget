<?php
set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
	/* error was suppressed with the @-operator */
	if (0 === error_reporting()) {
		return false;
	}
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try{
	define("DATAERR", 'erreur');
	define("MSG", 'msg');
	define("DATASAVE", 'save');
	
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
	$data = Array();
	$data[DATAERR] = false;
	$data[MSG] = "";
	$data[DATASAVE] = false;
	
	if (!cookieExists(COOKIE_MISSIONS)) {
		$data[DATAERR] = true;
		throw new Exception("Erreur, aucune donnée dans les cookies. Je crains que vous ne deviez <a href=\"./\">recommencer le jeu...</a>");
	}
	if (!isset($_POST['team']) && !isset($_POST['start']) && !isset($_POST['end']) && !isset($_POST['duree']) && !isset($_POST['rep_juste']) && is_numeric($_POST['start']) && is_numeric($_POST['end']) && is_numeric($_POST['duree']) && is_numeric($_POST['rep_juste'])) {
		$data[DATAERR] = true;
		throw new Exception("Erreur, aucune donnée envoyées via le formulaire. ");
	}
	
	if (!$data[DATAERR]) {
		// formulaire envoyé : insérer la team dans la bdd !
		// INSERT INTO `utilisateur` (`nom`, `prenom`, `email`) VALUES ('Durantay', 'Quentin', 'quentin@gmail.com');
		$array = ["nom" => $_POST['team'], "start" => intval($_POST['start']), "end" => intval($_POST['end']), "rep" => intval($_POST['rep_juste']), "duree" => intval($_POST['duree'])];
		$sql = "INSERT INTO `game` (`nom`, `start`, `end`, `reponsejuste`, `duree`) VALUES (:nom, :start, :end, :rep, :duree)";
		$statement = $conn->prepare($sql);
		$statement->execute($array);
		$data[DATASAVE] = true;
		$data[MSG] = "RECORD";
	}
	
}
catch(PDOException $e){
	if (isset($statement) && $statement->errorInfo()[1] == 1062){
		$data[DATAERR] = false;
		$data[DATASAVE] = false;
		$data[MSG] = "<p>Une autre &eacute;quipe a choisi le m&ecirc;me nom. Trouvons-en un autre&nbsp;!</p>";
	}
	elseif (isset($statement)) {
		$data[DATAERR] = true;
		// $data[MSG] = "<p>Erreur aupr&eagrav;s de la base de donn&eacute;es.</p><p>Ligne ".$e->getLine()." : ".$e->getMessage()."</p><p>".implode(" ||| ",$statement->errorInfo())."</p>";
		$data[MSG] = "<p>Erreur auprès de la base de donn&eacute;es.</p><p>Intern error code ".$statement->errorInfo()[1]." ---- Line ".$e->getLine()." : </p><p>".$e->getMessage()."</p>";
	}
	else {
		$data[DATAERR] = true;
		// $data[MSG] = "<p>Erreur aupr&eagrav;s de la base de donn&eacute;es.</p><p>Ligne ".$e->getLine()." : ".$e->getMessage()."</p><p>".implode(" ||| ",$statement->errorInfo())."</p>";
		$data[MSG] = "<p>Erreur d'accès à la base de données.</p><p>Veuillez contacter un administrateur.</p>";
	}
}
catch(Exception $e){
	$data[DATAERR] = true;
	$data[MSG] = "<p>Une exception est survenue. Merci de contacter un administrateur.</p><p>Ligne ".$e->getLine()." : ".$e->getMessage()."</p>";
}
catch(Error $e){
	$data[DATAERR] = true;
	$data[MSG] = "<p>Une erreur est survenue. Merci de contacter un administrateur.</p><p>Ligne ".$e->getLine()." : ".$e->getMessage()."</p>";
}
finally{
	echo json_encode($data);
	restore_error_handler();
}

?>