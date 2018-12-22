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

$date = array();
$note = array();

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
                array_push($date, $row[5]);
                array_push($note, $row[3]);
            }
            if($row[2]=="fiz")
            {
                $coins += $fiz*$row[3];
            }
            if($row[2]=="pl")
            {
                $coins += $pl*$row[3];
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



echo "oceny i daty z matmy";

printRow($date[0]." ".$note[0]);
printRow($date[1]." ".$note[1]);
printRow($date[2]." ".$note[2]);



?>




<canvas id="myChart" width="400" height="400"></canvas>

<script>


var date = <?php echo json_encode($date); ?>;
var note = <?php echo json_encode($note); ?>;

new Chart(document.getElementById("myChart"),{"type":"line","data":{"labels":
date
,"datasets":[{"label":"My First Dataset",
"data":note,
"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>





</html>