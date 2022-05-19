const primaryColor = '#4834d4'
const warningColor = '#f0932b'
const successColor = '#6ab04c'
const dangerColor = '#eb4d4b'

const themeCookieName = 'theme'
const themeDark = 'dark'
const themeLight = 'light'

const body = document.getElementsByTagName('body')[0]

function setCookie(cname, cvalue, exdays) {
  var d = new Date()
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
  var expires = "expires="+d.toUTCString()
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"
}

function getCookie(cname) {
  var name = cname + "="
  var ca = document.cookie.split(';')
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1)
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length)
    }
  }
  return ""
}

loadTheme()

function loadTheme() {
	var theme = getCookie(themeCookieName)
	body.classList.add(theme === "" ? themeLight : theme)
}

function switchTheme() {
	if (body.classList.contains(themeLight)) {
		body.classList.remove(themeLight)
		body.classList.add(themeDark)
		setCookie(themeCookieName, themeDark)
	} else {
		body.classList.remove(themeDark)
		body.classList.add(themeLight)
		setCookie(themeCookieName, themeLight)
	}
}

function collapseSidebar() {
	body.classList.toggle('sidebar-expand')
}

window.onclick = function(event) {
	openCloseDropdown(event)
}

function closeAllDropdown() {
	var dropdowns = document.getElementsByClassName('dropdown-expand')
	for (var i = 0; i < dropdowns.length; i++) {
		dropdowns[i].classList.remove('dropdown-expand')
	}
}

function openCloseDropdown(event) {
	if (!event.target.matches('.dropdown-toggle')) {
		// 
		// Close dropdown when click out of dropdown menu
		// 
		closeAllDropdown()
	} else {
		var toggle = event.target.dataset.toggle
		var content = document.getElementById(toggle)
		if (content.classList.contains('dropdown-expand')) {
			closeAllDropdown()
		} else {
			closeAllDropdown()
			content.classList.add('dropdown-expand')
		}
	}
}


//AJAX

//GRAFICO DO COEFICIENTE

$('document').ready(function () {

	$.ajax({
		type: "POST",
		url: "chart2.php",
		dataType: "json",
		success: function (data) {

			//var tamanho = 0;

			//tamanho = data[0];

			//var tamanho_inteiro = 0;

			//tamanho_inteiro = parseInt(tamanho);

			//remover o indice 0 (indice, numero de elementos a remover)
			//data.splice(0, 1);

			//var locais = [];

			//var controle = 0;

			//Construo a vari�vel locais removo as posi��es do vetor
			//for (var i = 1; i < tamanho_inteiro; i++) {

				//locais.push(data[0]);

				//data.splice(0, 1);

				//controle = controle + 1;
			//}

			//A vari�vel data tem coeficiente, data_hora e locais correspondentes

			var coeficientearray = [];
			var date_timearray = [];
			var localarray = [];

			//Crio 3 arrays com posi��es de dados correspondentes

			//matriz_coeficiente = [];
			//matriz_date_time = [];
			//quantidade_colunas = 0;

			//for (var i = 0; i < 2; i++) {

				//for (var j = 0; j < data.length; j++) {

					//if (data[j].local == locais[i]) {

					//	matriz_coeficiente.push(data[j].coeficiente);
						//matriz_date_time.push(data[j].date_time);
					//}

					//quantidade_colunas = quantidade_colunas + 1;
                //}
			//}

			
			for (var i = 0; i < data.length; i++) {

				coeficientearray.push(data[i].coeficiente);
				date_timearray.push(data[i].date_time);
				localarray.push(data[i].local);
			}

			graficocoeficiente(localarray, coeficientearray, date_timearray);			

		}
	});
});


function graficocoeficiente(legenda, matrizcoeficiente, matrizDataHora) {
	
	var ctx = document.getElementById("coeficienteChart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizcoeficiente,
			borderWidth: 2,
			lineTension: 0,
		}]
	}
		
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,
		}
	});	

}

// GRAFICO DA DEFORMAÇÃO - 	SENSOR 1


$('document').ready(function () {
	$.ajax({
		type: "POST",
		url: "chart2.php",
		dataType: "json",
		success: function (data) {

			var deformacaoarray = [];
			var date_timearray = [];
			var localarray = [];

			for (var i = 0; i < data.length; i++) {

				deformacaoarray.push(data[i].deformacao);
				date_timearray.push(data[i].date_time);
				localarray.push(data[i].local);
			}

			graficodeformacao(localarray, deformacaoarray, date_timearray);			

		}
	});
});


function graficodeformacao(legenda, matrizdeformacao, matrizDataHora) {
	
	var ctx = document.getElementById("deformacaoChart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizdeformacao,
			borderWidth: 2,
			lineTension: 0,
		}]
	}
		
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,
		}
	});	

}

//GRAFICO DO COEFICIENTE 2

$('document').ready(function () {

	$.ajax({
		type: "POST",
		url: "chart2_2.php",
		dataType: "json",
		success: function (data) {

			var coeficiente_2array = [];
			var date_timearray = [];
			var local_2array = [];

			for (var i = 0; i < data.length; i++) {

				coeficiente_2array.push(data[i].coeficiente_2);
				date_timearray.push(data[i].date_time);
				local_2array.push(data[i].local_2);
			}

			graficocoeficiente_2(local_2array, coeficiente_2array, date_timearray);			

		}
	});
});


function graficocoeficiente_2(legenda, matrizcoeficiente, matrizDataHora) {
	
	var ctx = document.getElementById("coeficiente_2Chart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizcoeficiente,
			borderWidth: 2,
			lineTension: 0,
		}]
	}
		
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,
		}
	});	

}


// GRAFICO DA DEFORMAÇÃO - 	SENSOR 2


$('document').ready(function () {
	$.ajax({
		type: "POST",
		url: "chart2_2.php",
		dataType: "json",
		success: function (data) {

			var deformacao_2array = [];
			var date_timearray = [];
			var local_2array = [];

			for (var i = 0; i < data.length; i++) {

				deformacao_2array.push(data[i].deformacao_2);
				date_timearray.push(data[i].date_time);
				local_2array.push(data[i].local_2);
			}

			graficodeformacao_2(local_2array, deformacao_2array, date_timearray);			

		}
	});
});


function graficodeformacao_2(legenda, matrizdeformacao_2, matrizDataHora) {
	
	var ctx = document.getElementById("deformacao_2Chart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizdeformacao_2,
			borderWidth: 2,
			lineTension: 0,
		}]
	}
		
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: {
			maintainAspectRatio: false,
			bezierCurve: false,
		}
	});	

}

// // GRÁFICO DE DEFORMAÇÃO

// $('document').ready(function () {

// 	$.ajax({
// 		type: "POST",
// 		url: "chart2.php",
// 		dataType: "json",
// 		success: function (data) {
//       	var deformacaoarray = [];
// 		var deformacao_2array = [];
// 		var date_timearray = [];
// 		var localarray = [];
// 		var local_2array = [];
      
//       for (var i = 0; i < data.length; i++) {

// 				deformacaoarray.push(data[i].deformacao);
// 				deformacao_2array.push(data[i].deformacao_2);
// 				date_timearray.push(data[i].date_time);
// 				local_2array.push(data[i].local_2);
// 			}

// 			graficodeformacao(localarray, local_2array, deformacaoarray, deformacao_2array, date_timearray);			

// 		}
// 	});
// });

// function graficodeformacao(localarray, local_2array, deformacaoarray, deformacao_2array, date_timearray) {
// 	var ctx = document.getElementById("deformacaoChartzz");
// 	ctx.height = 500
// 	ctx.width = 500
// 	var data = {
// 		labels: date_timearray,
// 		datasets: [{
// 			fill: false,
// 			label: "Sensor 1",
// 			borderColor: successColor,
// 			data: deformacaoarray,
// 			borderWidth: 2,
// 			lineTension: 0,
// 		}, {
// 			fill: false,
// 			label: 'Sensor 2',
// 			borderColor: dangerColor,
// 			data: deformacao_2array,
// 			borderWidth: 2,
// 			lineTension: 0,
// 			}]
// 	}
		
// 	var lineChart = new Chart(ctx, {
// 		type: 'line',
// 		data: data,
// 		options: {
// 			maintainAspectRatio: false,
// 			bezierCurve: false,
// 		}
// 	});	

// }


//Gr�fico de deformacao

// var ctxC = document.getElementById("deformacaoChart");
// ctxC.height = 500
// ctxC.width = 500
// var dataC = {
// 	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
// 	datasets: [{
// 		fill: false,
// 		label: 'Completed',
// 		borderColor: successColor,
// 		data: [120, 115, 130, 500, 123, 33, 99, 66, 120, 52, 59],
// 		borderWidth: 2,
// 		lineTension: 0,
// 	}, {
// 		fill: false,
// 		label: 'Issues',
// 		borderColor: dangerColor,
// 		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
// 		borderWidth: 2,
// 		lineTension: 0,
// 	}]
// }

// var lineChartC = new Chart(ctxC, {
// 	type: 'line',
// 	data: dataC,
// 	options: {
// 		maintainAspectRatio: false,
// 		bezierCurve: false,
// 	}
// });



// //Gr�fico de Frequ�ncia

// var ctxF = document.getElementById("deformacaoChart");
// ctxF.height = 500
// ctxF.width = 500
// var dataF = {
// 	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
// 	datasets: [{
// 		fill: false,
// 		label: 'Completed',
// 		borderColor: successColor,
// 		data: [120, 115, 130, 500, 123, 3, 54, 555, 54656, 33, 99, 66, 120, 52, 59],
// 		borderWidth: 2,
// 		lineTension: 0,
// 	}, {
// 		fill: false,
// 		label: 'Issues',
// 		borderColor: dangerColor,
// 		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
// 		borderWidth: 2,
// 		lineTension: 0,
// 	}]
// }

// var lineChartF = new Chart(ctxF, {
// 	type: 'line',
// 	data: dataF,
// 	options: {
// 		maintainAspectRatio: false,
// 		bezierCurve: false,
// 	}
// });





// var lineChartCS = new Chart(ctxCS, {
// 	type: 'line',
// 	data: dataCS,
// 	options: {
// 		maintainAspectRatio: false,
// 		bezierCurve: false,
// 	}
// });