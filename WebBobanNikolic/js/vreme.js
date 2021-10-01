function Vreme(){
			time = new Date();
			cas = time.getHours();
			minuti = time.getMinutes();
			sekunde = time.getSeconds();
			temp = "" + ((cas>12)? "0"+ (cas-12):cas);
			temp += ((minuti < 10)? ":0":":") + minuti;
			temp += ((sekunde < 10)? ":0":":") + sekunde;
			temp += ((cas >= 12)? " P.M.": " A.M.");
			document.vremeForma.cifre.value = temp;
			setTimeout("Vreme()", 1000);

		}