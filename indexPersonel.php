<!DOCTYPE html>
<html>
	<?php 
		session_start(); 
		$_SESSION['licznikP'] = 0;
	?>

			<head>
				<title></title>
				<link rel="stylesheet" href="style.css">
				<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
				<meta http-equiv="content-type" content="text/html; charset=utf-8">
			</head>
		<body>
			<div id="zawartosc">
				<h1>STANOWISKO</h1>
				<?php 
					if(@$_SESSION['logged'] == true)
					{
				?>
						
						<div id="A">
							<h3>Aktualnie obsługiwany numer to:</h3>
							<div id="number"></div>
							<div id="priority"></div>
							<div id='buttons'>
								<div id="zakoncz"><br><br><a>ZAKOŃCZ</a></div>
								<div id="wyloguj"><br><br><a href="logout.php">WYLOGUJ</a></div>
							</div>
						</div>
				<?php 
					}else
					{
				?>
						<div id="A">
							<h3>Musisz się zalogować!</h3>
							<div id='buttons'>
								<a id='zaloguj' href="stanowisko.php">ZALOGUJ</a>
							</div>
						</div>
						
				<?php
					}
				?>
			</div>
			

			
			<script type="text/javascript">
					
					
					$(document).ready(function() {
						check();
						/*document.getElementById("test").innerHTML = 0;
						var myVar = setInterval(myTimer, 1000);
						var sek = 1;
						function myTimer() {
							
							document.getElementById("test").innerHTML = sek;
							sek++;
						}*/
						
	
					});
					
					$(window).unload(function(){
						var $number = $("#number").html();
						$.ajax({
							type: "POST",
							url: "handleUpdate.php",
							async: false,
							dataType: "json",
							data: { number: $number, obsluzony: "nie"}
							});
					});
					
					var check = function checkDB(){
								$("#number").css('background-image', 'none');
								$.ajax({
									type: "POST",
									url: "newHandle.php",
									dataType: "json",
									success: function(output){
											
											if(typeof(output) == "number")
											{
												$("#priority").html("");
												$("#number").html('');
												$('#zakoncz').attr("style", 'display:none');
												$("#number").css('background-image', 'url("loading_anim.png")');
												setTimeout(check, 2000);
											}
											else if(typeof(output) == "object")
											{
												$("#number").html(output['numer']);
												$("#priority").html("Priorytet: " + output['idTyp']);
												$('#zakoncz').attr("style", 'display:inline-block');
											}
											else if(typeof(output) == "boolean")
											{
												$("#priority").html("");
												$("#number").html('Pusta kolejka');
												$('#zakoncz').attr("style", 'display:none');
												setTimeout(check, 2000);
											}
										},
									error: function(xmlhttprequest, textstatus, message){
										
									
											
											
											
									}
									
								})
							};
							
							$("#zakoncz").click(function(){
						
								var $number = $("#number").html();
								$.ajax({
									type: "POST",
									url: "handleUpdate.php",
									data: "number=" + $number,
									success: function(output){
										
										check();
									},
									error: function(xmlhttprequest, textstatus, message){
										
											
											

										}
									});
							});	
							$("#wyloguj").click(function(){
						
								window.location='logout.php';
							});	
					
				</script>	
		</body>
</html>