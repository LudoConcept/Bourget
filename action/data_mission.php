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

	if (cookieExists(COOKIE_MISSIONS) && isset($_POST['mission']) && ($_POST['mission'] != "") && is_numeric($_POST['mission']) && (intval($_POST['mission']) >= 1) && (intval($_POST['mission']) <= NBR_MISSIONS) ) {
		$key = $_POST['mission'];
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		
		//On termine automatiquement les missions avec AUTOFINISH => true
		if ($info_missions[$key][AUTOFINISH]) {
			$etatmissions = finirMission($etatmissions, $key);
			createCookie(COOKIE_MISSIONS, serialize($etatmissions));
		}

				
		
		//Missions avec STANDARD => true
		//Concerne toutes les missions avec un affichage standardisé
		if ($info_missions[$key][STANDARD])
		{
			//Missions avec VISUEL => SPECIAL_ESPRIT
			//Concerne toutes les missions d'esprit (=juste de l'affichage)
			if ($info_missions[$key][VISUEL] == SPECIAL_ESPRIT)
			{
				$val_cook = $_COOKIE[COOKIE_ESPRIT];
				$nb_esprit = nb_cookie_esprit_ok($val_cook);
				?>
				<div class="row marge0 mb-3">
					<div class="col-12">
						<div class="rowflex" style="display: block; position: relative; width: 99%; margin-left: 1%">
						<img class="visuel_mission" src="<?php echo $etape_esprit[0][ESPRIT_IMG]; ?>" alt="esprit_0">

							<?php								
							for ($i=1;$i<$nb_esprit;$i++)
							{
								?>
								<div style="position: absolute; left: 0%; top: 0%; width:100%;">			
									<img id="esprit_<?php echo $i; ?>" class="" style="position: relative; width:50%; z-index:<?php echo $i; ?>;" src="<?php echo $etape_esprit[$i][ESPRIT_IMG];?>" alt="esprit_<?php echo $i; ?>" />
								</div>
								<?php
							}			
							?>
					</div>
						<?php echo $info_missions[$key][DESC]; ?>
					</div>
				</div>	
				<?php
			} else {
				//
				?>
				<h2 class="text-center m-3"><?php echo $info_missions[$key][TITLE]; ?></h2>
				<div class="row marge0 mb-3">
					<div class="col-12">
						<img class="visuel_mission" src="./images/<?php echo $info_missions[$key][VISUEL]; ?>" alt="	<?php echo $info_missions[$key][IMG_ALT]; ?>">
						<?php echo $info_missions[$key][DESC]; ?>			
					</div>
				</div>
				<?php								
			}

			if ($info_missions[$key][HAS_MISSION_LINK])
			{
				$link = $info_missions[$key][MISSION_LINK];
				?>
				<div class="row marge0 mb-3">
					<div class="col-6">
					</div>

					<div class="col-6">
						<a href="#" class="button fontbutton link" title="<?php echo $link; ?>"><?php echo $info_missions[$key][MISSION_LINK_BUTTON_NAME]; ?></a>
					</div>
				</div>
				<?php
			}		
			
			if (($etatmissions[$key] == ACTIVE) && ($info_missions[$key][VISUEL] != ESPRIT_FINAL))
			{
				if ($info_missions[$key][HAS_CODE])
				{
					ecrire_zone_code($info_missions[$key], $key); ?>
					<div id="resultat">
					</div>
					<?php
				}
				ecrire_indice($info_missions[$key], $key);
			}
		} else { // MISSION NON STANDARD
			include('./mission_'.$key.'.php');
		}
			
	} else {
		throw new Exception("Les cookies n'ont pas été trouvé. Je crains qu'il ne faille <a href=\"./\">redémarrer le jeu...</a>");
	}
}
catch(Throwable $e){
	echo "<p>Une erreur est survenue. Vous pouvez essayer de rafraichir la page.</p><p>".$e->getMessage()."</p>";
}
finally{
	restore_error_handler();
}
?>