 
const menu1 = document.getElementById("pedidos");
const menu2 = document.getElementById("compras");
const menu3 = document.getElementById("proveedores");
const menu4 = document.getElementById("articulos");


//--------------- MENU BARS --------------------------------------

menu1.addEventListener("click", function(){
	const submenu = document.getElementById("pedidos__inside");
	const resto = document.getElementById("compras__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "36px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});


menu2.addEventListener("click", function(){
	const submenu = document.getElementById("compras__inside");
	const resto = document.getElementById("pedidos__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "36px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});


