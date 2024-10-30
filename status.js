// JavaScript code for form validation and other functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('statusForm');
    let isSubmitting = false; // Flag to track manual submission

    form.addEventListener('submit', (e) => {
        if (isSubmitting) return; // If already submitting, don't run validation again
        e.preventDefault()
	
	var Userid = document.querySelector("#userid").value;
	if (Userid == "") {
		alert("Please enter your user id.");
		return false;
	} else {
		return true;
	}
});
});