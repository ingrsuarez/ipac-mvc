
var calculoHemoglobina = document.getElementById('hemoglobina');
var claculoClearence = document.getElementById('clearence');
var calculoHoma = document.getElementById('homa');
var claculoProteinograma = document.getElementById('proteinograma');
var calculoCalcioIonico = document.getElementById('calcioIonico');


var linkHemoglobina = document.getElementById('hemoglobina_link');
var linkClearence = document.getElementById('clearence_link');
var linkHoma = document.getElementById('homa_link');
var linkProteinograma = document.getElementById('proteinograma_link');
var linkCalcioIonico = document.getElementById('calcioionico_link');

linkHemoglobina.addEventListener('click',function(){

	calculoHemoglobina.className = 'tab-content-active';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
});

linkClearence.addEventListener('click',function(){

	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content-active';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
})

linkHoma.addEventListener('click',function(){

	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content-active';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content';
})

linkProteinograma.addEventListener('click',function(){

	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content-active'; 
	calculoCalcioIonico.className = 'tab-content';
})

linkCalcioIonico.addEventListener('click',function(){

	calculoHemoglobina.className = 'tab-content';
	claculoClearence.className = 'tab-content';  
	calculoHoma.className = 'tab-content';  
	claculoProteinograma.className = 'tab-content'; 
	calculoCalcioIonico.className = 'tab-content-active';
})