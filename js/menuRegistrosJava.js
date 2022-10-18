 
const menu1 = document.getElementById("circulares");
const menu2 = document.getElementById("no_conformidades");
const menu3 = document.getElementById("capacitaciones");
const menu4 = document.getElementById("orden_trabajo");
const menu5 = document.getElementById("documentos");


//--------------- MENU BARS --------------------------------------

menu1.addEventListener("click", function(){
	const submenu = document.getElementById("circulares__inside");
	const resto = document.getElementById("no_conformidades__inside");
	const resto2 = document.getElementById("capacitaciones__inside");
	const resto3 = document.getElementById("orden_trabajo__inside")
	const resto4 = document.getElementById("documentos__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		resto2.style.opacity = "0";
		resto3.style.opacity = "0";
		resto4.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "80px";
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
	const submenu = document.getElementById("no_conformidades__inside");
	const resto = document.getElementById("circulares__inside");
	const resto2 = document.getElementById("capacitaciones__inside");
	const resto3 = document.getElementById("orden_trabajo__inside")
	const resto4 = document.getElementById("documentos__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		resto2.style.opacity = "0";
		resto3.style.opacity = "0";
		resto4.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "80px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});


menu3.addEventListener("click", function(){
	const submenu = document.getElementById("capacitaciones__inside");
	const resto = document.getElementById("circulares__inside");
	const resto2 = document.getElementById("no_conformidades__inside");
	const resto3 = document.getElementById("orden_trabajo__inside")	
	const resto4 = document.getElementById("documentos__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		resto2.style.opacity = "0";
		resto3.style.opacity = "0";
		resto4.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "80px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});

menu4.addEventListener("click", function(){
	const submenu = document.getElementById("orden_trabajo__inside");
	const resto = document.getElementById("circulares__inside");
	const resto2 = document.getElementById("no_conformidades__inside");
	const resto3 = document.getElementById("capacitaciones__inside")	
	const resto4 = document.getElementById("documentos__inside");
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		resto2.style.opacity = "0";
		resto3.style.opacity = "0";
		resto4.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "80px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});

menu5.addEventListener("click", function(){
	const submenu = document.getElementById("documentos__inside");
	const resto = document.getElementById("circulares__inside");
	const resto2 = document.getElementById("no_conformidades__inside");
	const resto3 = document.getElementById("capacitaciones__inside");
	const resto4 = document.getElementById("orden_trabajo__inside")		
	if (submenu.style.opacity == "0" || submenu.style.opacity == ""){
		resto.style.opacity = "0";
		resto2.style.opacity = "0";
		resto3.style.opacity = "0";
		resto4.style.opacity = "0";
		submenu.style.opacity = "1";
		submenu.style.cursor = "pointer";
		submenu.style.top = "80px";
		submenu.style.display = "block";
		submenu.style.transition = ".5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else{
		submenu.style.opacity = "0";
		submenu.style.cursor = "none";
		submenu.style.display = "none";	
	}
});
