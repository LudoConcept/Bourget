<?php
// TOUTES LES INFOS ET DONNEES ONT ETE IMPORTES PAR LE SCRIPT data_mission.php QUI APPELLE CETTE PAGE !
// ON A LES INFOS DE MISSIONS, L'ETAT DES DONNEES ET LE TABLEAU DE COOKIE EST OK.
//id de la mission en cours : $_POST['mission']

//On check qu'on a trouvé cet esprit :
$nb_esprit = maj_cookie_esprit($CORRESPONDANCE_MISSION[$key][POSITION]);
//On compte combien ont été trouvé jusqu'à maintenant :
//$nb_esprit = nb_cookie_esprit_ok();
//echo "nb_esprit : ".$nb_esprit;

if ($nb_esprit == 1) {
	//Au premier passage on ajoute cette balise pour qu'elle soit détectée quand on sortira pour l'affichage du bouton Esprit
	?>
	<div id="premier_passage" class="hide"></div>
	<?php
}

if ($key == ESPRIT_FIN) {
	$etat_rep = read_cookie_question();
	if ($etat_rep == "start") {
		$long_rep = 0;
		$etat_rep = "";
	} else {
		$long_rep = strlen($etat_rep);	
	}	
	if ($long_rep == (NB_QUESTIONS+1)) {
		//Si on a déjà fini le jeu mais qu'on rafraichit la page.
		//Récupérer les infos dans le cookie (TODO)
	}		
	?>
	<!--- save_rep permet de mémoriser les réponses -->
	<div id="save_rep" class="hide"><?php echo $etat_rep; ?></div>
	<!--- etape_rep permet de mémoriser le nb de réponses déjà donné -->
	<div id="etape_rep" class="hide"><?php echo $long_rep; ?></div>

	<?php
	// Bloc questions
	for ($j=0;$j<=NB_QUESTIONS;$j++)
	{
		$faut_il_hide = "hide";
		if ($j == $long_rep) {
			$faut_il_hide = "";
		}
		?>
		<div id="bloc_question<?php echo $j; ?>" class="<?php echo $faut_il_hide; ?>" style="margin-left: 3%">
			<?php echo $QUESTIONS_FIN[$j]; ?>
		</div>
		<?php
	}
	?>
	<br>	
	<div id="bloc_reponse" class="row marge0 mb-3">
		<div class="col-12">
			<div class="rowflex" style="display: block; position: relative; width: 99%; margin-left: 1%">
			<img id="fond_fin" class="fin_question" style="width:100%; z-index:1;" src="<?php echo FOND_QUESTION; ?>" alt="bloc_question">

				<?php 
				// Ici on affiche toutes les réponses
				for ($j=0;$j<=NB_QUESTIONS;$j++)
				{
					$faut_il_hide = "hide";
					if ($j == $long_rep) {
						$faut_il_hide = "";
					}
					?>
					<div id="txt_repA_<?php echo $j; ?>" class="<?php echo $faut_il_hide; ?>" style="position: absolute; left: 25%; top: 8.5%; width:100%; line-height:1.25em;">			
						<?php echo $REPONSES_QUESTION[$j][1]; ?>
					</div>
					<div id="txt_repB_<?php echo $j; ?>" class="<?php echo $faut_il_hide; ?>" style="position: absolute; left: 42.5%; top: 31%; width:100%; line-height:1.25em;">			
						<?php echo $REPONSES_QUESTION[$j][2]; ?>
					</div>
					<div id="txt_repC_<?php echo $j; ?>" class="<?php echo $faut_il_hide; ?>" style="position: absolute; left: 25%; top: 54%; width:100%; line-height:1.25em;">			
						<?php echo $REPONSES_QUESTION[$j][3]; ?>
					</div>
					<div id="txt_repD_<?php echo $j; ?>" class="<?php echo $faut_il_hide; ?>" style="position: absolute; left: 42.5%; top: 77.5%; width:100%; line-height:1.25em;">			
						<?php echo $REPONSES_QUESTION[$j][4]; ?>
					</div>
					<?php
				}
				?>
				
				
				<div style="position: absolute; left: 0%; top: 0%; width:100%; height:100%;">
					<a class="carre select_rep" style="top: 7%; left: 0%; width:100%; height:20%; z-index:50;" href="#" id="A"></a>
					<a class="carre select_rep" style="top: 30%; left: 15%; width:85%; height:20%; z-index:50;" href="#" id="B"></a>
					<a class="carre select_rep" style="top: 52%; left: 0%; width:100%; height:20%; z-index:51;" href="#" id="C"></a>
					<a class="carre select_rep" style="top: 75%; left: 15%; width:85%; height:20%; z-index:50;" href="#" id="D"></a>
				</div>
			<!--- ajouter le système de mémorisation des réponses
				puis dupliquer sur la page afficher_esprit -->
			</div>
		</div>
	</div>
	<?php
} else {
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
			$i = $i - 1;	
			?>
		</div>
		<?php 
		//echo "texte i : ".$i;
		echo $etape_esprit[$i][ESPRIT_TXT];		
		?>
	</div>
	<?php
	if ($i == 6) {			
		$link = ESPRIT_FIN;
		?>		
		
		<div class="row marge0 mb-3">
			<div class="col-6">
			</div>

			<div class="col-6">
				<a href="#" id="finale_next" class="button fontbutton link" title="<?php echo $link; ?>"><?php echo "Il est temps de voir ce que vous avez retenu"; ?></a>
			</div>
		</div>
		<?php							
	}
	?>
</div>
<?php
}
?>