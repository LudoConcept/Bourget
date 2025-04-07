<?php
/*
Ce fichier contient l'ensemble des fonctions en php
*/

function isActive($avancement_mission){
	return $avancement_mission == ACTIVE;
}

function startgame($etat_missions, $liste){
	$longueur = count($liste);
	for ($i=0; $i < $longueur; $i++) {
		$etat_missions[$liste[$i]] = ACTIVE;
	}
	return $etat_missions;
}

/* Retourne true si $code est dans les solutions de la mission */
function isCodeValid($current_mission, $code) {
	return in_array($code, $current_mission[CODE]);
}

function isErrorCode($current_mission, $code_faux){
	// renvoie la clef à afficher dans les message de validation d'erreur.
	$ret = array_search($code_faux, $current_mission[ERREUR_CODE]);
	if ($ret === false)
		return 0;
	else
		return $ret;
}

function isFinished($avancement_mission) {
	return $avancement_mission == FINISH;
}

function isEspritTerminated($etat_missions) {
	$retour = false;
	if (($etat_missions[ESPRIT01] == FINISH) && ($etat_missions[ESPRIT02] == FINISH) && ($etat_missions[ESPRIT03] == FINISH) && ($etat_missions[ESPRIT04] == FINISH) && ($etat_missions[ESPRIT05] == FINISH) && ($etat_missions[ESPRIT06] == FINISH))
	{				
		$retour = true;
	} else {
		if (($etat_missions[ESPRIT02] != FINISH) && ($etat_missions[STATUE_EXVOTO] == FINISH))
		{
			$etat_missions[ROSES] = ACTIVE;
		}
	}
	return $retour;
}

//Valide la fin d'une mission et débloque la suite
function finirMission($etat_missions, $key) {
	// $key est le numéro de la mission
	$etat_missions[$key] = FINISH;
	switch($key) {
		case MOT_DE_PASSE:
			$etat_missions[MOT_DE_PASSE_OK] = ACTIVE;						
			break;
		case MOT_DE_PASSE_OK:			
			$etat_missions[RDV_MOUTARDE] = ACTIVE;
			break;	
		case RDV_MOUTARDE:
			$etat_missions[VIBRO1] = ACTIVE;									
			break;
		case VIBRO1:			
			break;
		case APPARITION:										
			$etat_missions[RDV_MOUTARDE] = FINISH;			
			$etat_missions[GLORIETTES1] = ACTIVE;	
			$etat_missions[GLORIETTES2] = ACTIVE;	
			$etat_missions[GLORIETTES3] = ACTIVE;	
			$etat_missions[GLORIETTES4] = ACTIVE;	
			$etat_missions[VIBRO2] = ACTIVE;
			$etat_missions[VIBRO4] = ACTIVE;
			$etat_missions[VIBRO6] = ACTIVE;												
			$etat_missions[REINE_ROI] = ACTIVE;
			$etat_missions[VIBRO7] = ACTIVE;
			break;			
		case GLORIETTES1:								
			$etat_missions[GLORIETTES2] = FINISH;
			$etat_missions[GLORIETTES3] = FINISH;
			$etat_missions[GLORIETTES4] = FINISH;
			break;
		case GLORIETTES2:					
			$etat_missions[GLORIETTES1] = FINISH;			
			$etat_missions[GLORIETTES3] = FINISH;
			$etat_missions[GLORIETTES4] = FINISH;
			break;
		case GLORIETTES3:					
			$etat_missions[GLORIETTES1] = FINISH;
			$etat_missions[GLORIETTES2] = FINISH;			
			$etat_missions[GLORIETTES4] = FINISH;
			break;
		case GLORIETTES4:					
			$etat_missions[GLORIETTES1] = FINISH;
			$etat_missions[GLORIETTES2] = FINISH;
			$etat_missions[GLORIETTES3] = FINISH;			
			break;
		case ESPRIT01:
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}
			break;
		case VIBRO2:
			$etat_missions[ROSES] = ACTIVE;
			break;
		case STATUE_EXVOTO:			
			$etat_missions[ROSES] = ACTIVE;				
			break;
		case ROSES:						
			break;
		case ESPRIT02:
			if (ROSIER_CRASH) {
				$etat_missions[ROSES] = FINISH;
			}
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}
			break;
		case VIBRO3:	
			$etat_missions[VIBRO4] = ACTIVE;					
			break;
		case LAVOIR1:			
			break;
		case VIBRO4:
			$etat_missions[VIBRO5] = ACTIVE;		
			break;
		case LAVOIR2:
			if ($etat_missions[LAVOIR1] == ACTIVE) {
				$etat_missions = finirMission($etat_missions, VIBRO3);
				$etat_missions = finirMission($etat_missions, LAVOIR1);
			}						
			break;
		case VIBRO5:
			$etat_missions[DICK] = ACTIVE;			
			break;
		case DICK:								
			break;
		case ESPRIT03:
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}
			break;
		case VIBRO6:		
			break;		
		case STATUE_FOND:
			$etat_missions[STATUE_FOND_2] = ACTIVE;			
			break;
		case STATUE_FOND_2:	
			$etat_missions[ESPRIT04] = ACTIVE;		
			break;
		case ESPRIT04:
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}		
			break;
		case REINE_ROI:			
			break;
		case REPRODUIRE_REINE:
			$etat_missions[REINE_ROI] = FINISH;
			$etat_missions[REPRODUIRE_ROI] = ACTIVE;			
			break;
		case REPRODUIRE_ROI:
			$etat_missions[ESPRIT05] = ACTIVE;			
			break;
		case ESPRIT05:
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}			
			break;
		case VIBRO7:			
			break;
		case STATUE_CENTRE:	
			$etat_missions[STATUE_CENTRE_2] = ACTIVE;		
			break;
		case STATUE_CENTRE_2:
			$etat_missions[ESPRIT06] = ACTIVE;			
			break;
		case ESPRIT06:
			if (isEspritTerminated($etat_missions)) {
				$etat_missions[ESPRIT_FIN] = ACTIVE;
			}			
			break;
		case ESPRIT_FIN:
			$etat_missions[FIN_DE_GAME] = ACTIVE;			
			break;
		case FIN_DE_GAME:			
			break;		
	}
	return $etat_missions;
}

function creer_bouton_code($type_code, $tab_spec, $col){
	$length = count($tab_spec); ?>
			<input type="hidden" id="type_code" value="<?php echo $type_code; ?>">
<?php
	for ($i=0; $i < $length; $i++) { ?>
			<div class="col-<?php echo $col; ?> mt-2"><button class="<?php if ($type_code != "couleur") echo "bouton-corps "; echo $type_code." ".$type_code."-".$i; ?>" title="<?php echo $i; ?>"><?php echo $tab_spec[$i]; ?></button></div>
<?php
	}
}

function ecrire_indice($current_mission, $num){
	$size = count($current_mission[CLUE]);
	$clues = "";
	$buttons = "";
	for ($i=0; $i < $size; $i++) {
	////// IMPORTANT : 	Si on ajoute des class au BOUTON revelclue ci-dessous, les ajouter AVANT revealclue_$i
	////// 				Et ne pas ajouter de class dont le nom comporte un underscore (truc_machin, etc...)
		$buttons = $buttons."
			<div class=\"col-4\">
				<button class=\"bouton-corps font-inherit mt-2 revealclue revealclue_$i\">".INDICE." ".($i+1)."</button>
			</div>";
		$clues = $clues."
			<div class=\"displayclue displayclue-$i col-12\">
				".$current_mission[CLUE][$i]."
			</div>";	
	}
			// POSSIBILITE D'AJOUTER UN if ($clues == "") { ... } pour ajouter un bouton de fermeture, par exemple.
	?>

	<!-- Ajout des id des 2 div suivantes par LM pour hide dans mission_vibrohpone.js --->
		<div class="row marge0 mb-3 text-center" id="zone_indices">
			<?php echo $clues; ?>
		</div>
		<div class="row marge0 mb-3 text-center" id="zone_boutons_indices">
			<?php echo $buttons; ?>
		</div>
		
<?php
}

function ecrire_zone_code($current_mission, $num){
	switch ($current_mission[TYPE_CODE]) {
		case CODE_DIRECTION: ?>
		<div class="row marge0">
			<div class="col-12">
				<label><?php echo $current_mission[QUESTION]; ?></label>
			</div>
			<div class="col-12 text-center">
				<p id="solution_visible" class="text_direction"></p>
			</div>
			<input type="hidden" id="mission_name" value="<?php echo $num; ?>">
			<div class="col-6 text-center"><button class="bouton-corps solve" name="<?php echo $num; ?>"><?php echo LIB_BTN_VALIDER; ?></button></div>
			<div class="col-6 text-center"><button class="bouton-corps clean"><?php echo LIB_BTN_EFFACER; ?></button></div>
			<input type="hidden" id="answer" class="answer" name="answer">
		</div>
		<div class="row marge0 text-center" id="creer_code"><?php
		creer_bouton_code("direction", $current_mission[SPEC_CODE], 3);
		?>
		</div>
		<hr>
		<?php
			break;
		case CODE_COULEUR: ?>
		<div class="row marge0">
			<div class="col-12">
				<label><?php echo $current_mission[QUESTION]; ?></label>
			</div>
			<div class="col-12 text-center">
				<p id="solution_visible" class="text_couleur"></p>
			</div>
			<input type="hidden" id="mission_name" value="<?php echo $num; ?>">
			<div class="col-6 text-center"><button class="bouton-corps solve" name="<?php echo $num; ?>"><?php echo LIB_BTN_VALIDER; ?></button></div>
			<div class="col-6 text-center"><button class="bouton-corps clean"><?php echo LIB_BTN_EFFACER; ?></button></div>
			<input type="hidden" id="answer" class="answer" name="answer">
		</div>
		<div class="row marge0 mt-2 text-center" id="creer_code"><?php
		creer_bouton_code("couleur", $current_mission[SPEC_CODE], 4);
		?>
		</div>
		<hr>
		<?php
			break;
		case CODE_STANDARD:
		default: ?>
		<form class="w100 mb-3">
			<div class="row marge0">
			
				<div class="col-6">
					<label><?php echo $current_mission[QUESTION]; ?></label>
				</div>
				<div class="col-6">
					<input type="text" id="answer" class="answer" name="answer" placeholder="<?php echo $current_mission[PLACEHOLDER]; ?>" />
				</div>
				<div class="col-12 mt-2 solve-div">
					<input type="hidden" id="mission_name" value="<?php echo $num; ?>">
					<button class="bouton-corps solve" name="<?php echo $num ?>"><?php echo LIB_BTN_VALIDER; ?></button>
				</div>
			</div>
		</form>
		<?php
			break;
	}
}
?>