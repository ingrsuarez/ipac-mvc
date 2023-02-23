var firstNumber = document.getElementById('firstNumber');
var lastNumber = document.getElementById('lastNumber');

// firstNumber.addEventListener("keydown",function(evt){

// })

//First number zero complete function
firstNumber.addEventListener("keypress", function (evt) {
	var key = event.key;
	var code=event.code;
	let type1 = code.match("Digit");
	let type2 = code.match("Numpad");
	console.log("key: "+key+" code: "+code)
	if ((type1 != null) || (type2 != null)){
		// alert("Hubo ingreso: "+typeof(key)+" tipo: "+code);

	}else{
		
		evt.preventDefault();
            return;
		

	}
	});

firstNumber.addEventListener("focusout",function(evt){

	let number = firstNumber.value;
	firstNumber.value = ("000"+number).slice(-4);
	
});

//Last number zero complete function
lastNumber.addEventListener("keypress", function (evt) {
	var key = event.key;
	var code=event.code;
	let type1 = code.match("Digit");
	let type2 = code.match("Numpad");

	if ((type1 != null) || (type2 != null)){
		// alert("Hubo ingreso: "+typeof(key)+" tipo: "+code);

	}else{
		
		evt.preventDefault();
            return;
		

	}
	});

lastNumber.addEventListener("focusout",function(evt){

	let number = lastNumber.value;
	lastNumber.value = ("0000000"+number).slice(-8);
	
});