
const userCheck = document.getElementById("userCheck");


// FILTRO PEDIDOS POR USUARIO

userCheck.addEventListener("change", function (evt) {
	evt.preventDefault();
	if (window.location.href == "http://[::1]/ipac-mvc/index.php/compras/mis_pedidos"){
		window.location.href = "http://[::1]/ipac-mvc/index.php/compras/pedidos";	
	}else{
		window.location.href = "http://[::1]/ipac-mvc/index.php/compras/mis_pedidos";
		
	}
})

