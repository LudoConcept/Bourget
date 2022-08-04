<?php
include_once('./textes/textes.php');
include_once('./param/global.php');
include_once('./fonctions/php_mission.php');
include_once('./fonctions/php_cookies.php');

if (!cookieExists(COOKIE_MISSIONS))
	header('Location: ./index.php');

?>
<!doctype html>
<html lang="fr">
	<head>
		<title><?php echo TITRE; ?></title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo ACCROCHE; ?>">
		<meta name="author" content="La Grande Évasion">

		<link rel="shortcut icon" href="<?php echo FAV_ICON; ?>" type="image/x-icon">
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="<?php echo FICHIER_CSS; ?>" rel="stylesheet" type="text/css">
	</head>

	<body style="background:url('<?php echo IMG_FOND; ?>');">
