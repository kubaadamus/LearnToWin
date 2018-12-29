<html>
<head>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'></script>
<link rel = 'stylesheet' type = 'text/css' href = 'styles.css' />
<?php include 'database_update.php';?>


</head>
<body>

<form id='myForm' action='buy.php' style="">
    <input type='text' id='login' name='login' value='<?php echo $login ;?>'><br><br>
    <input type='text' id='password' name='password' value='<?php echo $password ;?>'><br><br>
    <input type='text' id='sellbuy' name='sellbuy' value='sell/buy'><br><br>
    <input type='text' id='item' name='item' value='item_name'><br>
    <input type='text' id='id' name='id' value='item_id'><br>
</form>
<?php
include 'draw_shop.php';
?>


<div class="item_container" style="background-color:lightgrey;width:500px;min-height:500px">
<div class="item_thumbnail" style="background-image:url(assets/bases/base_sniper.png);width:200px;height:200px;border:2px solid black;"></div>
<div class="item_properties"   style="background-color:red;width:200px;height:200px;border:2px solid black;"></div>
<input style="background-color:green;width:100px;height:50px" id="buyBtn" type='button' value='kup' sellbuy='buy' item_name='name' item_id='id' >

</div>

<div class="shop_container">
    <input class="ShopSelectBtn" type="button" value="select bases" select="base">
    <input class="ShopSelectBtn" type="button" value="select weapons" select="weapon">
    <input class="ShopSelectBtn" type="button" value="select boots" select="boots">
<?php DrawAllGear($base_array,'base');?>
<?php DrawAllGear($weapon_array,'weapon');?>
<?php DrawAllGear($boots_array,'boots');?>
</div>



<script>
$('.przycisk').click(function( event ) {
  //event.target.nodeName
  //alert($(event.target).attr('class'));
  $('#sellbuy').attr('value',$(event.target).attr('sellbuy'));
  $('#item').attr('value',$(event.target).attr('item_name'));
  $('#id').attr('value',$(event.target).attr('item_id'));
  $('#myForm').submit();
});


//Shop Items Select
$('.ShopSelectBtn').click(function( event ) {
  $( "div[itemClass]" ).hide();
  $( "div[itemClass='"+$(event.target).attr('select')+"']" ).show();
});


//Select Specific Item
$('.itemSelect').click(function( event ) {
      //alert($(event.target).attr('class'));

        var baseArray = <?php echo json_encode($base_array); ?>;
        var helmet_array = <?php echo json_encode($helmet_array); ?>;
        var torso_array = <?php echo json_encode($torso_array); ?>;
        var gloves_array = <?php echo json_encode($gloves_array); ?>;
        var pants_array = <?php echo json_encode($pants_array); ?>;
        var boots_array = <?php echo json_encode($boots_array); ?>;
        var weapon_array = <?php echo json_encode($weapon_array); ?>;

        var object;

            if($(event.target).attr('itemType')=='base'){
                object =baseArray[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='helmet'){
                object =helmet_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='torso'){
                object =torso_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='gloves'){
                object =gloves_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='pants'){
                object =pants_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='boots'){
                object =boots_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon'){
                object =weapon_array[$(event.target).attr('itemID')-1];
            }


      $('.item_thumbnail').css("background-image", "url("+object.thumbnail+")");

      $('.item_properties').html( object.id+" "+object.name+" "+object.price+" "+object.defence+" "+object.attack );
      $('#buyBtn').attr("value","kup "+object.name+"");
      $('#item').val($(event.target).attr('itemType'));
      $('#id').val($(event.target).attr('itemID'));
      $('#sellbuy').val('buy');
      
});


$('#buyBtn').click(function( event ) {
    $('#myForm').submit();
});

</script>

</body>
</html>