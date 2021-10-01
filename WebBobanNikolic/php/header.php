<div class="row">
  <div class="col-md-9">
    <div class="page-header" id="page-headerGornji">
      <h1><a href="index.php"><img src="img/Logo5.png" alt="Logo kompanije"></a><small>Prodavnica tehnike</small></h1>
    </div>
  </div>
  <br>
  <div class="col-md-3">
    <div class="input-group" id="vremeFrm">
      <span class="input-group-addon">
        <i class="fa fa-clock"></i>
      </span>
      <form name="vremeForma"><input type="text" name="cifre" class="form-control">
      </form>
    </div>
    <br>
    <form class="form-inline" id="frmOdjava">
      <!-- <div class="form-group"> -->
        <?php 
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ 
         if(isset($_SESSION['ime']) && !empty($_SESSION['ime'])
            && isset($_SESSION['prezime']) && !empty($_SESSION['prezime'])){
            echo $_SESSION['ime']. " " . $_SESSION['prezime'];
          }
      ?>
          <input type="button" name="btnOdjava" value="Odjavite se" id="btnOdjava" data-toggle="modal" data-target="#modalOdjava">
      <?php 
        }
    ?>
    

<?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && 
       $_SESSION['usertype'] == "user"){?>
<br>
<a href="istorijaNarucivanja.php" style="float: right; margin-top: 5px; color: #000099;">Istorija kupovine</a>
<?php } ?>



</form>

</div>
</div>


<!-- !!!require direktiva kada izvrsava kod STOPIRA skriptu kada naidje na gresku!!! -->
    <!-- !!!include direktiva kada izvrsava kod IZBACUJE WARNING ALI ne zaustavlja izvrsavanje skripte!!! -->