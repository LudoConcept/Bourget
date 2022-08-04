<?php
//Liste des poi arbres
define("MAP_ID", 0);
define("MAP_TOP", 1);
define("MAP_LEFT", 2);
define("MAP_WIDTH", 3);
define("MAP_Z_INDEX", 4);
define("MAP_ALT", 5);
define("MAP_TURN",6);

define("SOLUTION_MAP", "233442");


/* ATTENTION !!!!!!!!!!!!
	Je me base sur le z-index pour identifier l'élément sur lequel je suis !!
	Ne pas le modifier sans modifier le code contenu dans interface.php
ATTENTION !!!!!!!!!!!! */

$info_poi_maps[0] =	[
							MAP_ID => "1",
							MAP_TOP => 15,
							MAP_LEFT => 21,
							MAP_WIDTH => 6,
							MAP_Z_INDEX => 22,
							MAP_ALT => "img_map_elt1_",
							MAP_TURN => "Non"									
						];
/* Avant V1.3
$info_poi_maps[1] =	[
							MAP_ID => "2",
							MAP_TOP => 33,
							MAP_LEFT => 34.5,
							MAP_WIDTH => 12.5,
							MAP_Z_INDEX => 23,
							MAP_ALT => "img_map_elt2_",
							MAP_TURN => "Oui"								
						];
*/
$info_poi_maps[1] =	[
							MAP_ID => "2",
							MAP_TOP => 34.5,
							MAP_LEFT => 32,
							MAP_WIDTH => 18,
							MAP_Z_INDEX => 23,
							MAP_ALT => "img_map_elt2_",
							MAP_TURN => "Oui"								
						];						
/* Avant V1.3
$info_poi_maps[2] =	[
							MAP_ID => "3",
							MAP_TOP => 72.5,
							MAP_LEFT => 69,
							MAP_WIDTH => 20,
							MAP_Z_INDEX => 24,
							MAP_ALT => "img_map_elt3_",
							MAP_TURN => "Oui"									
						];
*/
$info_poi_maps[2] =	[
							MAP_ID => "3",
							MAP_TOP => 70.5,
							MAP_LEFT => 71,
							MAP_WIDTH => 16,
							MAP_Z_INDEX => 24,
							MAP_ALT => "img_map_elt3_",
							MAP_TURN => "Oui"									
						];
/* Avant V1.3
$info_poi_maps[3] =	[
							MAP_ID => "4",
							MAP_TOP => 65,
							MAP_LEFT => 38.5,
							MAP_WIDTH => 8,
							MAP_Z_INDEX => 25,
							MAP_ALT => "img_map_elt4_",
							MAP_TURN => "Oui"									
						];
*/
$info_poi_maps[3] =	[
							MAP_ID => "4",
							MAP_TOP => 66,
							MAP_LEFT => 37,
							MAP_WIDTH => 11,
							MAP_Z_INDEX => 25,
							MAP_ALT => "img_map_elt4_",
							MAP_TURN => "Oui"									
						];											
$info_poi_maps[4] =	[
							MAP_ID => "5",
							MAP_TOP => 27,
							MAP_LEFT => 80,
							MAP_WIDTH => 5,
							MAP_Z_INDEX => 26,
							MAP_ALT => "img_map_elt5_",
							MAP_TURN => "Non"									
						];
$info_poi_maps[5] =	[
							MAP_ID => "6",
							MAP_TOP => 75,
							MAP_LEFT => 28,
							MAP_WIDTH => 9,
							MAP_Z_INDEX => 27,
							MAP_ALT => "img_map_elt6_",
							MAP_TURN => "Non"									
						];						
?>