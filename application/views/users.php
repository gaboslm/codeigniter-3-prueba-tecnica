<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sign up</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,400&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
	</head>
	<style>
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		body{
			font-family: 'Roboto', sans-serif;
		}
	</style>
	<body>
		<div class="border rounded mx-auto mt-3 pt-2" style="max-width: 900px">
			<div class="d-flex align-items-center justify-content-between px-3">
				<h1 style="font-size: 1.8rem">List of users</h1>
				<div>
					<a class="btn btn-dark btn-sm" href="http://localhost/lunagabriel20230812/register">New user</a>
				</div>
			</div>
			<?php 
			if(isset($users) && count($users) == 0)
			{
				echo '<p class="text-center">No one user created yet!</p>';
			}
			?>
			<table class="table <?php echo isset($users) && count($users) == 0 ? 'd-none' : '' ?>" style="">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">First name</th>
						<th scope="col">Last name</th>
						<th scope="col">Email address</th>
						<th scope="col">Gender</th>
						<th scope="col">Telephone</th>
						<th scope="col">AGE</th>
					</tr>
				</thead>
				<tbody>
				
					<?php 
					foreach($users as $key => $user){
						echo "<tr>";
							echo "<th scope='row'>".$key."</th>";
							echo "<td>".$user->FIRST_NAME."</td>";
							echo "<td>".$user->LAST_NAME."</td>";
							echo "<td>".$user->EMAIL."</td>";
							if ($user->GENDER == 1)
							{
								echo "<td>Female</td>";
							}
							else if($user->GENDER == 2){
								echo "<td>Male</td>";
							}
							else 
							{
								echo "<td>Other</td>";
							}
							echo "<td>".$user->TELEPHONE."</td>";
							echo "<td>".$user->AGE."</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<script>
			$(document).ready(function(){  
				console.log("<?php echo base_url(); ?>register");
				$('#sign_up_form').on('submit', function(e){  
					e.preventDefault();  
					$.ajax({  
						url:"<?php echo base_url(); ?>register",   
						//base_url() = http://localhost/lunagabriel20230812  
						method: "POST",  
						data: new FormData(this),  
						contentType: false,  
						cache: false,  
						processData: false,  
						success: function(data) {  
							// console.log(data);
						}  
					});  
				});  
			});  
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	</body>
</html>