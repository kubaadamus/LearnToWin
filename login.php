<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<link rel = "stylesheet" type = "text/css" href = "styles.css" />
<?php include 'database_update.php';?>
</head>
<body>
<div id="coins">
    
</div>
<form id="myForm" action="buy.php">
  <input type="text" id="login" name="login" ><br><br>
  <input type="text" id="password" name="password" ><br><br>
  <input type="text" id="baza" name="baza" ><br><br>
  <input type="submit" value="Submit form">
</form>

<script>
    var coins = parseInt("<?php echo $coins ?>");
    var login = ("<?php echo $login ?>");
    var password = ("<?php echo $password ?>");
    var id = ("<?php echo $id ?>");
    var ranga = ("<?php echo $ranga ?>");
    var baza = ("<?php echo $baza ?>");
    var helm = ("<?php echo $helm ?>");
    var maska = ("<?php echo $maska ?>");
    var rekawice = ("<?php echo $rekawice ?>");
    var torso = ("<?php echo $torso ?>");
    var spodnie = ("<?php echo $spodnie ?>");
    var buty = ("<?php echo $buty ?>");
    var bron = ("<?php echo $bron ?>");
    var apteczka = ("<?php echo $apteczka ?>");
    var granaty = ("<?php echo $granaty ?>");
    var secondary = ("<?php echo $secondary ?>");
    var spec1 = ("<?php echo $spec1 ?>");
    var spec2 = ("<?php echo $spec2 ?>");
    var spec3 = ("<?php echo $spec3 ?>");




$( document ).ready(function() {
    document.getElementById("coins").innerHTML = coins;
    $('#login').val(login);
    $('#password').val(password);
    $('#baza').val(baza);

});



</script>







</body>
</html>