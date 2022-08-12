$(function(){
	$("#bloc_mission").on("click", "#saveteam", function(){
		event.preventDefault();
		console.log("save team");
		// tenter d'ajouter la team dans la base
		// traiter la réponse : la team n'est pas ajouté dans la base ----> on reste et on affiche un petit mot
		// traiter la réponse : team enregistrée ----> on chrge la suite, trois étapes pour afficher les scores.
	});
});