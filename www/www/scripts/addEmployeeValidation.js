var regxMoreThan6 = new RegExp(".{6,20}");
var regxHasLower = new RegExp(".*[a-z]");
var regxHasUpper = new RegExp(".*[A-Z]");
var regxHasSymbol = new RegExp(".*[!@#$%^&*]");
var regxHasBad= new RegExp("(?!.*[<>()?/\\\\{}\\[\\]+\\-~|;:'\\\"= .,\\s]).*");
var regxNameCharacters = new RegExp("^[a-zA-z]+[a-zA-Z '-]*");
var regxNameLength = new RegExp(".{1,30}");
var regxGoodPhone = new RegExp("^(0(2|4|3|7|8)){0,1}(\\ |-){0,1}[0-9]{2}(\\ |-){0,1}[0-9]{2}(\\ |-){0,1}[0-9]{1}(\\ |-){0,1}[0-9]{3}$");

function validateForm(){
	var validations = [];
	
	validations[0] = validateFirstname();
	validations[1] = validateLastname();
	validations[2] = validatePhone();
	

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

function validateContact(){
	var input = "contact";
	var results = [];
	
	validateCreateErrorSpan(input);
	
	return validateRegexGeneral(regxGoodPhone, input, " invalid", "Invalid Contact Number");
}
