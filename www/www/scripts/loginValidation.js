function validateForm(){
	var username = $("input[name='username']");
	var password = $("input[name='password']");
	var valid = true;
	
	$(".error").remove();
	
	if (username.val() == "") {
		username.after("<span class=\"error\">Please enter a username</span>");
		valid = false;
	}
	
	if (password.val() == "") {
		password.after("<span class=\"error\">Please enter a password</span>");
		valid = false;
	}
	
	return valid;
}