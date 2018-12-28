<html>
<head>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'></script>
<link rel = 'stylesheet' type = 'text/css' href = 'styles.css' />
<?php include 'database_update.php';?>
</head>
<body>

<form id='myForm' action='buy.php' style="display:none">
    <input type='text' id='login' name='login' value='<?php echo $login ;?>'><br><br>
    <input type='text' id='password' name='password' value='<?php echo $password ;?>'><br><br>
    <input type='text' id='sellbuy' name='sellbuy' value='sell/buy'><br><br>
    <input type='text' id='item' name='item' value='item_name'><br>
    <input type='text' id='id' name='id' value='item_id'><br>
</form>
<?php

if($uczen_pobrany->helmet!=0){
    echo "<br/><input class='przycisk' type='submit' value='Sell helmet' sellbuy='sell' item_name='helmet' item_id='1' >";
}
else{
    echo "<br/>
    <input class='przycisk' type='submit' value='Buy helmet 1' sellbuy='buy' item_name='helmet' item_id='1' >
    <input class='przycisk' type='submit' value='Buy helmet 2' sellbuy='buy' item_name='helmet' item_id='2' >
    <input class='przycisk' type='submit' value='Buy helmet 3' sellbuy='buy' item_name='helmet' item_id='3' >";
}
if($uczen_pobrany->torso!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell torso' sellbuy='sell' item_name='torso' item_id='1' >";
}
else{
    echo "<br/>
    <input class='przycisk' type='submit' value='Buy torso 1' sellbuy='buy' item_name='torso' item_id='1' >
    <input class='przycisk' type='submit' value='Buy torso 2' sellbuy='buy' item_name='torso' item_id='2' >
    <input class='przycisk' type='submit' value='Buy torso 3' sellbuy='buy' item_name='torso' item_id='3' >";
}
if($uczen_pobrany->base!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell base' sellbuy='sell' item_name='base' item_id='1' >";
}
else{
    echo "<br/>
    <input class='przycisk' type='submit' value='Buy base 1' sellbuy='buy' item_name='base' item_id='1' >
    <input class='przycisk' type='submit' value='Buy base 2' sellbuy='buy' item_name='base' item_id='2' >
    <input class='przycisk' type='submit' value='Buy base 3' sellbuy='buy' item_name='base' item_id='3' >";
}
if($uczen_pobrany->gloves!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell gloves' sellbuy='sell' item_name='gloves' item_id='1' >";
}
else{
    echo"<br/>
    <input class='przycisk' type='submit' value='Buy gloves 1' sellbuy='buy' item_name='gloves' item_id='1' >
    <input class='przycisk' type='submit' value='Buy gloves 2' sellbuy='buy' item_name='gloves' item_id='2' >
    <input class='przycisk' type='submit' value='Buy gloves 3' sellbuy='buy' item_name='gloves' item_id='3' >";
}
if($uczen_pobrany->pants!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell pants' sellbuy='sell' item_name='pants' item_id='1' >";
}
else{
    echo "<br/>
    <input class='przycisk' type='submit' value='Buy pants 1' sellbuy='buy' item_name='pants' item_id='1' >
    <input class='przycisk' type='submit' value='Buy pants 2' sellbuy='buy' item_name='pants' item_id='2' >
    <input class='przycisk' type='submit' value='Buy pants 3' sellbuy='buy' item_name='pants' item_id='3' >";
}
if($uczen_pobrany->boots!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell boots' sellbuy='sell' item_name='boots' item_id='1' >";
}
else{
echo"<br/>
<input class='przycisk' type='submit' value='Buy boots 1' sellbuy='buy' item_name='boots' item_id='1' >
<input class='przycisk' type='submit' value='Buy boots 2' sellbuy='buy' item_name='boots' item_id='2' >
<input class='przycisk' type='submit' value='Buy boots 3' sellbuy='buy' item_name='boots' item_id='3' >";
}

if($uczen_pobrany->weapon!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell weapon' sellbuy='sell' item_name='weapon' item_id='1' >";
}
else{
    echo
    "
    <br/>
<input class='przycisk' type='submit' value='Buy weapon 1' sellbuy='buy' item_name='weapon' item_id='1' >
<input class='przycisk' type='submit' value='Buy weapon 2' sellbuy='buy' item_name='weapon' item_id='2' >
<input class='przycisk' type='submit' value='Buy weapon 3' sellbuy='buy' item_name='weapon' item_id='3' >
    ";
}

$bar = (($wartosc_postaci*intval(100))/$coins);
echo "<div style='background-color:red;width:20px;height:100px;position:relative'>
<div style='background-color:blue;width:20px;height:".$bar.";position:absolute;bottom:0px'></div>
</div>";



//Pobieranie wszystkich hełmów






?>

<script>
$('.przycisk').click(function( event ) {
  //event.target.nodeName
  //alert($(event.target).attr('class'));
  $('#sellbuy').attr('value',$(event.target).attr('sellbuy'));
  $('#item').attr('value',$(event.target).attr('item_name'));
  $('#id').attr('value',$(event.target).attr('item_id'));
  $('#myForm').submit();
});
</script>

</body>
</html>