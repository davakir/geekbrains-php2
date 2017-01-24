var Form = {
	
	form: null,
	submitButton: null,
	cancelButton: null,
	
	init: function (form, submitBtn, cancelBtn) {
		this.form = form;
		this.submitButton = submitBtn;
		this.cancelButton = cancelBtn;
		
		this.cancelButton.on('click', function (event) {
			event.preventDefault();
			
			window.location.href = '/articles';
		});
	},
	
	cancel: function (event) {
		event.preventDefault();
		
		window.location.href = '/articles';
	}
};

$(document).ready(function () {
	Form.init($('form#new-article-form'), $('form#new-article-form .btn.submit'), $('form#new-article-form .btn.cancel'));
});