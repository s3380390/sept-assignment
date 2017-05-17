// get all the elements of class 'error', clear the inner html
function clearErrors()
{
	var allErrors = document.getElementsByClassName('error');
	for (var i = 0; i < allErrors.length; i++) {
		allErrors[i].innerHTML = "";
	}

	var allInputs = document.getElementsByTagName('input');

	for (i = 0; i < allInputs.length; i++) {
		allInputs[i].style.removeProperty("background-color");
	}
}

function headerCheck(){
	var header = document.getElementsByName('header')[0].value.trim();
	//splitting the header into words
	var headerWords = header.replace(/\s+/g, " ").split(" ");
	var patt = /^[A-Za-z]+[.\'\-]?[a-zA-Z]*$/;
	for (var i=0; i < headerWords.length;i++){
		if (!patt.test(headerWords[i])) {
			document.getElementById('headerError').innerHTML='<br>Please enter only Alphabets, spaces and punctuation characters';
			document.getElementsByName('header')[0].style.backgroundColor='#f00';
			return false;
		}
	}
	return true;
}

function formValidate() {
	// clear all errors, even if it's the first run
	clearErrors();
	console.log("LOL");
	// Block or allow submission
	if (!headerCheck()){
		return false;
	}
	return true;
}