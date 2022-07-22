
const userCheck = document.getElementById("userCheck");
var base_url=window.location.host;

// FILTRO PEDIDOS POR USUARIO

userCheck.addEventListener("change", function (evt) {
	evt.preventDefault();
	var url = window.location.href;
	var urlC = url.split("/")

	alert("urlC"+urlC[5]+" url: "+url);
	// if (window.location.href == "http://[::1]/ipac-mvc/index.php/compras/mis_pedidos"){
	// 	alert(base_url+"/ipac-mvc/index.php/compras/pedidos")
	// 	// window.location.href = base_url+"/ipac-mvc/index.php/compras/pedidos";	
	// }else{
	// 	// window.location.href = base_url+"/ipac-mvc/index.php/compras/mis_pedidos";
	// 	alert(base_url+"/ipac-mvc/index.php/compras/pedidos")
	// }
})

