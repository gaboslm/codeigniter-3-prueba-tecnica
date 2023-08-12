<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,400&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
	<body style="width: 100vw; height: 100vh">
		<div class="d-flex justify-content-center align-items-center h-100">
			<div>
				<img 
				src="https://lanatime-shop.com/cdn/shop/products/20210512_113844_001_f40d2f7d-729e-44f4-87bb-b0330d747b1f_1200x1200.jpg?v=1621223535" 
				class="center rounded shadow"
				style="max-width: 300px"
				alt="ok"
				>
				<p class="text-gray text-center text-xl mt-3 text-bg-dark rounded py-2" style="font-size: 18px; font-weight: 600">
					<?php 
						if(isset($message)){
							echo $message;
						}
					?>
				</p>
				<p id="loading"> </p>
			</div>
		</div>
	</body>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			let counter = 3
			const loading = document.getElementById('loading');
			setInterval(() => {
				loading.innerHTML = 'You will be redirected in... '+counter+'s'
				counter--
			}, 1000)
			setTimeout(() => {
				window.location.href = "http://localhost/lunagabriel20230812/users";
			}, 3000);
		})
	</script>
</html>