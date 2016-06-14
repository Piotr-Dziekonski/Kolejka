<?php
session_start(); 
if(isset($_REQUEST))
{
	 $licznikP = $_SESSION['licznikP'];
	require_once "connect.php";
	$polaczenie = @new mysqli($servername,$user,$password,$database);

	if($polaczenie -> connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno." Opis :".$polaczenie->connect_error;
	}
	else
	{
		$sql = "SELECT COUNT(idKolejka) AS ile FROM kolejka WHERE obslugiwany = 0 AND dataZak='0000-00-00 00:00:00';";
		if($result = $polaczenie->query($sql))
		{
			while ($row = $result->fetch_assoc() )
			{
				$ileZostalo = $row['ile'];
			}
		}
		if(!($ileZostalo == 0))
		{
			$proba = 0;
			function x($polaczenie,$proba)
			{	
				$proba++;
				if($_SESSION['licznikP'] == 2)
				{
					$sql = "SELECT numer, idTyp FROM kolejka WHERE idTyp IN (SELECT idTyp FROM kolejka WHERE dataZak='0000-00-00 00:00:00' AND obslugiwany = 0 AND idTyp=1) AND dataZak = '0000-00-00 00:00:00' AND obslugiwany = 0 ORDER BY numer ASC Limit 0,1;";
					$_SESSION['licznikP'] = 0;
					
					
				}
				else
				{
					$sql = "SELECT numer, idTyp FROM kolejka WHERE idTyp IN (SELECT idTyp FROM kolejka WHERE dataZak='0000-00-00 00:00:00' AND obslugiwany = 0 AND idTyp=2) AND dataZak = '0000-00-00 00:00:00' AND obslugiwany = 0 ORDER BY numer ASC Limit 0,1;";
					
					$_SESSION['licznikP']++;
					
				}
				if($result = $polaczenie->query($sql))
				{
					while ($row = $result->fetch_assoc() )
					{
						$currentData = $row;
						$numer = $row['numer'];
						
					}
					
				}
				$sqlO = "UPDATE `kolejka` SET `obslugiwany` = '1' WHERE `kolejka`.`numer` = '$numer';";
				mysqli_query($polaczenie, $sqlO);
				if($proba == 2)
				{
					return $err;
				}
				else if(!empty($currentData))
				{
					return $currentData;
				}
				else
				{	
					return x($polaczenie,$proba);
				}
				
			}
			try
			{
				if(!(@$currentData = x($polaczenie,$proba)))
				{
					throw new Exception('err');
				}
			}
			catch(Exception $e)
			{
				$currentData = 1;
			}
		}
		else
		{
			$currentData = false;
		}
		$polaczenie->close();
		echo json_encode($currentData);
	}
}
?>