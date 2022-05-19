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

//GRAFICO DA POTÊNCIA APARENTE

$('document').ready(function () {

	$.ajax({
		type: "POST",
		url: "chart3.php",
		dataType: "json",
		success: function (data) {

			var pot_sarray = [];
			var date_timearray = [];
			var localarray = [];

			for (var i = 0; i < data.length; i++) {

				pot_sarray.push(data[i].pot_s);
				date_timearray.push(data[i].date_time);
				localarray.push(data[i].local);
			}

			graficopot_s(localarray, pot_sarray, date_timearray);			

		}
	});
});


function graficopot_s(legenda, matrizpot_s, matrizDataHora) {
	
	var ctx = document.getElementById("pot_sChart");
	ctx.height = 500
	ctx.width = 500
	var data = {
		labels: matrizDataHora,
		datasets: [{
			fill: false,
			label: legenda,
			borderColor: successColor,
			data: matrizpot_s,
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

