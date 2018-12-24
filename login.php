<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<?php include 'phpscript.php';?>

<?php include 'uzbrojenie.html';?>


</head>
<body>



<div class="chart_wrapper" style="width:600px;height:600px;display:block;">

<div class="character" style="width:600px;height:600px;background-color:red;position:relative;display:block;">

<div class="head" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:100px;left:50%;transform:translate(-50%,-50%);"></div>
<div class="torso" style="width:100px;height:100px;background-color:blue;position:absolute;display:block;top:220px;left:50%;transform:translate(-50%,-50%);"></div>
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
    console.log(helmets[i].helmet_name);
}

</script>


</div>

<div id="torsos" class="hidable">
    <div id="helmet1" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet2" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet3" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet4" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet5" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet6" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>

</div>

<div id="gloves" class="hidable">
    <div id="helmet1" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet2" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet3" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet4" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>

</div>

<div id="legs" class="hidable">
    <div id="helmet1" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet2" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet3" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>


</div>

<div id="boots" class="hidable">
    <div id="helmet1" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>
    <div id="helmet2" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>


</div>

<div id="weapons" class="hidable">
    <div id="helmet1" style="width:80px;height:80px;background-color:grey;position:relative;display:inline-block;margin:20px;"></div>


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
$('.torso').click(function() {
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