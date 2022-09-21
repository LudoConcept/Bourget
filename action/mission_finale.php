<?php
//Le jeu est terminé !
$temps_stock = read_cookie_fin_de_game();
$temps_depart = read_cookie_timer();
if ($temps_stock == "InGame") 
{
	$temps_fin = time();
	createCookie("bourget_end", $temps_fin);
	$temps_en_sec = $temps_fin - $temps_depart;							
	maj_cookie_fin_de_game($temps_en_sec);
} else {
	$temps_en_sec = $temps_stock;
	$temps_fin = $_COOKIE["bourget_end"];
}
$save_temps_en_sec = $temps_en_sec;
?>

<h2 class="text-center m-3"><?php echo $info_missions[$key][TITLE]; ?></h2>
<div class="row marge0 mb-3">
	<div class="col-12">
		<img class="visuel_mission" src="./images/<?php echo $info_missions[$key][VISUEL]; ?>" alt="	<?php echo $info_missions[$key][IMG_ALT]; ?>">
		<?php echo $info_missions[$key][DESC]; ?>			
	</div>
</div>

<div class="row marge0 mb-3">
	<div class="col-12">		
		<?php
		//echo "<br>Nombre de secondes écoulées : ".$temps_en_sec."<br>";
		// Transformation Secondes en Jour Heure minute seconde
		$Jour = 0;
		$Heure = 0;
		$Minute = 0;
		while ($temps_en_sec >= 86400)
		{$Jour = $Jour + 1; $temps_en_sec = $temps_en_sec - 86400;}
		while ($temps_en_sec >= 3600)
		{$Heure = $Heure + 1; $temps_en_sec = $temps_en_sec - 3600;}
		while ($temps_en_sec >= 60)
		{$Minute = $Minute + 1; $temps_en_sec = $temps_en_sec - 60;}
		
		// Ajout des zéros au cas où l'affichage soit en dessous de 10
		if ($Heure < 10)
		{$Heure = '0'.$Heure;}
		if ($Minute < 10 AND $Minute > 0)
		{$Minute = '0'.$Minute;}
		if ($Minute == 0)
		{$Minute = '00';}
		if ($temps_en_sec < 10)
		{$temps_en_sec = '0'.$temps_en_sec;}

		// Retourne une variable la plus petite possible
		if ($Jour > 0) {
			$affichage_final = "Vous avez mis plus d'une journée, vous devez être épuisé !";
		} elseif ($Heure > 0) {
			$affichage_final = "Vous avez mis<br><p class=\"text-couleur-center\">".$Heure.':'.$Minute.":".$temps_en_sec."</p>";
		} else {
			$affichage_final = "Vous avez mis<br><p class=\"text-couleur-center\">".$Minute.":".$temps_en_sec."</p>";				
		}
			
		echo $affichage_final;

		$rep = read_cookie_question();
		$solution = "CDBBDD";
		$nb_juste = 0;
		for ($i=0;$i<=NB_QUESTIONS;$i++)
		{ 
			if (substr($rep,$i,1) == substr($solution,$i,1)) 
			{								
				$nb_juste ++;
			}
		}
		$nb_fausse = NB_QUESTIONS + 1 - $nb_juste;
		echo "Chaque bonne réponse vous fait gagner 1 minute alors que chaque mauvaise réponse vous fait perdre 1 minute et 30 secondes.";
		$temps_juste = $nb_juste * 60 * -1;
		$temps_fausse = $nb_fausse * 90;
		if ($nb_juste == 0) {
			echo "<br><p class=\"text-couleur\">Quoi ?! Vous n'avez donné aucune bonne réponse ??</p>";
		} else {
			if ($nb_fausse == 0) {
				echo "<br><p class=\"text-couleur\">Vous avez trouvé toutes les bonnes réponses ?? Waaaahouuuuuu !!</p>";
			}	
		}
		echo "Il est temps de calculer votre score final !<br>";
		echo "<br>Réponses correctes : ".$nb_juste.". Ce qui nous donne -".$temps_juste." secondes.";
		echo "<br>Réponses fausses : ".$nb_fausse.". Ce qui nous donne +".$temps_fausse." secondes.";
		$temps_en_sec = $save_temps_en_sec + $temps_juste + $temps_fausse;
		$duree = $temps_en_sec;
		$Jour = 0;
		$Heure = 0;
		$Minute = 0;
		while ($temps_en_sec >= 86400)
		{$Jour = $Jour + 1; $temps_en_sec = $temps_en_sec - 86400;}
		while ($temps_en_sec >= 3600)
		{$Heure = $Heure + 1; $temps_en_sec = $temps_en_sec - 3600;}
		while ($temps_en_sec >= 60)
		{$Minute = $Minute + 1; $temps_en_sec = $temps_en_sec - 60;}
		
		// Ajout des zéros au cas où l'affichage soit en dessous de 10
		if ($Heure < 10)
		{$Heure = '0'.$Heure;}
		if ($Minute < 10 AND $Minute > 0)
		{$Minute = '0'.$Minute;}
		if ($Minute == 0)
		{$Minute = '00';}
		if ($temps_en_sec < 10)
		{$temps_en_sec = '0'.$temps_en_sec;}

		// Retourne une variable la plus petite possible
		if ($Jour > 0) {
			$affichage_final = "Arg, avec un score pareil je ne peux que vous encourager à tenter une autre aventure pour vous améliorer !";
		} elseif ($Heure > 0) {
			$affichage_final = "<p class=\"text-couleur-gros\">".$Heure.':'.$Minute.':'.$temps_en_sec."</p>";
		} else {
			$affichage_final = "<p class=\"text-couleur-gros\">".$Minute.':'.$temps_en_sec."</p>";				
		}
		
		echo "<br><br>On mélange tout ça et on arrive à votre score final !<br>".$affichage_final;
		if ($duree < 1800)
			echo "<p>Votre temps est particulièrement bas ! Avez-vous rencontré un soucis pendant votre partie ? Ou alors vous êtes trop fort !!<br>
					Nous ne pourrons pas afficher votre score dans le classement final !</p>";
		echo "Il me reste à vous dire au revoir, puissiez vous garder en mémoire :<br><center>Tout peuple qui oublie son passé<br>se condamne à le revivre.</center>"
		?>
	</div>
</div><?php
// AJOUTER UN AUTRE CHECK SI L'EQUIPE A DEJA ENREGISTRE SON TEMPS, POUR NE PAS REMETTRE LE FORMULAIRE
if (SAVESCORE && !cookieExists(COOKIE_TEAM)) { ?>
<div class="row marge0">
	<div class="col-12 mt-1 mb-1">
		<div id="responseform" style="display: none;">
		</div>
	</div>
</div>
<div class="row marge0">
	<div class="col-12 text-center">
	<form id="saveteamform">
		<!-- <?php echo "$temps_depart $temps_fin $duree $nb_juste"; ?> -->
		<!-- data à sauver pour les teams + manque nom de la team -->
		<p class="text-couleur">Nommez votre équipe et sauvegardez votre temps&nbsp;!</p>
		<input type="text" name="team" id="team" value="" placeholder="Votre nom d'équipe" style="width: 80%;" class="mb-1" maxlength="60"><input type="submit" value="Enregistrer votre temps !" id="saveteam" class="mb-1">
		<input type="hidden" name="start" value="<?php echo $temps_depart; ?>">
		<input type="hidden" name="end" value="<?php echo $temps_fin; ?>">
		<input type="hidden" name="duree" value="<?php echo $duree; ?>">
		<input type="hidden" name="rep_juste" value="<?php echo $nb_juste; ?>">
	</form>
	</div>
</div><?php }
elseif (SAVESCORE && cookieExists(COOKIE_TEAM)){ ?>
<div class="row marge0">
	<div class="col-12">
		<p style="word-wrap: anywhere;">Equipe <?php echo $_COOKIE[COOKIE_TEAM]; ?>&nbsp;!</p>
		<p><a href="./classement.php#team">Vous pouvez accéder au classement !</a></p>
	</div>
</div>
<?php
}	?>