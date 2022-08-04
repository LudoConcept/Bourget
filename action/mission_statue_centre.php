<?php
// TOUTES LES INFOS ET DONNEES ONT ETE IMPORTES PAR LE SCRIPT data_mission.php QUI APPELLE CETTE PAGE !
// ON A LES INFOS DE MISSIONS, L'ETAT DES DONNEES ET LE TABLEAU DE COOKIE EST OK.
//id de la mission en cours : $_POST['mission']
		
		$etat_poi_map = read_cookie_poi_map();
		$fini = "Non";
		if ($etat_poi_map == SOLUTION_MAP) {
			$fini = "Oui";
			$txt = "<p class=\"text-esprit\">Merci d'avoir rétabli la réalité !<br>Je comprend mieux ce qu'elle souhaitait nous expliquer...<br>Notre mémoire nous fait peu à peu défaut avec le temps,<br>ce qui a dû entrainer ces perturbants éléments.<br>Une autre explication serait...<br>Que le cerveau de cette statue ne marche pas comme il devrait !</p>";
				$etatmissions = finirMission($etatmissions, $key);
				createCookie(COOKIE_MISSIONS, serialize($etatmissions));				
		}
		else
		{
			$txt = "<p class=\"text-esprit\">Nous n'y sommes pas encore !<br>Le murmure disait<br><br></p><p class=\"text-couleur\">J'ai un défi pour vous, voyons voir si votre mémoire vous permettra de dissiper les anomalies qui se sont glissées sur la carte.</p><br><p class=\"text-esprit\">Il doit rester des anomalies.</p>";			
		}				

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
					<?php echo $txt; ?>			
				</div>
			</div>	
			<?php
		} else {			
			?>
			<div class="row marge0 mb-3">
				<div class="col-12">
					<img class="visuel_mission" src="./images/<?php echo $info_missions[$key][VISUEL]; ?>" alt="		<?php echo $info_missions[$key][IMG_ALT]; ?>">
						<?php echo $txt; ?>			
					</div>
				</div>
			</div>
		<?php
		}

		if ($fini == "Oui")
		{
			if ($info_missions[$key][HAS_MISSION_LINK])
			{
				$link = $info_missions[$key][MISSION_LINK];
				?>
				<div class="row marge0 mb-3">
					<div class="col-6">
					</div>

					<div class="col-6">
						<a href="#" class="button fontbutton link" title="<?php echo $link; ?>"><?php echo "Oh ?!"; ?></a>
					</div>
				</div>
				<?php
			}
		} else {
			ecrire_indice($info_missions[$key], $key);
		}	
		?>