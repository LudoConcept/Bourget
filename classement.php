<?php
include ('./includes/include_headerhtml.php');
include ('./includes/include_menu.php');
include_once('./action/bdd_connect.php');
?>

	<!-- CONTENU 
	<div id="liste_mission">		
		<div class="" id="mission_on">
		</div>
	</div>  FIN DE LA ZONE DES MISSIONS -->
	
	<div><?php $t = time(); ?>
		<p><?php echo $t; ?></p>
		<p><?php echo date("m/d/Y", $t-3600*24); ?></p>
		<p><?php echo strtotime(date("m/d/Y", $t)); ?></p>
		<p><?php echo date("m/d/Y", strtotime(date("m/d/Y", $t))); ?></p>
		<p><?php $timestamptoday = strtotime(date("m/d/Y")); echo $timestamptoday; ?></p>
		<p><?php $timestamp30days = $timestamptoday - 2592000; echo $timestamp30days; ?></p>
	</div>
	
	<div class="m-1">
		<?php
	// requete 30 derniers jours
	$timestamp30days = strtotime(date("m/d/Y")) - 2592000;
	$sql = "SELECT * FROM `game` WHERE `end` > ? ORDER BY duree ASC";
	// requete 50 meilleurs
	// "SELECT * FROM `game` ORDER BY duree ASC LIMIT 0, 50"
	// CHECK SI J'AI PAS FAIT UN TRUC SIMILAIRE POUR KHONSOU  (affichage de X resultats, page par page)
	$statement = $conn->prepare($sql);
	$statement->execute([$timestamp30days]);
	$result = $statement->fetchAll();
	if (!$result) echo "Pas de résultat"; 
	else { ?>
	<table class="score">
		<tbody>
		<?php
		foreach ($result as $val){ 
		$jours = floor($val["duree"] / (60 * 60 * 24));
		$heures = 0;
		$minutes = 0;
		$secondes = 0;
		if ($val["duree"] > 0) {
			$jours = floor($val["duree"] / (60 * 60 * 24));
			$heures = floor(($val["duree"] - ($jours * 60 * 60 * 24)) / (60 * 60));
			$minutes = floor(($val["duree"] - (($jours * 60 * 60 * 24 + $heures * 60 * 60))) / 60);
			$secondes = floor($val["duree"] - (($jours * 60 * 60 * 24 + $heures * 60 * 60 + $minutes * 60)));
		} ?>
		<tr>
			<td><?php echo date("d/m/y", $val["end"]); ?></td>
			<td class="text-center"><?php echo $val["nom"]; ?></td>
			<td><?php if ($jours > 0) echo $jours." jour(s) "; if ($heures > 0) echo $heures." heure(s) "; if ($minutes > 0) echo $minutes." minute(s) "; if ($secondes > 0) echo $secondes." seconde(s)"; ?></td>
		</tr>
<?php
		} ?>
		</tbody>
	</table><?php
	}
?>
	</div>
	
	<?php 	
	/*<div id="resultat"><!-- ZONE D'AFFICHAGE D'INFO LIKE A POP-UP -->
	</div> */ ?>
	<div id="bloc_loading">
		<img class="loader" src="<?php echo GIF_LOAD; ?>">
	</div>
	<!-- <button id="pressed">TEST</button>-->

<?php
include ('./includes/include_footer.php'); // le fichier est actuellement vide, mais si on veut inclure quelque chose en guise de pied de page, on aura juste à le remplir
include ('./includes/include_external_script.php');
?>
	<!-- SCRIPT PERSONNALISEE ICI -->
	<script src="./js/Cook.js"></script>
	<script>
		$(function(){
			$("#bloc_loading").hide();
			$("#menuprincipal").remove();
			$(document)
				.ajaxStart(function(){
					// console.log("ON");
					$("#bloc_loading").show();
				})
				.ajaxStop(function(){
					// console.log("OFF");
					$("#bloc_loading").hide();
				})
			;
		});
	</script>
<?php
include ('./includes/include_endhtml.php');
?>