//validation script here
const inputsRegister = document.querySelectorAll('.regInput');
const inputsCheckout = document.querySelectorAll('.inputCheckout');
const patterns = {
	//registracija paterni
	ime: /^[A-Z][a-z]{2,20}$/, //i je flag za case-insensitive, ime mogu da budu karakteri 2 ili vise

	password1: /^[\w@-]{5,20}$/, //password moze biti \w (bilo koji karakter: a-z, A-Z, 0-9 i _) i znakovi @ i -

	brojTelefona: /^((0)|(\+381))6\d(([0-9]{7})|([0-9]{6}))$/,

	prezime: /^[A-Z][a-z]{1,40}(\s[A-Z][a-z]{1,30})?$/, //prezime -> karakteri 2 do 40,
	//prvo slovo mora biti Veliko, ovo u zagradi pa ? znaci opcionalno ukoliko osoba ima dva prezimena

	email: /^([a-z\_\d\.-]+)@[a-z]+\.[a-z]{2,8}(\.[a-z]{2,8})?$/, 
	//kraj registracija paterna

	//checkout paterni
	adresa: /^[A-Z][a-z]{2,}\s[A-Za-z]{0,}\s?\d\/?\d{0,}[a-zA-Z]{0,}$/, //adresa -> mora imati bar jednu rec i neki broj, takodje dozvoljen / i broj kao oznaka za broj stana

	grad: /^[A-Z][a-z]{2,20}$/, //grad -> prvi karakter je Veliko slovo pa onda mala slova od 2 do 15!

	zip_code: /^\d{5}$/ //zip_code mora sadrzati 5 brojeva
	//kraj checkout paterna
};


//validation function
function validate(field, regex){
	if(regex.test(field.value)){
		//prosla validacija
		field.classList.remove("invalid");
		field.classList.add("valid");
	}else{
		//nije prosla validacija
		field.classList.remove("valid");
		field.classList.add("invalid");
	}
	//console.log(regex.test(field.value));
}

//dodajemo event listener-e svakom od registracionih inputa!
inputsRegister.forEach(function(inputReg){
	inputReg.addEventListener('keyup', (e)=>{
		//console.log(e.target.attributes.name.value);
		validate(e.target, patterns[e.target.attributes.name.value]);
	});
});

//dodajemo event listerner-e svakom od checkout input-a
inputsCheckout.forEach(function(inputCheckout){
	inputCheckout.addEventListener('keyup', (e)=>{
		validate(e.target, patterns[e.target.attributes.name.value]);
	});
});

function validateRegForm(){
	var validno = true;
	for(var i = 0; i < inputsRegister.length; i++){
		if(inputsRegister[i].classList.contains("invalid")){
			event.preventDefault();
			alert("Validacija nije prošla.");
			validno = false;
			break;
		}
	}

	return validno;
}

function validateCheckOutForm(){
	var validno = true;
	for(var i = 0; i < inputsCheckout.length; i++){
		if(inputsCheckout[i].classList.contains("invalid")){
			event.preventDefault();
			alert("Validacija nije prošla.");
			validno = false;
			break;
		}
	}
	return validno;
}