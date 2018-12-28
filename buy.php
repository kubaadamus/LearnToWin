<?php
//-------------------------------------- Ł Ą C Z E N I E  Z  B A Z Ą  D A N Y C H ------------------------------------------//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$login = ($_GET["login"]);
$password = ($_GET["password"]);
$type = ($_GET["type"]);
$number = ($_GET["number"]);
$coins = 0;
$price = 0;

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

echo "Status podłączenia do bazy danych: ";
if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";




$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    $coins = $row[12]; //pobierz aktualną ilość coinsów z bazy danych
    $current_base = $row[13];
    $current_helmet = $row[14];
    $current_mask = $row[15];
    $current_gloves = $row[16];
    $current_torso = $row[17];
    $current_pants = $row[18];
    }
}



if($type=="helmet")
{
    echo "Chcesz kupić: <br>";
    //Helmet który chcesz kupić
    $sql = "SELECT * FROM helmets WHERE helmet_ID = $number " ;
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result))
        {
        $price = $row[2];
        
        foreach ($row as $value) { 
            echo "<td> " . $value . "</td>"; 
            
        }
        }

    }
    echo "<br>Masz: <br>";
    //Helmet który masz
    $sql = "SELECT * FROM helmets WHERE helmet_ID = $current_helmet" ;
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result))
        {
        $current_helmet_price = $row[2];
        foreach ($row as $value) { 
            echo "<td> " . $value . "</td>"; 
            
        }
        }
    }

    $coins += intval($current_helmet_price);
 
}



echo "<br/> masz monet: ".$coins;

$rest = intval($coins) - intval($price);

echo "<br> Po dokonaniu zakupu zostanie Ci: ".$rest." monet";


   if(intval($coins)-intval($price)>=0)
    {
        echo "<br>Możesz kupić XD";
        $sql_updateGear = "UPDATE uczniowie SET helm = $number WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
        mysqli_query($database, $sql_updateGear); // Wykonaj uaktualnienie uzbrojenia
    }
    else{
        echo "<br>NIE MOŻESZ KUPIĆ";
    }


function printRow($a){
echo $a."<br/>";
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}


?>

<html>
<body>
    

</body>

</html>