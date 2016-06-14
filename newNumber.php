<?php
if(isset($_REQUEST))
{
	require_once "connect.php";

	$polaczenie = @new mysqli($servername,$user,$password,$database);

	if($polaczenie -> connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno." Opis :".$polaczenie->connect_error;
	}
	else
	{
		$priorytet = $_POST['priorytet'];
		$max = "SELECT MAX(numer) FROM kolejka";
		
		
		if($rezultat = @$polaczenie->query($max))
		{
			while ($row = $rezultat->fetch_assoc() )
			{
				$_SESSION["maxNumber"]= $row["MAX(numer)"];
				$maxNumber = $_SESSION["maxNumber"];
				$newNumber = $maxNumber+1;
			}
			
		}
		$date = date("Y-m-d G:i:s");
		$sql = "INSERT INTO kolejka (`numer`, `idTyp`, `dataRozp`) VALUES ('$newNumber', '$priorytet', '$date');";
		if($rezultat = @$polaczenie->query($sql))
		{
				mysql_query($sql);

		}
		$polaczenie->close();

	}
}
?>