function promena(){
	var selektovanaVr = document.getElementById("kriterijumDropDown").value; 
	var kriterijumInput = document.getElementById("podatak");
	if(selektovanaVr == "idKorisnik"){
		kriterijumInput.value = "";
		kriterijumInput.setAttribute("type", "number");
		kriterijumInput.setAttribute("placeholder", "ID korisnika");
		kriterijumInput.setAttribute("min", "0");
	}
	if(selektovanaVr == "email"){
		kriterijumInput.value = "";
		kriterijumInput.removeAttribute("min");
		kriterijumInput.setAttribute("type", "email");
		kriterijumInput.setAttribute("placeholder", "Email");
	}
}