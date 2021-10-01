
<!-- POCETAK php za login -->
<?php 

//session_start(); 
//ne mora session_start() jer je vec zapocet u index-u!!!



$email = "";
$password1 = "";

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


// if(isset($_POST['prijaviSe'])){
//   $unetEmail = $_POST['email'];
//   $unetPass = $_POST['password1'];
//   $upit = "SELECT * FROM korisnik WHERE email = '" .$unetEmail. "' and password = '" 
//   .sha1($unetPass). "'";

  // if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
  //   echo $_SESSION['message'];
  // }


//   $rezUpita=$mysqli->query($upit);

//   if(!$rezUpita){
//     print("Ne moze se izvrsiti upit!");
//     die("Greska:" . $mysqli->error .
//       "<br>Broj greske: " . $mysqli->errno);
//   } 
//   if(!($red = $rezUpita->fetch_assoc())){
//     print("Failed to login!");
//   }
//   else{
//     if($red['usertype'] == "admin"){
//       header('Location: galerija.php');
//     }
//     else{
//   // if($red["email"] == $unetEmail && $red["password"] == $unetPass){
//     header('Location: index.php');
//     print("Login success!!!". "  Welcome ". $red["ime"] . " " . $red["prezime"]);
//   }
// }
// }


?>
<!-- KRAJ php za login -->

<!-- pocetak modal dialog-a za login! -->

<!-- Modal -->
<div class="modal fade" id="modalDijalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" id="headerLogin">
        <h3 class="modal-title" id="exampleModalLabel">Prijava</h3>
        <button id="btnX" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyLogin">
        <form method="post" action="php/loginSystem.php">
          <div class="form-group">
            <label for="email">E-mail adresa</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Unesite e-mail adresu" required>
          </div>
          <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Unesite password" required>
          </div>
        </div>
        <div class="modal-footer" id="footerLogin">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="prijaviSe" class="btn btn-success">Prijava <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
        </div>
      </form>
    </div>
  </div>
</div>
