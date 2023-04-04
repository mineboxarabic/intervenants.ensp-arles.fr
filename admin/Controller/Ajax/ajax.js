$(document).ready( function() {

	$('#login').on('click', function(e) {
		
		var username = $('input#username').val(),
				password = $('input#password').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();

		if ( (username == "") || (password == "") ) {
			feedback.removeClass().addClass('error').text('Please enter your details!').fadeIn();
			load.fadeOut();
			return false;
		}

		// Both fields are filled in, let's continue.
		$.ajax({
			type: 'post',
			url: 'Controller/Ajax/process.php',
			dataType: 'json',
			data: {
				user: username,
				pass: password
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).html(data.message).fadeIn();
				if (data.error === false) {
					location.href = data.redirect;
				}
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
				// console.log(XMLHttpRequest.responseText);
			}
		});
		return false;
	});
	
	$('#register').on('click', function(e) {

		var registerUsername = $('input#register-username').val(),
				registerPassword = $('input#register-password').val(),
				registerEmail = $('input#register-email').val(),
				registerCaptcha = $('input#captcha').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();

		if ((registerUsername == "") || (registerPassword == "") || (registerEmail == "") || (registerCaptcha == "")) {
			feedback.removeClass().addClass('error').text('Please fill out all of the above fields.').fadeIn();
			load.fadeOut();
			return false;
		}

		$.ajax({
			type: 'post',
			url: 'Controller/Ajax/process.php',
			dataType: 'json',
			data: {
				regUser: registerUsername,
				regPass: registerPassword,
				regEmail: registerEmail,
				regCaptcha: registerCaptcha
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).text(data.message).fadeIn();
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
		return false;
	});

	$('#forgot-password').on('click', function() {

		var forgotEmail = $('input#forgot-email').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();

		if (forgotEmail == "") {
			load.fadeOut();
			feedback.removeClass().addClass('error').text('Please enter your email so that I can work with it!').fadeIn();
			return false;
		}

		$.ajax({
			type: 'post',
			url: 'Controller/Ajax/process.php',
			dataType: 'json',
			data: {
				forgotEmail: forgotEmail
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).text(data.message).fadeIn();
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});

		return false;
	});

	$('#renew-password').on('click', function() {
		var passwordOne = $('input#re-password').val(),
				passwordTwo = $('input#re-password-2').val(),
				emailReset = $('input#email-reset').val(),
				resetCode = $('input#reset-code').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();

		if ( (passwordOne == "") || (passwordTwo == "") || (emailReset == "") || resetCode == "") {
			load.fadeOut();
			feedback.removeClass().addClass('error').text('Please enter your new password, two times!').fadeIn();
			return false;
		}

		$.ajax({
			type: 'post',
			url: 'Controller/Ajax/process.php',
			dataType: 'json',
			data: {
				passwordOne: passwordOne,
				passwordTwo: passwordTwo,
				emailReset: emailReset,
				resetCode: resetCode
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).text(data.message).fadeIn();
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});

		return false;
	});

});