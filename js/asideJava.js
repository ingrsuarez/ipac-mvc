 
const horiz = document.getElementById("horiz1");
const horiz2 = document.getElementById("horiz2");
const horiz3 = document.getElementById("horiz3");


horiz.addEventListener("click",function(){
	const submenu = document.getElementById("horiz1__inside");
	const flecha = document.getElementById("flecha1");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});


horiz2.addEventListener("click",function(){
	const submenu = document.getElementById("horiz2__inside");
	const flecha = document.getElementById("flecha2");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		// submenu.style.left = "70";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "0.5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});

horiz3.addEventListener("click",function(){
	const submenu = document.getElementById("horiz3__inside");
	const flecha = document.getElementById("flecha3");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		// submenu.style.left = "70";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "0.5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});

// RESPONSIVE EFECTS

const toggle = document.getElementById("toggle");

toggle.addEventListener("click",function(evt){

	if (menu1.style.display === "none" || menu1.style.display === "") {
		menu1.style.display = "block";
	}else{
		menu1.style.display = "none";
	}
	if (menu2.style.display === "none" || menu2.style.display === "") {
		menu2.style.display = "block";
	}else{
		menu2.style.display = "none";
	}
	if (menu3.style.display === "none" || menu3.style.display === "") {
		menu3.style.display = "block";
	}else{
		menu3.style.display = "none";
	}

})





// --------BOARD NEW NOTE -------------------------------//

const btn_general = document.getElementById("btn_general");
const btn_ordenes = document.getElementById("btn_ordenes");
const btn_analitica = document.getElementById("btn_analitica");

btn_general.addEventListener("click",function(evt){
	evt.preventDefault();
	var nota = prompt("Ingrese su anotación:", "Nota");

		if (nota!=null && nota!="")
		{
			var sector = 0;
			$.post("insert_task", {nota: nota, sector: sector}, function(result){
				//This is for reload de new register!
				window.location.href = "index";
			});
			//To avoid reload of the page return false
			return false;
			
		}
})

btn_ordenes.addEventListener("click",function(evt){
	evt.preventDefault();
	var nota = prompt("Ingrese su anotación:", "Nota");

		if (nota!=null && nota!="")
		{
			var sector = 4;
			$.post("insert_task", {nota: nota, sector: sector}, function(result){
				//This is for reload de new register!
				window.location.href = "index";
			});
			//To avoid reload of the page return false
			return false;
			
		}
})

btn_analitica.addEventListener("click",function(evt){
	evt.preventDefault();
	var nota = prompt("Ingrese su anotación:", "Nota");

		if (nota!=null && nota!="")
		{
			var sector = 5;
			$.post("insert_task", {nota: nota, sector: sector}, function(result){
				//This is for reload de new register!
				window.location.href = "index";
			});
			//To avoid reload of the page return false
			return false;
			
		}
})

