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

$('document').ready(function () {

	$.ajax({
		type: "POST",
		url: "chart.php",
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

			//Construo a variável locais removo as posições do vetor
			//for (var i = 1; i < tamanho_inteiro; i++) {

				//locais.push(data[0]);

				//data.splice(0, 1);

				//controle = controle + 1;
			//}

			//A variável data tem tensao, data_hora e locais correspondentes

			var tensaoarray = [];
			var date_timearray = [];
			var localarray = [];

			//Crio 3 arrays com posições de dados correspondentes

			//matriz_tensao = [];
			//matriz_date_time = [];
			//quantidade_colunas = 0;

			//for (var i = 0; i < 2; i++) {

				//for (var j = 0; j < data.length; j++) {

					//if (data[j].local == locais[i]) {

					//	matriz_tensao.push(data[j].tensao);
						//matriz_date_time.push(data[j].date_time);
					//}

					//quantidade_colunas = quantidade_colunas + 1;
                //}
			//}


			for (var i = 0; i < data.length; i++) {

				tensaoarray.push(data[i].tensao);
				date_timearray.push(data[i].date_time);
				localarray.push(data[i].local);
			}

			graficoTensao(localarray, tensaoarray, date_timearray);			

		}
	});
});


function graficoTensao(legenda, matrizTensao, matrizDataHora) {

	//Gráfico de Tensão
	
	var ctx = document.getElementById("tensaoChart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizTensao,
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



//Gráfico de Corrente

var ctxC = document.getElementById("correnteChart");
ctxC.height = 500
ctxC.width = 500
var dataC = {
	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	datasets: [{
		fill: false,
		label: 'Completed',
		borderColor: successColor,
		data: [120, 115, 130, 500, 123, 33, 99, 66, 120, 52, 59],
		borderWidth: 2,
		lineTension: 0,
	}, {
		fill: false,
		label: 'Issues',
		borderColor: dangerColor,
		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
		borderWidth: 2,
		lineTension: 0,
	}]
}

var lineChartC = new Chart(ctxC, {
	type: 'line',
	data: dataC,
	options: {
		maintainAspectRatio: false,
		bezierCurve: false,
	}
});



//Gráfico de Frequência

var ctxF = document.getElementById("frequenciaChart");
ctxF.height = 500
ctxF.width = 500
var dataF = {
	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	datasets: [{
		fill: false,
		label: 'Completed',
		borderColor: successColor,
		data: [120, 115, 130, 500, 123, 3, 54, 555, 54656, 33, 99, 66, 120, 52, 59],
		borderWidth: 2,
		lineTension: 0,
	}, {
		fill: false,
		label: 'Issues',
		borderColor: dangerColor,
		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
		borderWidth: 2,
		lineTension: 0,
	}]
}

var lineChartF = new Chart(ctxF, {
	type: 'line',
	data: dataF,
	options: {
		maintainAspectRatio: false,
		bezierCurve: false,
	}
});



//Gráfico de Consumo

var ctxCS = document.getElementById("consumoChart");
ctxCS.height = 500
ctxCS.width = 500
var dataCS = {
	labels: ['January', 'February', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	datasets: [{
		fill: false,
		label: 'Completed',
		borderColor: successColor,
		data: [120, 115, 130, 500, 123, 33, 99, 66, 120, 52, 59],
		borderWidth: 2,
		lineTension: 0,
	}, {
		fill: false,
		label: 'Issues',
		borderColor: dangerColor,
		data: [66, 44, 12, 48, 99, 56, 78, 23, 100, 22, 47],
		borderWidth: 2,
		lineTension: 0,
	}]
}

var lineChartCS = new Chart(ctxCS, {
	type: 'line',
	data: dataCS,
	options: {
		maintainAspectRatio: false,
		bezierCurve: false,
	}
});