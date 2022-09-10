function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/; SameSite=Lax;";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function CreationCookie()
{
	createCookie('start_cookie',Date(),7);
	createCookie('partie_finie',0,7);
}

function SuppressionCookie()
{
	createCookie('start_cookie',Date(),-1);
	createCookie('partie_finie',0,-1);
}

function StopGame()
{
	valeur_cookie_fin = readCookie('partie_finie');
	if (valeur_cookie_fin == 0)
	{		
		createCookie('partie_finie',Date(),7);
	}
	valeur_cookie_fin = new Date(readCookie('partie_finie'));	
	valeur_cookie = new Date(readCookie('start_cookie'));
	
	diff = valeur_cookie_fin - valeur_cookie;
	diff = new Date(diff);	
	
	var sec = diff.getSeconds();
	var min = diff.getMinutes();
	var hr = diff.getHours()-1;
	if (hr < 10){
		hr = "0" + hr;
	}
	if (min < 10){
		min = "0" + min;
	}
	if (sec < 10){
		sec = "0" + sec;
	}
	
	document.getElementById("chronotime").innerHTML = '<font size="20"; color="white";>' + hr + ":" + min + ":" + sec + '</font>';
}



