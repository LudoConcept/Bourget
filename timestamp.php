<?php
$fin = 1663765327;
$start = strtotime("21 september 2022 13:51:00");
$erreur = 2 * 90;
$juste = 4 * 60;
echo $fin."<br>".$start."<br>".$erreur."<br>".$juste."<hr>";
echo date("j/m/Y H:m", $fin)."<br>".date("j/m/Y H:m", $start)."<hr>";
$tempsfinal = $fin - $start - $juste + $erreur;
$temps_en_sec = $tempsfinal;

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

?>