<?php
	require_once "connect.php";

	$polaczenie = @new mysqli($servername,$user,$password,$database);

	if($polaczenie -> connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno." Opis :".$polaczenie->connect_error;
	}
	else
	{

		$sql = "SELECT * FROM oczekujacy WHERE czyObsluzony = 0 ORDER BY priorytet DESC";
		
		if($rezultat = @$polaczenie->query($sql))
		{
			while ($row = $rezultat->fetch_assoc() )
				{
					$array[] = $row['numerek'];
					echo $row['numerek'];
				}
			$_SESSION['oczekujacy']= $array;
		}
		
		$polaczenie->close();
	}
?>