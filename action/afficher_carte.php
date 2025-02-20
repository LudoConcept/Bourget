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

	if (cookieExists(COOKIE_MISSIONS))
	{
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		for ($i = 1; $i <= NOMBRE_VERSION_CARTE; $i++)
		{ // on récupére la version des cartes que l'on doit afficher
			if ($etatmissions[$map_global["version"][$i]] == ACTIVE || $etatmissions[$map_global["version"][$i]] == FINISH)
				$version = $i;
		}
		
		for ($i = 1; $i <= NOMBRE_CARTE; $i++){ // on récupère le nombre de cartes que l'on doit afficher
			if ($etatmissions[$map_global["afficher"][$i]] == ACTIVE || $etatmissions[$map_global["afficher"][$i]] == FINISH)
				$nb_map = $i;
		}
		
		if (isset($_POST['map']) && is_numeric($_POST['map']) && (intval($_POST['map'])>=1 && intval($_POST['map'])<=NOMBRE_CARTE))
			$map = intval($_POST['map']); // carte qui est demandée
		else
			$map = 1;
		if (isset($_POST['focus']) && is_numeric($_POST['focus']) && (intval($_POST['focus'])>=0 && intval($_POST['focus'])<=NBR_MISSIONS))
			$focus = intval($_POST['focus']); // mission qui est demandée
		else
			$focus = 0;
		
		if ($nb_map > 1) 
		{
			for ($i=1; $i <= $nb_map; $i++) { ?>
				<h2 class="text-center m-3<?php if ($i == $map) echo " carte-active"; else echo " changemap"; ?>" title="<?php echo $i; ?>"><?php echo TITRE_CARTE.$map_global["nom"][$i]; ?></h2><?php
			}
		} ?>		

		<div style="float: left; position: relative; width: 98%; margin-left: 1%;">			
			<img class="map" style="width:100%; border:5px solid #D29513;" src="./images/<?php echo $map_global["source"][$version][$map]; ?>" alt="<?php echo TITRE_CARTE.$map_global["nom"][$map]; ?>" />

<?php					

/*********************************************************************
 ********************** MISSION STATUE CENTRE ************************
 ********************************************************************/			

			if ($etatmissions[STATUE_CENTRE_2] == INACTIVE)
			{			
				//Pour éviter les événements onclick
				$id_actif = "aff_elt";
			}

			if ($etatmissions[STATUE_CENTRE_2] == FINISH)
			{
				//Pour affichage des fonds des 6 métamorphes
				$class_couleur = "point_fini point_opacity_30";
				//Pour éviter les événements onclick
				$id_actif = "aff_elt";
			}

			if ($etatmissions[STATUE_CENTRE_2] == ACTIVE)
			{
				//Pour affichage des fonds des 6 métamorphes
				$class_couleur = "point_bleu";
				//Pour activer les événements onclick
				$id_actif = "map_elt";	
			}

			if ($etatmissions[STATUE_CENTRE_2] > INACTIVE)
			{				
				//Affichage des fonds bleus des métamorphes pour mise en surbrillance
				?>
				<div style="position: absolute; left: 0%; top: 0%; width:100%; height:100%;">
					<!-- Elément fontaine placette -->
					<div class="cercle <?php echo $class_couleur; ?>" style="top: 15.5%; left: 20.5%; width:7%; height:3.5%; z-index:2;" id="fond_elt1"></div>			
					<!-- Elément Les carrés de jardin -->	
					<div class="carre <?php echo $class_couleur; ?>" style="top: 34.5%; left: 32%; width:18%; height:6%; z-index:3;" id="fond_elt2"></div>
					<!-- Elément parc enfant -->
					<div class="carre <?php echo $class_couleur; ?>" style="top: 71%; left: 72%; width:14.5%; height:10%; z-index:4;" id="fond_elt3"></div>
					<!-- Elément fontaine bas -->
					<div class="cercle <?php echo $class_couleur; ?>" style="top: 66%; left: 37%; width:11%; height:4%; z-index:5;" id="fond_elt4"></div>
					<!-- Elément cube -->
					<div class="cercle <?php echo $class_couleur; ?>" style="top: 27.5%; left: 79.5%; width:7%; height:3.5%; z-index:6;" id="fond_elt5"></div>
					<!-- Elément arbre en bas à gauche -->
					<div class="cercle <?php echo $class_couleur; ?>" style="top: 75%; left: 28%; width:9%; height:4.5%; z-index:7;" id="fond_elt6"></div>
				</div>
				<?php
			}
			
			$etat_poi_map = read_cookie_poi_map();			
			?>			
			<div id="poi_map_valeurs" class="hide" ><?php echo $etat_poi_map;?></div>
			<?php

			for ($i = 0; $i <= 5; $i++)		
			{ 		
				$val_poi_map = substr($etat_poi_map,$i,1);
				$image = IMG_MAP_ELT.$i."_".$val_poi_map.".png";

				/*if ($info_poi_maps[$i][MAP_TURN] == "Oui") {
					$tranformation = "transform:rotate(90deg);";
				} else {*/
					$tranformation = "";
				//}
				
				?>		
			
				<div style="position: absolute; left: 0%; top: <?php echo $info_poi_maps[$i][MAP_TOP]; ?>%; width:100%;">			
				<img data-num_elt="<?php echo $i; ?>" id="<?php echo $info_poi_maps[$i][MAP_ID]; ?>" class="<?php echo $id_actif; ?>" style="position: relative; left: <?php echo $info_poi_maps[$i][MAP_LEFT]; ?>%; width:<?php echo $info_poi_maps[$i][MAP_WIDTH]; ?>%; <?php echo $tranformation; ?> z-index:<?php echo $info_poi_maps[$i][MAP_Z_INDEX]; ?>" src="<?php echo $image; ?>" alt="<?php echo $info_poi_maps[$i][MAP_ALT].$val_poi_map; ?>" />
				</div>				
			
			<!--
			<span style="position: absolute; top: <?php echo $info_poi_maps[$i][MAP_TOP]; ?>%; left: <?php echo $info_poi_maps[$i][MAP_LEFT]; ?>%; z-index:<?php echo $info_poi_maps[$i][MAP_Z_INDEX]; ?>">				
				<img id="<?php echo $info_poi_maps[$i][MAP_ID]; ?>" class="<?php echo $id_actif; ?>" style="width: <?php echo $info_poi_maps[$i][MAP_WIDTH]; ?>%; <?php echo $tranformation; ?>" src="<?php echo $image; ?>" alt="<?php echo $info_poi_maps[$i][MAP_ALT].$val_poi_map; ?>" />
			</span>
			-->	
				<?php												
			}				
		
 /*********************************************************************
 ********************** MISSION STATUE FOND ***************************
 *********************************************************************/			

			if ($etatmissions[STATUE_FOND_2] > INACTIVE) {
				//Récupération des données stockées dans le cookie
				$etat_poi_arbres = read_cookie_poi_arbres();
				?>
				<div id="poi_arbre_valeurs" class="hide" ><?php echo $etat_poi_arbres;?></div>
				<?php
				for ($i = 0; $i <= 14; $i++)
				{ 
					$val_poi_arbre = substr($etat_poi_arbres,$i,1);
					switch ($val_poi_arbre) {
					case 0 :
						//Point d'interrogation
						$Selection_img = IMG_ARBRE;
						break;
					case 1 :
						//Arbre ici
						$Selection_img = IMG_EST_ARBRE;						
						break;
					case 2 :
						//Arbre pas ici
						$Selection_img = IMG_PAS_ARBRE;
						break;
					case 3 :
						//Jeu terminé
						$Selection_img = IMG_CERCLE;						
						break;	
					default :
						break;
					}
					
					?>
					<div style="position: absolute; left: 0%; top: <?php echo $info_poi_arbres[$i][TOP] ?>%; width:100%;">
						<img data-num_arbre="<?php echo $i; ?>" id="<?php echo $info_poi_arbres[$i][ID]; ?>" class="arbre" style="position: relative; left: <?php echo $info_poi_arbres[$i][LEFT]; ?>%; width:6%; z-index:<?php echo $info_poi_arbres[$i][Z_INDEX]; ?>" src="<?php echo $Selection_img; ?>" alt="<?php echo $info_poi_arbres[$i][ALT]; ?>" />
					</div>
					<?php
				}				
			}


 /********************************************************************
 ********************** TOUTES LES AUTRES ****************************
 *********************************************************************/
 
			for ($i=1; $i <= NBR_MISSIONS; $i++)
			{
				if ($etatmissions[$i] == ACTIVE && $info_missions[$i][CARTE] == $map)
				{ 
					if ($i == ROSES) 
					{	?>
						<a class="cercle point_actif" style="top: <?php echo $info_missions[$i][Y] ?>%; left: <?php echo $info_missions[$i][X]; ?>%; width:23%; height:2%;" href="#" title="<?php echo $i; ?>"></a>
						<?php
					} else {
						?>
						<a class="cercle point_actif<?php if ($info_missions[$i][GEANT]) echo " geant"; if ($focus == $i) echo " point_focus"; ?>" style="top: <?php echo $info_missions[$i][Y]; ?>%; left: <?php echo $info_missions[$i][X]; ?>%;" href="#" title="<?php echo $i; ?>"></a>
						<?php
					}
				}
			}
			
			for ($i=1; $i <= NBR_MISSIONS; $i++) {
				if ($etatmissions[$i] == FINISH && $info_missions[$i][CARTE] == $map && $info_missions[$i][AFFICHER_FINISH_MAP]){
					if ($i == ROSES) 
					{	?>
						<span class="cercle point_fini" style="top: <?php echo $info_missions[$i][Y]; ?>%; left: <?php echo $info_missions[$i][X]; ?>%; width:23%; height:2%;"></span>
						<?php
					} else {
						?>
						<span class="cercle point_fini" style="top: <?php echo $info_missions[$i][Y]; ?>%; left: <?php echo $info_missions[$i][X]; ?>%;"></span>
						<?php
					}
				}
			} ?>			
			
			<div style="display: block;">
				
			</div>
		</div>
		<?php
	} else {
		throw new Exception("Affichage impossible. Erreur cookie. Je crains que vous ne deviez <a href=\"./\">recommencer le jeu...</a>");
	}
}
catch(Exception $e){
	die("<p>Une exception est survenue. Merci de contacter un administrateur.</p><p>".$e->getMessage()."</p>");
}
catch(Error $e){
	die("<p>Une erreur est survenue. Merci de contacter un administrateur.</p><p>".$e->getMessage()."</p>");
}
finally{
	restore_error_handler();
}

?>