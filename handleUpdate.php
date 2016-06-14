<?php
session_start();
if(isset($_REQUEST))
{			
	
			$userId = $_SESSION['Identyfikator'];
			$date = date("Y-m-d G:i:s");
			$number = $_POST["number"];
			require_once "connect.php";
			$polaczenie = @new mysqli($servername,$user,$password,$database);

			if($polaczenie -> connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno." Opis :".$polaczenie->connect_error;
			}
			else
			{
				if($_POST["obsluzony"] == 'nie')
				{
					$sql = "UPDATE `kolejka` SET `obslugiwany`=0 WHERE `kolejka`.`numer` = '$number';";
				}
				else
				{
					$sql = "UPDATE `kolejka` SET `dataZak`='$date', `obslugiwany`=0, `idPrac`='$userId' WHERE `kolejka`.`numer` = '$number';";
				}
				if($rezultat = @$polaczenie->query($sql))
				{
					mysql_query($sql);
				}
				$polaczenie->close();
			}
}
?>