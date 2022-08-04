<?php
//Page liée à l'onglet 3
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

$val_cook = $_COOKIE[COOKIE_ESPRIT];
$nb_esprit = nb_cookie_esprit_ok($val_cook);
//echo "nb_esprit : ".$nb_esprit;
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
</div>

<!-- Down Supprimer ce bloc une fois les tests terminés 
<div class="row marge0 mb-3">
	<div class="col-12">
	<?php
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		echo "Etat Mission Roses : ".$etatmissions[ROSES];
	?>
	</div>
</div>
Up Supprimer ce bloc une fois les tests terminés -->