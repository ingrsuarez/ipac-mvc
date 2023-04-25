
var calculoHba1cDirecta = document.getElementById('directa');
var claculoClearence = document.getElementById('clearence');
var calculoHoma = document.getElementById('homa');
var claculoProteinograma = document.getElementById('proteinograma');
var calculoCalcioIonico = document.getElementById('calcioIonico');
var calculoHemoglobina = document.getElementById('hemoglobina');

var linkHba1cDirecta = document.getElementById('directa_link');
var linkClearence = document.getElementById('clearence_link');
var linkHoma = document.getElementById('homa_link');
var linkProteinograma = document.getElementById('proteinograma_link');
var linkCalcioIonico = document.getElementById('calcioionico_link');
var linkHemoglobina = document.getElementById('hemoglobina_link');

linkHba1cDirecta.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content-active';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content';
});

linkClearence.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content-active';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
});

linkHoma.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content-active';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
});

linkProteinograma.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content-active'; 
	calculoCalcioIonico.className = 'tab-content';
});

linkCalcioIonico.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content-active';
});

linkHemoglobina.addEventListener('click',function(){

	calculoHba1cDirecta.className = 'tab-content';
	calculoHemoglobina.className = 'tab-content-active';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
});