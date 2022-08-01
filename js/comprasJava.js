
const userCheck = document.getElementById("userCheck");
var base_url=window.location.origin;
var path = window.location.pathname;
// FILTRO PEDIDOS POR USUARIO

userCheck.addEventListener("change", function (evt) {
	evt.preventDefault();
	var url = window.location.href;
	var urlC = url.split("/")
	var actualMethod = urlC[6]; //number 5 in production!!!!!!!!!!!!!!!!!!!!!!!!

	if (actualMethod == "mis_pedidos"){
		window.location.href = base_url+"/ipac-mvc/index.php/compras/pedidos";	///ipac-mvc/ in dev

	}else{
		window.location.href = base_url+"/ipac-mvc/index.php/compras/mis_pedidos";//ipac-mvc/ in dev
	}
	
})


