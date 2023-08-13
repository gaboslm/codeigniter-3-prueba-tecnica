<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>List users</title>
		<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,400&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
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
		.icon{
			transition: color .2s ease-in-out;
		}
		.icon-edit:hover{
			color: gray !important
		}
		.icon-delete:hover{
			color: rgba(var(--bs-danger-rgb)) !important
		}
		.cr-default{
			cursor: default;
		}
	</style>
	<body>
		<div class="border rounded mx-auto mt-3 pt-2" style="max-width: 1200px; min-width: 930px">
			<div class="d-flex align-items-center justify-content-between px-3">
				<h1 style="font-size: 1.8rem">List of users</h1>
				<div>
					<a class="btn btn-dark btn-sm px-3 cr-default" href="http://localhost/lunagabriel20230812/register">New user</a>
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
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($users as $key => $user){
							echo "<tr id='user-$user->ID'>";
							echo "<th scope='row'>".($key+1)."</th>";
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
							echo "<td>".$user->AGE." (".(date('Y') - date('Y', strtotime($user->AGE)))." years old)</td>";
							echo "<td><div class='cr-pointer'><span onclick='editUser($user->ID)' class='icon icon-edit mdi mdi-pen text-dark' style='font-size: 20px'></span></div></td>";
							echo "<td><span onclick='removeUser($user->ID)' class='icon icon-delete mdi mdi-delete-empty text-dark cr-pointer' style='font-size: 20px'></span></td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>

			<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
					<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="rgba(var(--bs-danger-rgb)"></rect></svg>
					<strong class="me-auto">Deleted</strong>
					<small>Just now</small>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body"></div>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', () => {
				console.log(typeof localStorage.getItem('removed'));
				if(localStorage.getItem('removed') != ''){
					showToast(localStorage.getItem('removed'))
					localStorage.setItem('removed', '')
				}
			})
			function showToast(message){
				const deleteToast = document.getElementById('deleteToast')
				const toast = new bootstrap.Toast(deleteToast)
				const body = deleteToast.querySelector('.toast-body')
				body.innerHTML = message
				toast.show()
			}
			function removeUser(id){
				if(confirm("Are you sure you want to delete this user?")) {
					$.ajax({
						url: `http://localhost/lunagabriel20230812/user_delete?id=${id}`,
						//base_url() = http://localhost/lunagabriel20230812
						method: "DELETE",
						contentType: false,
						cache: false,
						processData: false,
						success: (data) => {
							localStorage.setItem('removed', data.message)
							location.reload();
						}
					});
				}
			}

			function editUser(id){
				window.location.href = `http://localhost/lunagabriel20230812/user_edit?id=${id}`
			}

			function calculateAge(date) {
				const birthdate = new Date(date);
				var monthDiff = Date.now() - birthdate.getTime();
				var age_d = new Date(monthDiff);
				var year = age_d.getUTCFullYear();
				var age = Math.abs(year - 1970);
				return `(${age})`;
			}
		</script>
	</body>
</html>