var DeleteArticleForm = {
	form: null,
	
	init: function (formId) {
		DeleteArticleForm.form = $('#' + formId);
		
		var action = DeleteArticleForm.form.attr('action'),
			submitBtn =  DeleteArticleForm.form.find('input[type="submit"]');
		
		DeleteArticleForm.form.find('div').on('click', function (e) {
			e.preventDefault();
			if (confirm('Вы действительно хотите удалить статью?')) {
				submitBtn.click();
			}
		});
	}
};

var DeleteUserForm = {
	form: null,
	
	init: function (formId) {
		DeleteUserForm.form = $('#' + formId);
		
		var action = DeleteUserForm.form.attr('action'),
			submitBtn =  DeleteUserForm.form.find('input[type="submit"]');
		
		DeleteUserForm.form.find('div').on('click', function (e) {
			e.preventDefault();
			if (confirm('Вы действительно хотите удалить пользователя?')) {
				submitBtn.click();
			}
		});
	}
};

$(document).ready(function () {
	var formsArticles = $('form.delete-article-form');
	
	for (var i=0; i < formsArticles.length; i++)
	{
		DeleteArticleForm.init(formsArticles[i].id);
	}
	
	var formsUsers = $('form.delete-user-form');
	
	for (var j=0; j < formsUsers.length; j++)
	{
		DeleteUserForm.init(formsUsers[j].id);
	}
});
