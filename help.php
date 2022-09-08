
<?php
	include_once('./param/global.php');
	include_once('./fonctions/php_cookies.php');
	include_once('./fonctions/php_mission.php');
	include_once('./textes/textes.php');

	if (cookieExists(COOKIE_MISSIONS)) {
		$etatmissions = unserialize($_COOKIE[COOKIE_MISSIONS]);
		$read_val_cook_ROSES = $etatmissions[13];
		$etatmissions[13] = ACTIVE;
		createCookie(COOKIE_MISSIONS, serialize($etatmissions));
	}
?>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="<?php echo FICHIER_CSS; ?>" rel="stylesheet" type="text/css">
</head>

<body>
<script src="./js/Cook.js"></script>
<script>

</script>
<?php
echo ("<br>Valeur mission ROSES<br><br>Avant changement : ".$read_val_cook_ROSES."<br>Après changement : ".ACTIVE);
?>
<br><br>
<input type=button onclick=window.location.href='./index.php'; value='Retourner à la Game'/>

<!--
<br><br><br><br><br>Si ça n'a pas marché !<br><br>
<a class="cercle point_actif" style="top: 41%; left: 30%; width:23%; height:2%;" href="https://jeuext.la-grande-evasion.com/bourget/interface.php" title="13"></a>
<br><br><br><br><br><br>
<input type=button onclick=window.location.href='https://jeuext.la-grande-evasion.com/bourget/interface.php'; value='Forcer la mission ROSES'/>
--->
</body>
</html>
