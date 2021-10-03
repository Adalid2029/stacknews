document.oncontextmenu = function() {

			return false;

		}

		function right(e) {

	    	var msg = "Prohibido usar Click Derecho !!! ";
	    	if (navigator.appName == 'Netscape' && e.which == 3) {
	      		//alert(msg); //- Si no quieres asustar a tu usuario entonces quita esta linea...
	      		location.href = 'http://zipansion.com/A9MD';
	        return false;

	    	}

	    	else if (navigator.appName == 'Microsoft Internet Explorer' && event.button==2) {
	        	alert(msg); //- Si no quieres asustar al usuario que utiliza IE,  entonces quita esta linea...
	                        //- Aunque realmente se lo merezca...
	            location.href = 'http://zipansion.com/A9MD';
	            //window.open('http://zipansion.com/A9MD', '_blank');
	            return false;

	    	}

	   		return true;

		}

	document.onmousedown = right;

	



	/*abrirEnPestana(url);

	function abrirEnPestana(url) {

		var a = document.createElement("a");

		a.target = "_blank";

		a.href = url;

		a.click();

	}

 

	var url="http://www.lawebdelprogramador.com";

 

	window.onload=function(){

		

	}*/