<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<link rel = "stylesheet" type = "text/css" href = "styles.css" />
<?php include 'database_update.php';?>
</head>
<body>


<form id="buyform" action="buy.php">
<input type="text" id="login" name="login" ><br><br>
<input type="text" id="password" name="password" ><br><br>
<input type="text" id="cokupic" name="type" ><br><br>
<input type="text" id="ktore" name="number" ><br><br>

</form>

<input type="button" obj_type="helmet" obj_number="0" value="buy helmet 0">
<input type="button" obj_type="helmet" obj_number="1" value="buy helmet 1">
<input type="button" obj_type="helmet" obj_number="2" value="buy helmet 2">
<input type="button" obj_type="helmet" obj_number="3" value="buy helmet 3">


<script>
    var coins = parseInt("<?php echo $coins ?>");
    var login = ("<?php echo $login ?>");
    var password = ("<?php echo $password ?>");
    var id = ("<?php echo $id ?>");
    var ranga = ("<?php echo $ranga ?>");

    
    $("input").click(function(event) { // Przy kliknięciu na kupno jakiegoś elementu submituje form buyform z odpowiednim inputem
        alert($(event.target).attr("obj_type"));
        $('#cokupic').val($(event.target).attr("obj_type"));
        $('#ktore').val($(event.target).attr("obj_number"));
        $('#buyform').submit();

    });


$( document ).ready(function() {

    $('#coins').val(coins);
    $('#login').val(login);
    $('#password').val(password);
    $('#id').val("id "+id);
    $('#ranga').val("ranga "+ranga);

//BASE//
var current_base = '<?php echo json_encode($current_base); ?>';
var current_base_data = JSON.parse(current_base );
//alert(current_base_data.base_name);

//HELMET//
var current_helmet = '<?php echo json_encode($current_helmet); ?>';
var current_helmet_data = JSON.parse(current_helmet );
//alert(current_helmet_data.helmet_name);

//TORSO//
var current_torso = '<?php echo json_encode($current_torso); ?>';
var current_torso_data = JSON.parse(current_torso );
//alert(current_torso_data.torso_name);


var current_value = parseInt(current_base_data.base_price) + parseInt(current_helmet_data.helmet_price) + parseInt(current_torso_data.torso_price);
console.log("current_price: "+current_value);
console.log("coins: "+coins);


});




</script>





</body>
</html>