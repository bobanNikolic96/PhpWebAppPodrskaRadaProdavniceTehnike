<!-- POCETAK php za login -->
<?php 

session_start(); //za kreiranje $_SESSION varijabli za prenos informacija izmedju strana!!!


$email = "";
$password1 = "";
// $_SESSION['message'] = "";

//to prevent mysql injection
// $unetEmail = $_POST['email'];
// $unetPass = $_POST['password1'];

// $unetEmail = stripcslashes($unetEmail);
// $unetPass = stripcslashes($unetPass);


$mysqli = new mysqli("localhost", "root", "", "prodavnicaTehnike");

if($mysqli->error){
  die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}
// $unetEmail = $mysqli->real_escape_string($unetEmail);
// $unetPass = $mysqli->real_escape_string($unetPass);

if(isset($_POST['prijaviSe'])){
  $unetEmail = $_POST['email'];
  $unetPass = $_POST['password1'];
  $upit = "SELECT * FROM korisnik WHERE email = '" .$unetEmail. "' and password = '" 
  .sha1($unetPass). "'";



  $rezUpita=$mysqli->query($upit);

  if(!$rezUpita){
    print("Ne moze se izvrsiti upit!");
    die("Greska:" . $mysqli->error .
      "<br>Broj greske: " . $mysqli->errno);
  }


  if(!($red = $rezUpita->fetch_assoc())){ //ukoliko nije uspeo da se loguje
    $_SESSION['message'] = "Neuspesan login, proverite parametre!!!";
    header('Location: ../index.php');
  }
  else{ //ukoliko je uspesan login!!!
      $_SESSION['email1'] = $unetEmail;//email1 se zove da bismo posle unsetovali i prebacili u email samo, zato sto ocemo da se modalni dijalog samo prilikom PRVOG load-a prikaze!!!!!
      $_SESSION['idKorisnik'] = $red['idKorisnik']; //NOVO!!!!
      $_SESSION['loggedIn'] = true; //ovo smo koristili prilikom prikazivanja button-a za odjavu u header-u
      $_SESSION['ime'] = $red['ime'];
      $_SESSION['prezime'] = $red['prezime'];
    if($red['usertype'] == "admin"){
      $_SESSION['usertype'] = "admin";
      header('Location: ../adminSide.php');
    }
    else{ //OVDE SREDITI ZA USPESNO LOGOVANJE!!! (treba da dodamo logout u navbar-u takodje)
  // if($red["email"] == $unetEmail && $red["password"] == $unetPass){
      $_SESSION['usertype'] = "user";
      header('Location: ../index.php');
    }
}
}


?>
<!-- KRAJ php za login -->