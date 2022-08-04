<?php
//Liste des étapes esprit
define("ESPRIT_IMG", 0);
define("ESPRIT_TXT", 1);

$etape_esprit[0] =	[
							ESPRIT_IMG => IMG_ESPRIT00,
							ESPRIT_TXT => "<p class=\"text-esprit\">Je suis l'esprit des Jardins du Prieuré<br>Puissiez vous entendre ma volonté</p><p class=\"text-esprit\">Non loin de moi une pierre est gravée<br>D'une phrase pour tous ces hommes tombés</p><p class=\"text-mission-center\">'Tout peuple qui oublie son passé<br>Se condamne à le revivre',</p><p class=\"text-esprit\">Mais elle évoque aussi mes plantes,<br>Un jour méfiantes, un jour flamboyantes</p><p class=\"text-esprit\">Arpentez mes lignes sans plus attendre<br>Avant que mes souvenirs ne redeviennent cendres.</p><p class=\"text-mission\">Cet esprit dit des trucs un peu bizarre, il semble qu'il souhaite que les Jardins du Prieuré existent et qu'ils ne retournent jamais dans l'oubli.</p><p class=\"text-couleur\">De nouveaux points viennent d'apparaitre sur la carte.</p>",														
						];
$etape_esprit[1] =	[
							ESPRIT_IMG => IMG_ESPRIT01,
							ESPRIT_TXT => "<p class=\"text-esprit\">Oh merci, chaque souvenir que vous explorez,<br>permet à mes couleurs de briller.<br>Mes couleurs sont mon essence,<br>vous êtes mon ultime chance.</p>",														
						];
$etape_esprit[2] =	[
							ESPRIT_IMG => IMG_ESPRIT02,
							ESPRIT_TXT => "<p class=\"text-esprit\">Merci,<br>Chaque couleur,<br>remplit un peu plus mon coeur.<br>Malgré que je sois éternel,<br>il me manque encore des essentielles.<br></p>",					
						];
$etape_esprit[3] =	[
							ESPRIT_IMG => IMG_ESPRIT03,
							ESPRIT_TXT => "<p class=\"text-esprit\">Merci,<br>grâce à vous je me sens vibrer,<br>vous êtes des anges du néant arrivés.<br>Vous avez bien avancé,<br>mais il vous faut encore chercher</p>",
						];
$etape_esprit[4] =	[
							ESPRIT_IMG => IMG_ESPRIT04,
							ESPRIT_TXT => "<p class=\"text-esprit\">Merci,<br>j'ai enfin récupéré mes contours,<br>vous êtes vraiment des amours.<br>Je sens que nous y sommes bientôt,<br>vous menez à bien votre mission avec brio.</p>",		
						];
$etape_esprit[5] =	[
							ESPRIT_IMG => IMG_ESPRIT05,
							ESPRIT_TXT => "<p class=\"text-esprit\">Incroyable vous y êtes arrivé,<br>je me sens revivre cela faisait une éternité.<br>Il ne vous reste plus qu'une seule mission pour m'embélir,<br>une nouvelle page pourra s'écrire.</p>",														
						];
$etape_esprit[6] =	[
							ESPRIT_IMG => IMG_ESPRIT06,
							ESPRIT_TXT => "<p class=\"text-esprit\">Toutes mes couleurs sont revenues,<br>et ça grâce à vous chers inconnus,<br>vous avez mené à bien votre mission,<br>sans retenu, avec passion.<br>Merci pour tout ce que vous avez fait,<br>Il ne me reste désormais plus qu'un souhait,<br>puissiez vous raconter de moi,<br>une jolie histoire qui commencerait par Il était une fois...</p>",					
						];
$etape_esprit[7] =	[
							ESPRIT_IMG => IMG_ESPRIT07,
							ESPRIT_TXT => "<p class=\"text-esprit\">Mon aura est revenue,<br>vous m'avez fait honneur j'en suis émue,<br>pour terminer cette histoire,<br>voyons les souvenirs de vos mémoires.</p>",														
						];
/*$etape_esprit[8] =	[
							ESPRIT_IMG => IMG_ESPRIT07,
							ESPRIT_TXT => "<p class=\"text-esprit\">Mon aura est revenue,<br>vous m'avez fait honneur j'en suis émue,<br>pour terminer cette histoire,<br>voyons les souvenirs de vos mémoires.</p>",														
						];		*/				

//Attention, l'ordre n'a aucune importance ! Les missions se finissent dans n'importe quel ordre
//Ce tableau permet d'identifier à quelle mission correspond les infos stockées dans le cookie.
$CORRESPONDANCE_MISSION[5] = [POSITION => 0];
$CORRESPONDANCE_MISSION[10] = [POSITION => 1];
$CORRESPONDANCE_MISSION[14] = [POSITION => 2];
$CORRESPONDANCE_MISSION[21] = [POSITION => 3];
$CORRESPONDANCE_MISSION[25] = [POSITION => 4];
$CORRESPONDANCE_MISSION[29] = [POSITION => 5];
$CORRESPONDANCE_MISSION[33] = [POSITION => 6];
$CORRESPONDANCE_MISSION[34] = [POSITION => 7];
$CORRESPONDANCE_MISSION[35] = [POSITION => 8];

define("NB_QUESTIONS", 5);

$QUESTIONS_FIN[0] = "Question 1/6<br>Sauriez vous retrouver le nom de la Duchesse qui a tranformé ces jardins de 1915 à	1938 ?";
$QUESTIONS_FIN[1] = "Question 2/6<br>À quel objet peut on apparenter les grands arbres au centre des jardins ?";
$QUESTIONS_FIN[2] = "Question 3/6<br>Laquelle de ces anomalies se trouvait à la place de l'aire de jeu pour enfant ?";
$QUESTIONS_FIN[3] = "Question 4/6<br>Comment se prénomme la statue qui se trouve dans 'son petit temple végétal' ?";
$QUESTIONS_FIN[4] = "Question 5/6<br>Si je vous parle des 4 structures métalliques ? Qu'est ce qu'il vous vient à l'esprit ?";
$QUESTIONS_FIN[5] = "Question 6/6<br>Pour finir, quel murmure avait la voix la plus grave ?";


$REPONSES_QUESTION[0] = [1 => "La Duchesse de Viseult",
						2 => "La Duchesse de <br>Maubois",
						3 => "La Duchesse de Choiseul",
						4 => "C'est une Comtesse !"];
$REPONSES_QUESTION[1] = [1 => "Des immeubles",
						2 => "Une forêt médiévale",
						3 => "Une piste de bowling",
						4 => "Un échiquier"];
$REPONSES_QUESTION[2] = [1 => "Un boulodrome",
						2 => "Un terrain de<br>tennis",
						3 => "Un poney avec <br>une corne !",
						4 => "Une voiture"];
$REPONSES_QUESTION[3] = [1 => "Ulysse",
						2 => "Claudine",
						3 => "Jacqueline",
						4 => "Elise"];
$REPONSES_QUESTION[4] = [1 => "Lurette",
						2 => "Saperlipopette",
						3 => "Pétrolette",
						4 => "Gloriette"];
$REPONSES_QUESTION[5] = [1 => "La statue au centre<br>des jardins",
						2 => "Le chien de la<br>duchesse",
						3 => "Les rosiers",
						4 => "La lavoir"];						

?>