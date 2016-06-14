<!DOCTYPE html>
<html>
	<?php 
		session_start(); 
	?>

			<head>
				<title></title>
				<link rel="stylesheet" href="style.css">
				<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
				
				
				
				<meta http-equiv="content-type" content="text/html; charset=utf-8">
			</head>
		<body>
			<div>
				<h1>PUNKT OSBŁUGI KLIENTA</h1>
			</div>
			<div id="panel">
					<div class="option" id="newNumber">
						Pobierz numerek
						<div class="button" id="priorytet_1">
						</div>
					</div>
					<div class="option" id="newNumberHigherPriority">
						Pobierz numerek z wyższym priorytetem
						<div class="button" id="priorytet_2">
						</div>
					</div>
			</div>
			
			<script type="text/javascript">
					
					
					$(document).ready(function () {
						$("#priorytet_1").click(function(){
							$.ajax({
								type: "POST",
								url: "newNumber.php",
								data: "priorytet=1",
								success: function(msg){
									$("#rightPanel").html(msg);
									}
							});
						});
						$("#priorytet_2").click(function(){
							$.ajax({
								type: "POST",
								url: "newNumber.php",
								data: "priorytet=2",
								success: function(msg){
									$("#rightPanel").html(msg);
									}
							});
						});
					});
					
				
				
				
				</script>
			
			
		</body>
</html>
