<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
</head>
<body>

<?php

		$user = 'jakubadamus';
		$DBpassword = 'Kubaadamus1991';
		$db = 'jakubadamus';
		$host = 'mysql.cba.pl';
		$port = 3360;

		$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());
		
		echo "Status podłączenia do bazy danych: ";
        if ($database) {
		  echo 'conected';
		} else {
		  echo 'not conected';
        }
        echo "<br>";

        $login = ($_GET["login"]);
        $password = ($_GET["password"]);
        $ranga;
        $srednia;

        $mat=5;
        $fiz=3;
        $pl=2;
        $coins=0;


        //Złap tutaj wszystkie wiersze odppwiadające uczniowi o indeksie 1 i wyłącznie z matematyki.

//Iterując przez wiersze, pobieraj datę i ocenę. Tworz z tego dwie tabele - date i note. date będą do labeli a note będą do data.


//Przedmioty//

$mat_date = array();
$mat_note = array();

$fiz_date = array();
$fiz_note = array();

$inf_date = array();
$inf_note = array();

$pl_date = array();
$pl_note = array();

//==============//
        
        $sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
        $result = mysqli_query($database,$sql);

        $success = mysqli_num_rows($result);
        printRow($success);

        if($success>0)
        {
            while ($row=mysqli_fetch_row($result))
            {
            $id = $row[0];
            $ranga = $row[8];
            $srednia = $row[9];
            }
    
            echo "<h1>Witaj ".$login." ".$password."</h1>";
    
            printRow("ID:".$id);
            printRow($ranga);
            printRow($srednia);
    
            $sql = "SELECT * FROM oceny WHERE uczen_ID = '".$id."'" ;
            $result = mysqli_query($database,$sql);
    
            $success = mysqli_num_rows($result);
            printRow($success);


            echo "Oceny <br/>";
            $average = 0.0;
            while ($row=mysqli_fetch_row($result))
            {
            printRow($row[0]."\t".$row[1]."\t".$row[2]."\t".$row[3]."\t".$row[4]."\t".$row[5]."\t");
            $average += $row[3];

                if($row[2]=="mat")
            {
                $coins += $mat*$row[3];
                //dodawaj do date i note//
                array_push($mat_date, $row[5]);
                array_push($mat_note, $row[3]);
            }
            if($row[2]=="fiz")
            {
                $coins += $fiz*$row[3];
                array_push($fiz_date, $row[5]);
                array_push($fiz_note, $row[3]);
            }
            if($row[2]=="pl")
            {
                $coins += $pl*$row[3];
                array_push($pl_date, $row[5]);
                array_push($pl_note, $row[3]);
            }

            }

            $average = $average/$success;

            echo $average;

            echo "Punkty: ".$coins;

        }
        else{
            printRow("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
        }

function printRow($a){
echo $a."<br/>";
}


?>

<div class="chart_wrapper" style="width:600px;height:600px;">
<canvas id="mat_chart" ></canvas>
<canvas id="fiz_chart" ></canvas>
<canvas id="pl_chart" ></canvas>
</div>






<script>
var mat_date = <?php echo json_encode($mat_date); ?>;
var mat_note = <?php echo json_encode($mat_note); ?>;
new Chart(document.getElementById("mat_chart"),{"type":"line","data":{"labels":
    mat_date
,"datasets":[{"label":"matematyka",
"data":mat_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>


<script>
var fiz_date = <?php echo json_encode($fiz_date); ?>;
var fiz_note = <?php echo json_encode($fiz_note); ?>;
new Chart(document.getElementById("fiz_chart"),{"type":"line","data":{"labels":
    fiz_date
,"datasets":[{"label":"fizyka",
"data":fiz_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>


<script>
var pl_date = <?php echo json_encode($pl_date); ?>;
var pl_note = <?php echo json_encode($pl_note); ?>;
new Chart(document.getElementById("pl_chart"),{"type":"line","data":{"labels":
    pl_date
,"datasets":[{"label":"polski",
"data":pl_note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>

</html>