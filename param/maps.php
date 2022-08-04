<?php
// gestion des cartes
define("NOMBRE_CARTE", 1); // Combien de cartes différentes sont utilisées ?
define("NOMBRE_VERSION_CARTE", 1); // Combien de versions de chaque carte affiche-t-on ?
define("TITRE_CARTE", "Carte ");
$map_global["nom"][1] = "des Jardins du Prieuré";
//$map_global["nom"][2] = 1750;
$map_global["source"][1] = [1=>"map.jpg", "map.jpg"]; // source pour les différentes versions
//$map_global["source"][1] = [1=>"map.png", "map.png"]; // source pour les différentes versions
//$map_global["source"][2] = [1=>"1650 hiver fin.png", "1750 hiver.png"];
//$map_global["source"][3] = [1=>"1650 hiver fin.png", "1750 hiver fin.png"];
$map_global["afficher"][1] = GAME_ON; // afficher à partir de l'activation de tel ou tel mission
//$map_global["afficher"][2] = ALLER_1750;
$map_global["version"][1] = GAME_ON; // afficher la version des cartes à partir de l'activation de tel ou tel mission
//$map_global["version"][2] = ALLER_1750;
//$map_global["version"][3] = TROUVER_TEO;
?>