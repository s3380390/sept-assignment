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

function nameCheck(){
	var name = document.getElementsByName('customer')[0].value.trim();
	var names = name.replace(/\s+/g, " ").split(" ");
	var patt = /^[A-Za-z]+[.'\-]?[a-zA-Z]*$/;
	for (var i=0; i < names.length;i++){
		if (!patt.test(names[i])) {
			document.getElementById('cNameError').innerHTML='<br>Please enter only Alphabets, spaces and punctuation characters';
			document.getElementsByName('customer')[0].style.backgroundColor='#f00';
			return false;
		}
	}
	return true;
}

function formValidate() {
	// clear all errors, even if it's the first run
	clearErrors();
	// Block or allow submission
	if (!nameCheck()){
		return false;
	}
	return true;
}