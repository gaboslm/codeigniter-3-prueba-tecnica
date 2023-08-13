<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sign up</title>
		<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,400&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
		<style>
			*{
				padding: 0;
				margin: 0;
				box-sizing: border-box;
			}
			body{
				font-family: 'Roboto', sans-serif;
			}
			.custom-label{
				font-size: 12px;
                font-weight: 600;
			}
			.btn-radio{
				border: 1px solid #ddd;
				transition: border .3s ease-in-out;
			}
			.btn-radio:hover{
				border: 1px solid black !important;
			}
			.cr-default{
				cursor: default !important;
			}
		</style>
	</head>
	<body>
		<div class="border rounded mx-auto mt-3" style="max-width: 600px">
			<div class="d-flex align-items-center gap-3 border-bottom mx-3 py-3">
				<div>
					<a class="btn btn-dark btn-sm rounded-circle cr-default" href="http://localhost/lunagabriel20230812/users">
						<span class="mdi mdi-arrow-left"></span>
					</a>
				</div>
				<h1 class="m-0" style="font-size: 1.8rem;">
					Create new user
				</h1>
			</div>
			<form method="post" id="create_form" enctype="multipart/form-data" class="p-3">
				<!-- 2 column grid layout with text inputs for the first and last names -->
				<div class="row mb-4">
					<div class="col">
						<div class="form-outline">
							<label class="form-label ps-3 mb-0 custom-label" for="first_name">First name</label>
							<input value="<?php echo isset($user) ? $user->FIRST_NAME : '' ?>" type="text" placeholder="John" id="first_name" name="first_name" class="form-control" required />
						</div>
					</div>
					<div class="col">
						<div class="form-outline">
							<label class="form-label ps-3 mb-0 custom-label" for="last_name">Last name</label>
							<input value="<?php echo isset($user) ? $user->LAST_NAME : '' ?>" type="text" placeholder="Doe" id="last_name" name="last_name" class="form-control" required />
						</div>
					</div>
				</div>
				
				<!-- Checkbox -->
				<div class="row mb-4">
					<div class="col-4">
						<input type="radio" class="btn-check" value="1" name="gender" id="female" autocomplete="off" <?php echo isset($user) && $user->GENDER == 1 ? 'checked' : '' ?> >
						<label class="btn btn-sm btn-radio w-100" for="female">
							Female
						</label>
					</div>
					<div class="col-4">
						<input type="radio" class="btn-check" value="2" name="gender" id="male" autocomplete="off" <?php echo isset($user) && $user->GENDER == 2 ? 'checked' : '' ?> >
						<label class="btn btn-sm btn-radio w-100" for="male" name="gender">
							Male
						</label>
					</div>
					<div class="col-4">
						<input type="radio" class="btn-check" value="0" name="gender" id="other" autocomplete="off" <?php echo isset($user) && $user->GENDER == 0 ? 'checked' : '' ?> >
						<label class="btn btn-sm btn-radio w-100" for="other" name="gender">
							Other
						</label>
					</div>
				</div>

				<!-- Email input -->
				<div class="form-outline mb-4">
					<label class="form-label ps-3 mb-0 custom-label" for="email">Email address</label>
					<input value="<?php echo isset($user) ? $user->EMAIL : '' ?>" type="email" placeholder="example@mail.com" id="email" name="email" class="form-control" required />
				</div>

				<div class="row mb-4">
					<div class="col">
						<!-- Phone input -->
						<div class="form-outline">
							<label class="form-label ps-3 mb-0 custom-label" for="telephone">Phone</label>
							<input value="<?php echo isset($user) ? $user->TELEPHONE : '' ?>" type="number" placeholder="#" id="telephone" name="telephone" class="form-control" />
						</div>
					</div>
					<div class="col">
						<!-- Birth input -->
						<div class="form-outline">
							<label class="form-label ps-3 mb-0 custom-label" for="birth">Birth</label>
							<input value="<?php echo isset($user) ? $user->AGE : '' ?>" type="date" id="birth" name="birth" class="form-control" required />
						</div>
					</div>
				</div>
				<!-- Errors -->
				<?php
				if(isset($errors)){
					foreach ($errors as $error){
						echo "<p class='text-danger' style='font-size: 12px'>$error</p>";
					}
				}
				?>
				<!-- Submit button -->
				<button type="submit" class="btn btn-dark btn-block text-uppercase w-100 cr-default">Create</button>
			</form>
		</div>
		<script>
			$(document).ready(function(){  
				$('#create_form').on('submit', function(e){  
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