<?php
//-------------------------------------- Ł Ą C Z E N I E  Z  B A Z Ą  D A N Y C H ------------------------------------------//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$itemClass = ($_GET["itemClass"]);
$item = ($_GET["item"]);
$price = ($_GET["price"]);
$login = ($_GET["login"]);
$password = ($_GET["password"]);

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

echo "Status podłączenia do bazy danych: ";
if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";




printRow($itemClass);
printRow($item);
printRow($price);
printRow($login);
printRow($password);



$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    echo $row[12];
    }
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