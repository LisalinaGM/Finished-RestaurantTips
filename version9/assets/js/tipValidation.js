function validateForm() {

	var title = document.forms["inputForm"]["title"].value;
	var trimedtitle = title.replace(/\s/g,''); //Replaces all the spaces with nothing. So if the "name" only contains spaces it will now be empty
	
	var email = document.forms["inputForm"]["email"].value;
	var trimedEmail = email.replace(/\s/g,'');
	
	var tip = document.forms["inputForm"]["tip"].value;
	var trimedtip = tip.replace(/\s/g,'');
	
	var containingEmail = email.includes("@");
	
	if (trimedtitle == "" | trimedEmail == "" | trimedtip == "") { //Checks so no forms are empty (or only filled with spaces)
		alert("Make sure all fields are filled in");
		return false;
	}
	else if(!containingEmail){//Checks if the email-address contains a @
		alert("Fill in a correct email-address");
		return false;
	}
	else if(containingEmail){
		var position = email.indexOf("@"); //Gets the position of @
		var containingDot = email.includes(".", position);//Checks if there is a dot after the @
		if(!containingDot){
			alert("Fill in a correct email-address");
			return false;
		}
	}
}