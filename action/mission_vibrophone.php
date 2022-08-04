<?php
// TOUTES LES INFOS ET DONNEES ONT ETE IMPORTES PAR LE SCRIPT data_mission.php QUI APPELLE CETTE PAGE !
// ON A LES INFOS DE MISSIONS, L'ETAT DES DONNEES ET LE TABLEAU DE COOKIE EST OK.
//id de la mission en cours : $_POST['mission']	
		//Lecture du cookie pour affichage du vibro
		$etat_vibro = read_cookie_vibro();	

		$hide_suivant_on_off = "";
		$hide_ecran_stop	 = "hide";
		if (intval($etat_vibro[ETAT_ON_OFF]) == 0)
		{
			$hide_suivant_on_off = "hide";
			$hide_ecran_stop	 = "";
		}
		?>	
		<div id="vibro_valeurs" class="hide" ><?php
			echo ($etat_vibro[ETAT_ON_OFF].$etat_vibro[ETAT_AIGUILLE].$etat_vibro[ETAT_CARRE].$etat_vibro[ETAT_POTAR1].$etat_vibro[ETAT_POTAR2]);?></div>
		<div id="mission_num" class="hide"><?php echo $key; ?></div>	
		<div id="solution_mission" class="hide"><?php echo $info_missions[$key][CODE][0];?></div>
		<div class="rowflex" style="display: block; position: relative; width: 98%; margin-left: 1%">
			<img id="vibrophone" class="" style="width:100%; z-index:1;" src="<?php echo IMG_VIBROPHONE; ?>" alt="vibrophone" />

			<!--- 			
			J'ai fait le choix d'un div par image. On ne fait donc que cacher et afficher des images.
			L'autre solution aurait été de changer des attributs à la volée... Peut être plus compliqué avec 
			le bouton on off par exemple qui ne s'affiche pas au même endroit... (Modification de son emplacement + de l'emplacement du clique + difficulté à bien gérer la zone cliquable de l'image puisqu'il s'agit toujours de carrés)
			Seuls survivors, les images qui tournent (aiguille + potars)

			Donc on a en sous couche l'image du Vibrophone
			Par dessus on ajoute toutes les images
			Et par dessus on ajoute toutes les zones cliquables

			Ensemble des images présentent sur le Vibrophone :
			--->							
			<div style="position: absolute; left: 0%; top: 0%; width:100%;">			
				<img id="img_vibro_ecran_actif" class="<?php echo $hide_suivant_on_off; ?>" style="position: relative; width:100%; z-index:2;" src="<?php echo $info_missions[$key][IMG_PUISSANCE_VIBRO];?>" alt="img_vibro_signal_<?php echo $info_missions[$key][PUISSANCE_VIBRO];?>" />
			</div>

			<div style="position: absolute; left: 0%; top: 0%; width:100%;">			
				<img id="img_vibro_ecran_noir" class="<?php echo $hide_ecran_stop; ?>" style="position: relative; width:100%; z-index:2;" src="<?php echo IMG_VIBRO_ECRAN_STOP;?>" alt="img_vibro_signal_<?php echo $info_missions[$key][PUISSANCE_VIBRO];?>" />
			</div>

			<?php
			if (intval($etat_vibro[ETAT_ON_OFF]) == 0)	//Sur off
			{
				?>
				<div style="position: absolute; left: 0%; top: 30%; width:100%;">			
					<img id="img_vibro_on" class="hide" style="position: relative; left: 81%; width:7%; z-index:5" src="<?php echo IMG_VIBRO_BTN_ON; ?>" alt="img_vibro_on" />
				</div>
				<div style="position: absolute; left: 0%; top: 34%; width:100%;">
					<img id="img_vibro_off" class="" style="position: relative; left: 81%; width:7%; z-index:6" src="<?php echo IMG_VIBRO_BTN_OFF; ?>" alt="img_vibro_off" />
				</div>
				<?php
			} else {
				?>				
				<div style="position: absolute; left: 0%; top: 30%; width:100%;">			
					<img id="img_vibro_on" class="" style="position: relative; left: 81%; width:7%; z-index:5" src="<?php echo IMG_VIBRO_BTN_ON; ?>" alt="img_vibro_on" />
				</div>
				<div style="position: absolute; left: 0%; top: 34%; width:100%;">
					<img id="img_vibro_off" class="hide" style="position: relative; left: 81%; width:7%; z-index:6" src="<?php echo IMG_VIBRO_BTN_OFF; ?>" alt="img_vibro_off" />
				</div>
				<?php
			}

			if (intval($etat_vibro[ETAT_ON_OFF]) == 0)
			{
				//Vibrophone éteint
				$aiguillage = "-62deg"; // Aiguille sur 1
			} else {
				$aiguillage = "0deg";
				Switch (intval($etat_vibro[ETAT_AIGUILLE])) {
					case 1 :
						$aiguillage = "-62deg";
						break;
					case 2 :
						$aiguillage = "-41deg";
						break;
					case 3 :
						$aiguillage = "-19.5deg";
						break;
					case 4 :
						$aiguillage = "2deg";
						break;
					case 5 :
						$aiguillage = "23.5deg";
						break;
					case 6 :
						$aiguillage = "44deg";
						break;
					case 7 :
						$aiguillage = "64deg";
						break;
					case 8 :
						$aiguillage = "84.5deg";
						break;
					default :
						break;
				}
			}
			?>
			<div style="position: absolute; left: 0%; top: 45%; width:100%;">				
				<img id="img_vibro_aiguille" class="" style="position: relative; transform:rotate(<?php echo $aiguillage;?>); left: 27%; width:45%; z-index:7" src="<?php echo IMG_VIBRO_AIGUILLE; ?>" alt="img_vibro_aiguille" />
			</div>

			<?php		
			if (intval($etat_vibro[ETAT_ON_OFF]) == 0)
			{
				$bouton_sur_on = 0;
			} else {
				$bouton_sur_on = intval($etat_vibro[ETAT_CARRE]);
			}

			if ($bouton_sur_on == 1) 
			{
				$afficher_on  = "";
				$afficher_off = "hide";
			} else {				
				$afficher_on  = "hide";
				$afficher_off = "";
			}
			?>		
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">			
				<img id="img_vibro_pad1_on" class="<?php echo $afficher_on; ?>" style="position: relative; left: 15%; width:16%; z-index:8" src="<?php echo IMG_VIBRO_PAD_ON; ?>" alt="img_vibro_pad1" />
			</div>	
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">			
				<img id="img_vibro_pad1_off" class="<?php echo $afficher_off; ?>" style="position: relative; left: 15%; width:16%; z-index:8" src="<?php echo IMG_VIBRO_PAD_OFF; ?>" alt="img_vibro_pad1" />
			</div>
			

			<?php			
			if ($bouton_sur_on == 2) 
			{
				$afficher_on  = "";
				$afficher_off = "hide";
			} else {				
				$afficher_on  = "hide";
				$afficher_off = "";
			}
			?>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad2_on" class="<?php echo $afficher_on; ?>" style="position: relative; left: 28.5%; width:16%; z-index:9" src="<?php echo IMG_VIBRO_PAD_ON; ?>" alt="img_vibro_pad2" />
			</div>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad2_off" class="<?php echo $afficher_off; ?>" style="position: relative; left: 28.5%; width:16%; z-index:9" src="<?php echo IMG_VIBRO_PAD_OFF; ?>" alt="img_vibro_pad2" />
			</div>

			<?php			
			if ($bouton_sur_on == 3) 
			{
				$afficher_on  = "";
				$afficher_off = "hide";
			} else {				
				$afficher_on  = "hide";
				$afficher_off = "";
			}
			?>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad3_on" class="<?php echo $afficher_on; ?>" style="position: relative; left: 42%; width:16%; z-index:10" src="<?php echo IMG_VIBRO_PAD_ON; ?>" alt="img_vibro_pad3" />
			</div>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad3_off" class="<?php echo $afficher_off; ?>" style="position: relative; left: 42%; width:16%; z-index:10" src="<?php echo IMG_VIBRO_PAD_OFF; ?>" alt="img_vibro_pad3" />
			</div>

			<?php			
			if ($bouton_sur_on == 4) 
			{
				$afficher_on  = "";
				$afficher_off = "hide";
			} else {				
				$afficher_on  = "hide";
				$afficher_off = "";
			}
			?>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad4_on" class="<?php echo $afficher_on; ?>" style="position: relative; left: 56.5%; width:16%; z-index:11" src="<?php echo IMG_VIBRO_PAD_ON; ?>" alt="img_vibro_pad4" />
			</div>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad4_off" class="<?php echo $afficher_off; ?>" style="position: relative; left: 56.5%; width:16%; z-index:11" src="<?php echo IMG_VIBRO_PAD_OFF; ?>" alt="img_vibro_pad4" />
			</div>

			<?php			
			if ($bouton_sur_on == 5) 
			{
				$afficher_on  = "";
				$afficher_off = "hide";
			} else {				
				$afficher_on  = "hide";
				$afficher_off = "";
			}
			?>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad5_on" class="<?php echo $afficher_on; ?>" style="position: relative; left: 70%; width:16%; z-index:12" src="<?php echo IMG_VIBRO_PAD_ON; ?>" alt="img_vibro_pad5" />
			</div>
			<div style="position: absolute; left: 0%; top: 62%; width:100%;">
				<img id="img_vibro_pad5_off" class="<?php echo $afficher_off; ?>" style="position: relative; left: 70%; width:16%; z-index:12" src="<?php echo IMG_VIBRO_PAD_OFF; ?>" alt="img_vibro_pad5" />
			</div>

			<?php
			if (intval($etat_vibro[ETAT_ON_OFF]) == 0)
			{
				//Vibrophone éteint
				$potar1 = "0deg"; // Aiguille sur 1
			} else {
				$potar1 = "0deg";
				Switch (intval($etat_vibro[ETAT_POTAR1])) {
					case 1 :
						$potar1 = "0deg";
						break;
					case 2 :
						$potar1 = "90deg";
						break;
					case 3 :
						$potar1 = "180deg";
						break;
					case 4 :
						$potar1 = "270deg";
						break;
					default :					
						break;
				}
			}
			?>
			<div style="position: absolute; left: 0%; top: 80.5%; width:100%;">
				<img id="img_vibro_potar1" class="" style="position: relative; transform:rotate(<?php echo $potar1;?>); left: 18%; width:13.5%; z-index:13" src="<?php echo IMG_VIBRO_POTAR_POS1; ?>" alt="img_vibro_potar1" />
			</div>

			<?php
			if (intval($etat_vibro[ETAT_ON_OFF]) == 0)
			{
				//Vibrophone éteint
				$potar2 = "0deg"; // Aiguille sur 1
			} else {
				$potar2 = "0deg";
				Switch (intval($etat_vibro[ETAT_POTAR2])) {
					case 1 :
						$potar2 = "0deg";
						break;
					case 2 :
						$potar2 = "90deg";
						break;
					case 3 :
						$potar2 = "180deg";
						break;
					case 4 :
						$potar2 = "270deg";
						break;
					default :					
						break;
				}
			}
			?>
			<div style="position: absolute; left: 0%; top: 80.5%; width:100%;">
				<img id="img_vibro_potar2" class="" style="position: relative; left: 42%; width:13.5%; transform: rotate(<?php echo $potar2;?>); z-index:14" src="<?php echo IMG_VIBRO_POTAR_POS1; ?>" alt="img_vibro_potar2" />
			</div>
	
   			<div style="position: absolute; left: 0%; top: 80%; width:100%;">
				<img id="img_vibro_play" class="" style="position: relative; left: 65%; width:17%; z-index:15" src="<?php echo IMG_VIBRO_PLAY; ?>" alt="img_vibro_play" />
			</div> 

			<!--- Ensemble des zones cliquables --->
			<div style="position: absolute; left: 0%; top: 0%; width:100%; height:100%;">
				<a class="vibro_cercle point_actif" style="top: 30%; left: 80%; width:10%; height:10%; z-index:50;" href="#" id="vibro_on_off"></a>
				<a class="vibro_cercle pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 48.5%; left: 11%; width:11%; height:7%; z-index:51;" href="#" id="vibro_moins"></a>
				<a class="vibro_cercle pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 48.5%; left: 76.5%; width:11%; height:7%; z-index: 52;" href="#" id="vibro_plus"></a>

				<a class="vibro_carre pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 64%; left: 18%; width:11%; height:7%; z-index:53;" href="#" id="vibro_bouton_1"></a>
				<a class="vibro_carre pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 64%; left: 32%; width:11%; height:7%; z-index:54;" href="#" id="vibro_bouton_2"></a>
				<a class="vibro_carre pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 64%; left: 45.5%; width:11%; height:7%; z-index:55;" href="#" id="vibro_bouton_3"></a>
				<a class="vibro_carre pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 64%; left: 59%; width:11%; height:7%; z-index:56;" href="#" id="vibro_bouton_4"></a>
				<a class="vibro_carre pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 64%; left: 73%; width:11%; height:7%; z-index:57;" href="#" id="vibro_bouton_5"></a>			

				<a class="vibro_potar pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 80.5%; left: 18%; width:15%; height:10%; z-index:58;" href="#" id="vibro_potar_1"></a>
				<a class="vibro_potar pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 80.5%; left: 42%; width:15%; height:10%; z-index:59;" href="#" id="vibro_potar_2"></a>
				<a class="vibro_potar pour_desactivation <?php echo $hide_suivant_on_off;?>" style="top: 80.5%; left: 65%; width:15%; height:10%; z-index:60;" href="#" id="vibro_play"></a>
			</div>
		</div>

		<?php		
		if ($info_missions[$key][HAS_MISSION_LINK])
		{
			//echo "blabla 1 : ".$info_missions[$key][MISSION_LINK];
			$link = $info_missions[$key][MISSION_LINK];
			?>		
			
			<div class="row marge0 mb-3">
				<div class="col-6">
				</div>

				<div class="col-6">
					<a href="#" id="zone_next" class="button fontbutton link hide" title="<?php echo $link; ?>"><?php echo $info_missions[$key][MISSION_LINK_BUTTON_NAME]; ?></a>
				</div>
			</div>
			<?php
		}		
		?>						
		<?php ecrire_indice($info_missions[$key], $key); ?>