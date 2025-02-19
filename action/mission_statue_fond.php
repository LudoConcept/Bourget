<?php
// TOUTES LES INFOS ET DONNEES ONT ETE IMPORTES PAR LE SCRIPT data_mission.php QUI APPELLE CETTE PAGE !
// ON A LES INFOS DE MISSIONS, L'ETAT DES DONNEES ET LE TABLEAU DE COOKIE EST OK.
//id de la mission en cours : $_POST['mission']

$arbre_coupe = "<br><br>N'oubliez pas&nbsp;!<br>Le premier arbre a été coupé. Malgré tout il reste parfaitement reconnaissable.";

		//Lecture du cookie pour affichage du vibro
		$etat_poi_arbres = read_cookie_poi_arbres();
		$nb_val_1		 = 0;
		$txt			 = "";
		$fini 	 		 = "Non";
		for ($i = 0; $i <= 14; $i++)
		{ 
			$val_poi_arbre = substr($etat_poi_arbres,$i,1);
			if ($val_poi_arbre == 1) {
				$nb_val_1 ++;
			}
		}

		if ($nb_val_1 == 8 || $nb_val_1 == 7) {
			//C'est le bon nombre d'arbre, on vérifie qu'il s'agit bien des 8 bons (id de 1 à 8)
			$val_poi_arbre = substr($etat_poi_arbres,1,8);
			// L'arbre 1, la racine, a été coupé. On valide même si la racine est out.
			if ($val_poi_arbre == "11111111" || $val_poi_arbre == "10111111" || $val_poi_arbre == "12111111") {
				//ok mission terminée
				$fini = "Oui";
				$txt = "Toutes mes félicitations !!<br>Ne sont ils pas trop mignons,<br>gigantesques, tortueux,<br>hypnotisant, prodigieux ??<br>Ces arbres ont été planté,<br>il y a des dizaines et des dizaines d'années,<br>à eux seuls ils protègent les Jardins du Prieuré,<br> de tous les malheurs qui pourraient leur arriver.<br>Chaque branche raconte sa propre histoire,<br>nous invite à la contemplation et partage son savoir.";
				$etatmissions = finirMission($etatmissions, $key);
				createCookie(COOKIE_MISSIONS, serialize($etatmissions));				
				fin_cookie_poi_arbres();
			}
			else
			{
				$txt = "Cette quête aux arbres n'est pas une mince affaire, vous en avez trouvé 8, c'est très bien mais ce ne sont pas les 8 que vous avez en photo...<br>Repartez en chasse à ces 8 fantastiques !".$arbre_coupe;
				
			}
		} else {
			if ($nb_val_1 > 8) {
				$txt = "Cette quête aux arbres n'est pas une mince affaire, vous en avez trouvé ".$nb_val_1.", c'est un peu trop, vous n'en avez que 8 à trouver !<br>Repartez en chasse à ces 8 fantastiques !".$arbre_coupe;
			} else {
				if ($nb_val_1 == 0) {
					$txt = "Vous n'avez trouvé aucun arbre ?<br>Revenez lorsque vous aurez trouvé les 8 arbres qui correspondent aux photos que vous avez !".$arbre_coupe;
				} else {
					$txt = "Cette quête aux arbres n'est pas une mince affaire, vous en avez trouvé ".$nb_val_1.", c'est très bien mais il vous en manque encore...<br>Repartez en chasse à ces 8 fantastiques !".$arbre_coupe;
				}				
			}
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
						<a href="#" class="button fontbutton link" title="<?php echo $link; ?>"><?php echo $info_missions[$key][MISSION_LINK_BUTTON_NAME]; ?></a>
					</div>
				</div>
				<?php
			}
		} else {
			ecrire_indice($info_missions[$key], $key);
		}	
		?>