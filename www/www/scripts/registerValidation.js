var regxMoreThan6 = new RegExp(".{6,20}");
var regxHasLower = new RegExp(".*[a-z]");
var regxHasUpper = new RegExp(".*[A-Z]");
var regxHasSymbol = new RegExp(".*[!@#$%^&*]");
var regxHasBad= new RegExp("(?!.*[<>()?/\\\\{}\\[\\]+\\-~|;:'\\\"= .,\\s]).*");
var regxUsernameStart = new RegExp("^([A-Za-z]){1}");
var regxNameCharacters = new RegExp("^[a-zA-z]+[a-zA-Z '-]*");
var regxNameLength = new RegExp(".{1,30}");
var regxGoodPhone = new RegExp("^(0(2|4|3|7|8)){0,1}(\\ |-){0,1}[0-9]{2}(\\ |-){0,1}[0-9]{2}(\\ |-){0,1}[0-9]{1}(\\ |-){0,1}[0-9]{3}$");

function validateForm(){
	var validations = [];
	
	validations[0] = validatePass();
	validations[1] = validatePasswordsMatch();
	validations[2] = validatePhone();
	validations[3] = validateUsername();
	validations[4] = validateFirstname();
	validations[5] = validateLastname();

	return validateArrayPass(validations);
}

function validateArrayPass(array){
	var ret = true;
	var i;
	
	for (i=0; i < array.length; i++) {
		ret = ret && array[i];
	}
	
	return ret;
}

function validateCreateErrorSpan(input){
	if ($("#" + input + "Valid").length)
		$("#" + input + "Valid").html("");
	else
		$(("input[name='" + input +"']")).after(("<span id=\"" + input + "Valid\" class=\"error\"></span>"));
}

function validateRegexGeneral(regex, input, error, usererror){
	var value = $("input[name='" + input + "']").val();
	
	if (!regex.test(value)){
		$("#" + input + "Valid").append((usererror + "<br />"));
		console.log(input + " error: " + error);
		return false;
	}
	
	return true;
}

function validatePass(){
	var input = "password1";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	results[0] = validateRegexGeneral(regxMoreThan6, input, " length", "Length must be 6-20");
	results[1] = validateRegexGeneral(regxHasLower, input, " no lowercase", "Must have lowercase");
	results[2] = validateRegexGeneral(regxHasUpper, input, " no uppercase", "Must have uppercase");
	results[3] = validateRegexGeneral(regxHasSymbol, input, " no symbol", "Must have a symbol");
	
	// cant get bads working, look at it later
	// results[4] = validateRegexGeneral(regxHasBad, input, " bad found", "Invalid characters found")
	
	return validateArrayPass(results);
}

function validatePasswordsMatch(){
	var pass1 = $("input[name='password1']");
	var pass2 = $("input[name='password2']");
	
	validateCreateErrorSpan("password2");
	
	if (pass1.val() == pass2.val())
		return true;
	else {
		$("#password2Valid").html("Passwords do not match");
		return false;
	}
}

function validatePhone(){
	var input = "contact";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	return validateRegexGeneral(regxGoodPhone, input, " invalid", "Invalid phone number");
}

function validateUsername(){
	var input = "username";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	results[0] = validateRegexGeneral(regxUsernameStart, input, " start", "Must start with a letter");
	results[1] = validateRegexGeneral(regxMoreThan6, input, " length", "Length must be 6-20");
	
	// cant get bads working, look at it later
	// results[2] = validateRegexGeneral(regxHasBad, input, " bad found", "Invalid characters found")
	
	if 
	
	return validateArrayPass(results);
}

function validateFirstname(){
	var input = "firstname";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	results[0] = validateRegexGeneral(regxNameCharacters, input, " characters", "Must be letters only");
	results[1] = validateRegexGeneral(regxNameLength, input, " length", "Length must be 1-30");
	
	return validateArrayPass(results);
}

function validateLastname(){
	var input = "lastname";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	results[0] = validateRegexGeneral(regxNameCharacters, input, " characters", "Must be letters only");
	results[1] = validateRegexGeneral(regxNameLength, input, " length", "Length must be 1-30");
	
	return validateArrayPass(results);
}
