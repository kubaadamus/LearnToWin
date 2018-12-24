<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<link rel = "stylesheet" type = "text/css" href = "styles.css" />
<?php include 'phpscript.php';?>

<script>
var coins = parseInt("<?php echo $coins ?>");



//alert(coins);

$( document ).ready(function() {
    document.getElementById("coins").innerHTML = coins;

    $('#login').val(("<?php echo $login ?>"));
    $('#password').val(("<?php echo $password ?>"));
});


$(document).click(function(event) {

    if($(event.target).attr('class')=="helmet")
    {
        //alert($(event.target).attr('class') +" "+ $(event.target).attr('id') + "price: "+ helmets[$(event.target).attr('id')-1].helmet_price);

        //parseInt(coins)>=parseInt(helmets[$(event.target).attr('id')-1].helmet_price)
        
            //coins -= parseInt(helmets[$(event.target).attr('id')-1].helmet_price);
            //alert("Kupiono hełm");
            document.getElementById("coins").innerHTML = coins;

            var someVar = helmets[$(event.target).attr('id')-1].helmet_name;
            var anotherVar = helmets[$(event.target).attr('id')-1].helmet_price;

            $('#itemClass').val("helmet");
            $('#item').val(someVar);
            $('#price').val(anotherVar);

        
    }

});




</script>

</head>
<body>



<form id="myForm" action="buy.php">
<input type="text" id="itemClass" name="itemClass" value="helmetx"><br>
  <input type="text" id="item" name="item" value="0"><br>
  <input type="text" id="price" name="price" value="price"><br><br>

  <input type="text" id="login" name="login" value="price"><br><br>
  <input type="text" id="password" name="password" value="price"><br><br>
  <input type="submit" value="Submit form">
</form>

<script>
function myFunction() {
  document.getElementById("myForm").submit();
}
</script>




<div class="chart_wrapper" style="width:600px;height:600px;display:block;">


<div id="coins">
    
</div>
<div class="character" style="width:600px;height:600px;background-color:red;position:relative;display:block;">

<div class="head" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:100px;left:50%;transform:translate(-50%,-50%);"></div>
<div class="chest" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:220px;left:50%;transform:translate(-50%,-50%);"></div>
<div class="gloves" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:220px;left:70%;transform:translate(-50%,-50%);"></div>
<div class="legs" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:340px;left:50%;transform:translate(-50%,-50%);"></div>
<div class="boots" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:450px;left:60%;transform:translate(-50%,-50%);"></div>
<div class="weapon" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:220px;left:30%;transform:translate(-50%,-50%);"></div>

</div>

<div class="shop" style="width:560px;background-color:green;position:relative;display:block;padding:20px;">

    <div id="shop_tab">
    </div>


<div id="helmets" class="hidable">
<script>
var helmets = <?php echo json_encode($helmet_array) ?>;
for(i=0; i<helmets.length ;i++)
{
    $( "#helmets" ).append( "<div class='helmet' id='"+helmets[i].helmet_id+"'>"+helmets[i].helmet_name+"</div>" );
}
</script>
</div>
<div id="torsos" class="hidable">
<script>
var torsos = <?php echo json_encode($torso_array) ?>;
for(i=0; i<torsos.length ;i++)
{
    $( "#torsos" ).append( "<div class='torso' id='"+torsos[i].torso_id+"'>"+torsos[i].torso_name+"</div>" );
}
</script>
</div>

<div id="gloves" class="hidable">


</div>

<div id="legs" class="hidable">



</div>

<div id="boots" class="hidable">



</div>

<div id="weapons" class="hidable">



</div>

</div>
<canvas id="mat_chart" ></canvas><div id="mat"></div>
<canvas id="fiz_chart" ></canvas><div id="fiz"></div>
<canvas id="pl_chart" ></canvas><div id="pl"></div>
<canvas id="balance" class="chartjs" width="770" height="385" style="display: block; width: 770px; height: 385px;"></canvas>

</div>


</body>

<script>
$('.head').click(function() {
        document.getElementById("shop_tab").innerHTML = "helmy";
        $('.hidable').show();
$('.hidable').not('#helmets').hide();
});
$('.chest').click(function() {
        document.getElementById("shop_tab").innerHTML = "tors";
        $('.hidable').show();
        $('.hidable').not('#torsos').hide();
});
$('.gloves').click(function() {
        document.getElementById("shop_tab").innerHTML = "rekawice";
        $('.hidable').show();
        $('.hidable').not('#gloves').hide();
});
$('.legs').click(function() {
        document.getElementById("shop_tab").innerHTML = "nogi";
        $('.hidable').show();
        $('.hidable').not('#legs').hide();
});
$('.boots').click(function() {
        document.getElementById("shop_tab").innerHTML = "buty";
        $('.hidable').show();
        $('.hidable').not('#boots').hide();
});
$('.weapon').click(function() {
        document.getElementById("shop_tab").innerHTML = "broń";
        $('.hidable').show();
        $('.hidable').not('#weapons').hide();
});
</script>


<script>
var mat_date = <?php echo json_encode($mat_date); ?>;
var mat_note = <?php echo json_encode($mat_note); ?>;
var mat_coins = "<?php echo $mat_coins ?>";
new Chart(document.getElementById("mat_chart"),{"type":"line","data":{"labels":
    mat_date
,"datasets":[{"label":"matematyka",
"data":mat_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});

document.getElementById("mat").innerHTML = mat_coins;

var fiz_date = <?php echo json_encode($fiz_date); ?>;
var fiz_note = <?php echo json_encode($fiz_note); ?>;
var fiz_coins = "<?php echo $fiz_coins ?>";
new Chart(document.getElementById("fiz_chart"),{"type":"line","data":{"labels":
    fiz_date
,"datasets":[{"label":"fizyka",
"data":fiz_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
document.getElementById("fiz").innerHTML = fiz_coins;

var pl_date = <?php echo json_encode($pl_date); ?>;
var pl_note = <?php echo json_encode($pl_note); ?>;
var pl_coins = "<?php echo $pl_coins ?>";
new Chart(document.getElementById("pl_chart"),{"type":"line","data":{"labels":
    pl_date
,"datasets":[{"label":"polski",
"data":pl_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
document.getElementById("pl").innerHTML = pl_coins;

new Chart(document.getElementById("balance"),
{"type":"doughnut",
"data":{"labels":["Matematyka","Fizyka","Polski"],
"datasets":[{"label":"Balans",
"data":[mat_coins,fiz_coins,pl_coins],"backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]}]}});
</script>
</html>