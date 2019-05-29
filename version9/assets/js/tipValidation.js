function validateForm() {

	var title = document.forms["inputForm"]["title"].value;
	var trimedtitle = title.replace(/\s/g,''); //Replaces all the spaces with nothing. So if the "name" only contains spaces it will now be empty
	
	var tip = document.forms["inputForm"]["tip"].value;
	var trimedtip = tip.replace(/\s/g,'');
	
	if (trimedtitle == "" | trimedtip == "") { //Checks so no forms are empty (or only filled with spaces)
		alert("Make sure all fields are filled in");
		return false;
	}
}
