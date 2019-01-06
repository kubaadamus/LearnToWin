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
$query = ($_GET["query"]);
//============================================= OBLICZENIE AKTUALNEJ WARTOŚCI UCZNIA =======================================//


    $result = mysqli_query($database,$query);
    $success = mysqli_num_rows($result);

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

    echo json_encode($rows);

?>