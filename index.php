<html>

<h1>LearnToWin</h1>




<?php
		$user = 'jakubadamus';
		$DBpassword = 'Kubaadamus1991';
		$db = 'jakubadamus';
		$host = 'mysql.cba.pl';
		$port = 3360;

		$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());


		$query2 = "SELECT * FROM uczniowie";

		$response = mysqli_query($database,$query2);

		$ilosc_uczniow = mysqli_num_rows($response);

		echo "Ilosc uczniow: ".$ilosc_uczniow."<br>";

		
		echo "Status podłączenia do bazy danych: ";
        if ($database) {
		  echo 'conected';
		} else {
		  echo 'not conected';
		}

		echo "<br>";
/*
		if ($response->num_rows > 0) {
			// output data of each row
			$lp=1;
			$moje_odwiedziny=0;
			while($row = $response->fetch_assoc()) {
                    echo $lp."|nazwa_szkoly:".$row["nazwa_szkoly"].
                    "|Imie:".$row["imie"].
                    "|Nazwisko:".$row["nazwisko"].
                    "|Klasa:".$row["klasa"].
                    "|Semestr:".$row["semestr"].
                    "|Rok:".$row["rok"].
                    "|Ranga:".$row["ranga"].
                    "|Średnia:".$row["srednia"].
                    "<br>";
					$lp+=1;
			}
		} else {
			echo "<br>0 results";
		}
*/
?>



<form action="login.php">
  First name:<br>
  <input type="text" name="login" value="Mickey">
  <br>
  Last name:<br>
  <input type="text" name="password" value="Mouse">
  <br><br>
  <input type="submit" value="Submit">
</form> 



</html>