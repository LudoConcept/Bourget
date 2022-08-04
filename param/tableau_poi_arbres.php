<?php
//Liste des poi arbres
define("ID", 0);
define("TOP", 1);
define("LEFT", 2);
define("Z_INDEX", 3);
define("ALT", 4);

// POUR LES CODES ET CODES D'ERREURS :
// $info_missions[NOM_MISSION][CODE] = ["code valide 1", "code valide 2", "code valide X"];
// $info_missions[NOM_MISSION][ERREUR_CODE] = [1=> "code faux 1", "code faux 2", ..... , "code faux x"];
// $info_missions[NOM_MISSION][VALIDATION_FAIL] = ["message par défaut", "message du code 1", "message du code 2", ......, "message du code x"];
// IL FAUT qu'il y ait un message pas défaut, plus un message par code d'erreur, sinon le système est cassé (j'ai pas fait de try catch pour l'instant)

/*Exemple de déclaration de mission
1. Mission standard = une image + un texte + une question + une réponse + des indices

2. Maintenant je veux une mission où on affiche du texte, qui a un point sur la map qui reste

*/

// info des missions, sous forme de tableau de tableaux.
$info_poi_arbres[0] =	[
							ID => "arbre_00",
							TOP => 28,
							LEFT => 73,
							Z_INDEX => 100,
							ALT => "img_arbre_00"									
						];
$info_poi_arbres[1] =	[
							ID => "arbre_01",
							TOP => 42,
							LEFT => 75,
							Z_INDEX => 101,
							ALT => "img_arbre_01"									
						];						
$info_poi_arbres[2] =	[
							ID => "arbre_02",
							TOP => 49,
							LEFT => 57,
							Z_INDEX => 102,
							ALT => "img_arbre_02"									
						];
$info_poi_arbres[3] =	[
							ID => "arbre_03",
							TOP => 70,
							LEFT => 54,
							Z_INDEX => 103,
							ALT => "img_arbre_03"									
						];						
$info_poi_arbres[4] =	[
							ID => "arbre_04",
							TOP => 55,
							LEFT => 27,
							Z_INDEX => 104,
							ALT => "img_arbre_04"									
						];
$info_poi_arbres[5] =	[
							ID => "arbre_05",
							TOP => 80,
							LEFT => 46,
							Z_INDEX => 105,
							ALT => "img_arbre_05"									
						];						
$info_poi_arbres[6] =	[
							ID => "arbre_06",
							TOP => 90,
							LEFT => 64,
							Z_INDEX => 106,
							ALT => "img_arbre_06"									
						];

$info_poi_arbres[7] =	[
							ID => "arbre_07",
							TOP => 14,
							LEFT => 73,
							Z_INDEX => 107,
							ALT => "img_arbre_07"									
						];
$info_poi_arbres[8] =	[
							ID => "arbre_08",
							TOP => 8,
							LEFT => 26,
							Z_INDEX => 108,
							ALT => "img_arbre_08"									
						];						
$info_poi_arbres[9] =	[
							ID => "arbre_09",
							TOP => 44,
							LEFT => 26,
							Z_INDEX => 109,
							ALT => "img_arbre_09"									
						];
$info_poi_arbres[10] =	[
							ID => "arbre_10",
							TOP => 67,
							LEFT => 82,
							Z_INDEX => 110,
							ALT => "img_arbre_10"									
						];
$info_poi_arbres[11] =	[
							ID => "arbre_11",
							TOP => 61,
							LEFT => 64,
							Z_INDEX => 111,
							ALT => "img_arbre_11"									
						];
$info_poi_arbres[12] =	[
							ID => "arbre_12",
							TOP => 53,
							LEFT => 87,
							Z_INDEX => 112,
							ALT => "img_arbre_12"									
						];
$info_poi_arbres[13] =	[
							ID => "arbre_13",
							TOP => 88,
							LEFT => 44,
							Z_INDEX => 113,
							ALT => "img_arbre_13"									
						];
$info_poi_arbres[14] =	[
							ID => "arbre_14",
							TOP => 27,
							LEFT => 49,
							Z_INDEX => 114,
							ALT => "img_arbre_14"									
						];						
?>