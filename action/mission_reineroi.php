<?php
// TOUTES LES INFOS ET DONNEES ONT ETE IMPORTES PAR LE SCRIPT data_mission.php QUI APPELLE CETTE PAGE !
// ON A LES INFOS DE MISSIONS, L'ETAT DES DONNEES ET LE TABLEAU DE COOKIE EST OK.
//id de la mission en cours : $_POST['mission']

$origine = "null";
$txt_reineroi = "";
if ($key == REPRODUIRE_REINE)
{
	$origine = "reine";
	$txt_reineroi = "Reproduisez la Reine en cliquant sur les différentes branches d'arbre.";
}
if ($key == REPRODUIRE_ROI)
{
	$origine = "roi";	
	$txt_reineroi = "Passons au Roi maintenant.<br>";
}
?>			

		<div id="origine" class="hide"><?php echo $origine; ?></div>
		
		<div id="haut" class="hide">1</div>
		<div id="milieu" class="hide">3</div>
		<div id="bas" class="hide">8</div>

		<div id="txt_reineroi" class="marge4"><?php echo $txt_reineroi; ?></div>
		<div class="rowflex" style="display: block; position: relative; width: 98%; margin-left: 1%">

			<div style="position: absolute; left: 0%; top: 7%; width:96%; height:96%; z-index:1; margin-left: 2%;">		
				<img id="fond_blanc" class="" style="position: relative; width:100%;  opacity:0.3;" src="./images/Fond_blanc.png" alt="fond_blanc" />
			</div>

			<img id="fond_reine" class="" style="position: relative; width:100%; z-index:2;" src="<?php echo FOND_TRONC; ?>" alt="Reine" />			

			<div style="position: absolute; left: 0%; top: 0%; width:100%; height:100%;">				
				<a id="royal_haut" class="arbres_royaux point_actif" style="top: 7%; left: 0%; width:100%; height:27%; z-index:50;" href="#" ></a>

				<a id="royal_milieu" class="arbres_royaux point_actif" style="top: 34%; left: 0%; width:100%; height:27%; z-index:51;" href="#" ></a>

				<a id="royal_bas" class="arbres_royaux point_actif" style="top: 61%; left: 0%; width:100%; height:27%; z-index:52;" href="#" ></a>
			</div>	

			<div style="position: absolute; left: 0%; top: 7%; width:90%; margin-left: 5%">			
				<img id="img_haut" class="" style="position: relative; width:100%; z-index:3" src="<?php echo IMG_ROYAL; ?>1.png" alt="img_arbre_haut" />
			</div>

			<div style="position: absolute; left: 0%; top: 34%; width:90%; margin-left: 5%">			
				<img id="img_milieu" class="" style="position: relative; width:100%; z-index:4" src="<?php echo IMG_ROYAL; ?>3.png" alt="img_arbre_milieu" />
			</div>

			<div style="position: absolute; left: 0%; top: 61%; width:90%; margin-left: 5%">			
				<img id="img_bas" class="" style="position: relative; width:100%; z-index:5" src="<?php echo IMG_ROYAL; ?>8.png" alt="img_arbre_bas" />
			</div>	
		</div>

		<?php		

		if ($info_missions[$key][HAS_MISSION_LINK])
		{
			$link = $info_missions[$key][MISSION_LINK];
			?>
			<br>
			<div class="row marge0 mb-3">
				<div class="col-6">
				</div>

				<div class="col-6">
					<a href="#" class="button fontbutton link hide zone_next" title="<?php echo $link; ?>"><?php echo $info_missions[$key][MISSION_LINK_BUTTON_NAME]; ?></a>
				</div>
			</div>
			<?php
		}
			
		?>						
		<?php ecrire_indice($info_missions[$key], $key); ?>