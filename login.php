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


include 'draw_shop.php';


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