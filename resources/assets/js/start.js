var _urlBase='/';
var app = angular.module('app', ['angucomplete-alt']);

app.controller('geralController', ['$scope', function(scope) {
	scope.janela=window.name;
}]);

$(window).load(function() {
	$( ".startHidden" ).removeClass( "hidden" );
	$( ".loading" ).addClass( "hidden" );
});
function showError(text) {
	swal({   title: "Erro!",
		text: text,
		showConfirmButton: true,
		type: "error"
	});
}
function showWarning(text) {
	swal({   title: "Aviso!",
		text: text,
		showConfirmButton: true,
		type: "warning"
	});
}
function showSuccess(text) {
	swal({   title: "Sucesso!",
		text: text,
		timer: 3000,
		showConfirmButton: true,
		type: "success"
	});
}

