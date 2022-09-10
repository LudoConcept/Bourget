<?php
// options pour les cookies, la clef expires doit être précisée avant utilisation du tableau
// define("DOMAIN", "bourget");
// define("DOMAIN", "localbourget");
// define("DOMAIN", "jeuext.la-grande-evasion.com");
define("DOMAIN", $_SERVER['HTTP_HOST']);

$options = ['expires' => -1, 'path' => PATH, 'domain' => DOMAIN, 'secure' => COOKIESECURE, 'httponly' => COOKIEHTTPONLY, 'samesite' => 'Lax'];

function createCookie($nom, $value){
	global $options;
	$expires = time()+(60*60*24*10);
	$options['expires'] = $expires;
	setcookie($nom, $value, $options);
	//setcookie($nom, $value, $expires, PATH);
}

function cookieExists($cookie){
	// Renvoi true si le cookie existe et n'est pas vide. Permet aussi de vérifier que les cookies sont pris en charge par le client.
	return (isset($_COOKIE[$cookie]) && $_COOKIE[$cookie] != "");
}

function init_cookie_mission($nbmission){
	//Création du tableau contenant les index des missions et renvoi un tableau de 0 au démarrage du jeu que l'on stocke dans les cookies
	$array= [];
	for ($i=0; $i<=$nbmission; $i++) {
		$array[$i] = INACTIVE;
	}	
	return $array;
}

function init_cookie_vibro(){	
	$cook_vibro = "01011";	
	return $cook_vibro;
}

function read_cookie_vibro(){	
	$chaine_cook_vibro = $_COOKIE[COOKIE_VIBROPHONE];
	//echo("lecture cookie : ".$chaine_cook_vibro);
	$array = [];
	$array[ETAT_ON_OFF]  	= substr($chaine_cook_vibro,0,1);	//Off = 0 On = 1
	$array[ETAT_AIGUILLE] 	= substr($chaine_cook_vibro,1,1);	//Signal à 1 par défaut
	$array[ETAT_CARRE]  	= substr($chaine_cook_vibro,2,1);	//Carré 0 pour aucun sinon de 1 à 5
	$array[ETAT_POTAR1]  	= substr($chaine_cook_vibro,3,1);	//Potar sur 1 (à 4)
	$array[ETAT_POTAR2]  	= substr($chaine_cook_vibro,4,1);	//Potar sur 1 (à 4)		
	return $array;
}

function init_cookie_poi_arbres(){
	$cook_poi_arbres = "000000000000000";	//15 arbres
	return $cook_poi_arbres;
}

function read_cookie_poi_arbres(){
	$chaine_cook_poi_arbres = $_COOKIE[COOKIE_POI_ARBRES];
	return $chaine_cook_poi_arbres;
}

function fin_cookie_poi_arbres(){
	$cook_poi_arbres = "333333333333333";	//15 arbres
	createCookie(COOKIE_POI_ARBRES, $cook_poi_arbres);
}

function init_cookie_poi_map(){
	$cook_poi_map = "111111";	//6 métamorphes
	return $cook_poi_map;
}

function read_cookie_poi_map(){
	$chaine_cook_poi_map = $_COOKIE[COOKIE_POI_MAP];
	return $chaine_cook_poi_map;
}

function init_cookie_esprit(){
	$cook_esprit = "000000000";	//0 on n'est pas encore passé. 1 on est passé
	return $cook_esprit;
}

function read_cookie_esprit_check_mission($position){	
	echo "<br>passe dans read_cookie_esprit_check_mission";
	$chaine_cook_esprit = $_COOKIE[COOKIE_ESPRIT];		
	$param = substr($chaine_cook_esprit,$position,1);	
	return $param;
}

function nb_cookie_esprit_ok($chaine_cook_esprit){
	$nb_ok = 0;
	for ($i=0; $i<=ID_MAX_ESPRIT; $i++) {
		if (substr($chaine_cook_esprit,$i,1) == 1) {
			$nb_ok ++;
		}		
	}		
	return $nb_ok;
}

function maj_cookie_esprit($position){	
	$valeurs = $_COOKIE[COOKIE_ESPRIT];	
	if ($position == ID_MAX_ESPRIT)
	{
		$valeurs = substr($valeurs,0,$position)."1";
	} else {	
		if ($position == 0)	{
			$valeurs = "1".substr($valeurs,$position+1);	
		} else {
			$valeurs = substr($valeurs,0,$position)."1".substr($valeurs,$position+1);
		}
	}
	createCookie(COOKIE_ESPRIT,$valeurs);
	$nb_ok = nb_cookie_esprit_ok($valeurs);
	return($nb_ok);
}

function init_cookie_timer(){
	$temps_initial = time();
	return($temps_initial);
}

function read_cookie_timer(){
	$temps_initial = $_COOKIE[COOKIE_TIMER];
	return($temps_initial);
}

function read_cookie_question(){
	$reponses = $_COOKIE[COOKIE_QUESTION];
	return $reponses;
}

function maj_cookie_fin_de_game($tosave){
	createCookie(COOKIE_FINAL,$tosave);
}

function read_cookie_fin_de_game(){
	$temps_stock = $_COOKIE[COOKIE_FINAL];
	return $temps_stock;
}
?>