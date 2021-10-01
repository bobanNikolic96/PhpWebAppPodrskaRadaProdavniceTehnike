

<?php  
//konekcija sa bazom 
$mysqli = new mysqli("localhost", "root", "", "prodavnicatehnike");

if($mysqli->error){
  die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

//izvrsavanje upita
$upitPC = "SELECT * FROM proizvod WHERE vrsta='mis' ";

$rezUpita = $mysqli->query($upitPC);

if(!$rezUpita){
  print("Ne moze se izvrsiti upit!");
  die("Greska:" . $mysqli->error .
    "<br>Broj greske: " . $mysqli->errno);
}



?>
<div class="page-header">
  <h2>Misevi</h2>
</div>
<?php if(isset($_SESSION['dodatoUKorpu']) && isset($_SESSION['nazivProiz'])){
  ?>


  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Proizvod <strong><?php echo $_SESSION['nazivProiz']; ?></strong> (Količina: 1) ste uspešno dodali u vašu korpu!
  </div>
  <?php 
  unset($_SESSION['dodatoUKorpu']);
} 
?>

<div class="row">
  <?php  if($rezUpita->num_rows == 0){
    echo "Nema nijednog proizvoda!";
  }
  else{

    while($red = $rezUpita->fetch_assoc()){

      $_SESSION['idProizvoda'] = $red['idProizvoda'];//novo
    //!!!!!!izracunavanje ukupne cene!!!!!!
      if(($red['popust'] != null) && ($red['popust'] != 0)){ //ako ima popusta (nije null i nije nula)
        $ukupCena = $red['cena'] * (1 - $red['popust']/100);
      }
      else{
        $ukupCena = $red['cena'];
      }
      $red["ukupnaCena"] = $ukupCena;
      $updateUkupnaCena = "UPDATE proizvod SET "
                              . "ukupnaCena = '" .$ukupCena . "'"
                              . " WHERE idProizvoda = '" . $red['idProizvoda'] . "'";
      $rez = $mysqli->query($updateUkupnaCena) or die($mysqli->error);
      //!!!!!!KRAJ izracunavanja ukupne cene!!!!!!

    ?>
    <div class="col-sm-6 col-md-4"> <!-- pocetak prvog -->
      <div class="thumbnail thumbpc">
        <h3 class="headerShop"> <?php echo $red['naziv']; ?><!-- Naziv proizvoda 1 --></h3>
        <?php if($red['kolicina'] <= 0){ //PROVERA KOLICINE (DA LI JE NA STANJU)!!!
              ?>
          <div class="nemaNaStanju">
                <span class="label label-danger labelaStanje" style="font-size: 13px;">Nema na stanju!</span>
                <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; ?>" class="thumbSlika" width="330px" height="330px">
          </div>
              <?php
            } else{ //ukoliko ima na stanju prikazi samo sliku (bez uvlacenja u div "nemaNaStanju")
            ?>
        <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; 
        ?>" class="thumbSlika">
      <?php } ?>

        <div class="caption">
          
          <div style="display: flex; justify-content: center;"> 
          <!-- prva forma pogledajte proizvod-->
          <form action="proizvodFront.php" method="post" class="form-inline">
            <input type="hidden" name="idIzabraniPogledaj" value="<?php echo $red['idProizvoda']; ?>">
            <button type="submit" class="btn btn-info" name="btnPogledaj" style="width: 180px;">Pogledajte <i class="fa fa-arrow-circle-right"></i></button>
          </form>
          <!-- druga forma dodavanje u korpu -->
          <form action="korisnickaKorpa.php" method="post" class="form-inline">
              <?php $_SESSION['pageName'] = 'prodavnicaMisevi.php'; ?> <!-- za redirect na nasu stranicu!!! -->
              <input type="hidden" name="izabranaKol" value="1">  
              <input type="hidden" name="idIzabrani" value="<?php echo $red['idProizvoda']; ?>">
              <input type="hidden" name="nazivProiz" value="<?php echo $red['naziv'] ?>"> 
              <?php if (isset($_SESSION['loggedIn'])) { ?>
                <?php if($red['kolicina'] <= 0){ ?> <!-- ukoliko nema proiz na stanju, onemoguciti dugme za stavljanje u korpu!!! -->
              <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;" disabled="true"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
              <?php } else{
                ?>
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
                <?php
                    }
              }
               ?>
          </form>
        </div>
            
        </div>
      </div>
    </div> <!-- kraj prvog -->
  <!--KRAJ THUMBNAILA ZA POJEDINACNI PROIZVOD -->
  <?php
    } //kraj while-a
  }//kraj else-a
?>
</div>

