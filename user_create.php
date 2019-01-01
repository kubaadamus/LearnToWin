<?php
//=================================================== PODŁĄCZENIE DO BAZY DANYCH =============================================//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

$login = ($_GET["login"]);
$password = ($_GET["password"]);

//=================================================== STWORZENIE OBIEKTU UCZNIA =============================================//

$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
        $uczen_pobrany = json_decode($row[6]); // bo w 6 kolumnie ucznia jest zapisana postać w jsonie
    }
}

echo json_encode($uczen_pobrany);

?>