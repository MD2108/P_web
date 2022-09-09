function EscapePressed(key, Input) {
    // Escape keycode is 27
    if (key.which == 27) {
        Input.blur();
    }
}

function displayConfirmation () {
	// Show the confirmation message
    // $('#confirmation-popup').removeAttr("hidden");
	$('#confirmation-popup').show(500, function () {
		$('#confirmation-popup').addClass('dim-page');
		$('#confirmation-popup').focus();
	});
}

function Cancel () {
	// The user looses focus of the confirmation message or click Cancel
	$('#confirmation-popup').hide(500, function () {
		$('#confirmation-popup').blur();
		$('#confirmation-popup').removeClass('dim-page');
	});
}

function Confirm (idForm) {
    // The user confirm, form is sent to the next page
    document.getElementById(idForm).submit();
}