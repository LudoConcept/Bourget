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
	
	<?php /* <div><?php $t = time(); ?>
		<p><?php echo $t; ?></p>
		<p><?php echo date("m/d/Y", $t-3600*24); ?></p>
		<p><?php echo strtotime(date("m/d/Y", $t)); ?></p>
		<p><?php echo date("m/d/Y", strtotime(date("m/d/Y", $t))); ?></p>
		<p><?php $timestamptoday = strtotime(date("m/d/Y")); echo $timestamptoday; ?></p>
		<p><?php $timestamp30days = $timestamptoday - 2592000; echo $timestamp30days; ?></p>
	</div> */
	?>
	
	<div class="m-1">
		<h4 class="text-center m-2">Classement des 30 derniers jours</h2>
		<?php
	// requete 30 derniers jours
	$timestamp30days = strtotime(date("m/d/Y")) - 2592000;
	$sql = "SELECT * FROM `game` WHERE `end` > ? ORDER BY duree ASC";
	// requete 50 meilleurs
	// "SELECT * FROM `game` ORDER BY duree ASC LIMIT 0, 50"
	// CHECK SI J'AI PAS FAIT UN TRUC SIMILAIRE POUR KHONSOU  (affichage de X resultats, page par page)
	if (cookieExists(COOKIE_TEAM)) $team = $_COOKIE[COOKIE_TEAM];
	$statement = $conn->prepare($sql);
	$statement->execute([$timestamp30days]);
	$result = $statement->fetchAll();
	if (!$result) echo "Pas de résultat"; 
	else { ?>
	<table class="score">
		<thead>
			<tr class="text-center">
				<th>Date</th>
				<th>&Eacute;quipe</th>
				<th>Temps</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($result as $val){ 
		$jours = 0;
		$heures = 0;
		$minutes = 0;
		$secondes = 0;
		if ($val["duree"] > 0) {
			$jours = floor($val["duree"] / (86400));
			$temp = ($jours * 86400);
			$heures = floor(($val["duree"] - $temp) / (3600));
			$temp += ($heures * 3600);
			$minutes = floor(($val["duree"] - $temp) / 60);
			$secondes = floor($val["duree"] - (($temp + $minutes * 60)));
		} ?>
		<tr>
			<td style="width: 25%;"><?php echo date("d/m/y", $val["end"]); ?></td>
			<td class="text-center" style="width: 30%; word-wrap: anywhere;"><?php if (isset($team) && $team == $val['nom']) echo "<a id=\"team\"></a>"; echo $val["nom"]; ?></td>
			<td style="width: 45%;"><?php if ($jours > 0) echo $jours." jour(s) "; if ($heures > 0) echo $heures." heure(s) "; if ($minutes > 0) echo $minutes." minute(s) "; if ($secondes > 0) echo $secondes." seconde(s)"; ?></td>
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
			$("#menuprincipal").remove(); // on retire le menu
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