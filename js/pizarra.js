
var novedadesGeneral = document.getElementById('general');
var novedadesOrdenes = document.getElementById('ordenes');
var novedadesAnalitica = document.getElementById('analitica');
var btnGeneral = document.getElementById('btn_general');
var btnAnalitica = document.getElementById('btn_analitica');
var btnOrdenes = document.getElementById('btn_ordenes');


var linkgeneral = document.getElementById('general_link');
var linkordenes = document.getElementById('ordenes_link');
var linkanalitica = document.getElementById('analitica_link');


linkgeneral.addEventListener('click',function(){

	novedadesGeneral.className = 'board active';
	novedadesOrdenes.className = 'board fade';  
	novedadesAnalitica.className = 'board fade';  
	btnGeneral.className = 'btn btn-note';
	btnAnalitica.className = 'btn btn-note fade';
	btnOrdenes.className = 'btn btn-note fade';

});

linkordenes.addEventListener('click',function(){

	novedadesGeneral.className = 'board fade';
	novedadesOrdenes.className = 'board active';  
	novedadesAnalitica.className = 'board fade'; 
	btnGeneral.className = 'btn btn-note fade';
	btnAnalitica.className = 'btn btn-note fade';
	btnOrdenes.className = 'btn btn-note'; 

})

linkanalitica.addEventListener('click',function(){

	novedadesGeneral.className = 'board fade';
	novedadesOrdenes.className = 'board fade';  
	novedadesAnalitica.className = 'board active';  
	btnGeneral.className = 'btn btn-note fade';
	btnAnalitica.className = 'btn btn-note';
	btnOrdenes.className = 'btn btn-note fade'; 
})

