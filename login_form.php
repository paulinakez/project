!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- LOGIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="stilius.css" rel="stylesheet">
	
  </head>
  <body>
 
	<div class="container-fluid fonas mb-3 pb-5 pt-5">   
		<div class="row pt-5 pb-5 mt-2 mb-2">
			<div class="col text-white fst-italic d-flex justify-content-center">
				<a href="https://if180029.mokslas.vdu.lt" class="text-decoration-none text-white"><h1>-- Dive In Exploring --</h1></a>
			</div>
		</div>
	</div>
	
														<!--login form-->
	<div class="container">
		<section class="container border border-3 rounded col-md-4 col-10 py-4 mt-3">
															 
			<h3 class="mb-2 text-center">LOGIN</h3>

			<div class="container">
				<form class="row" method="post" action="login.php">

				   <div class="mb-3">                             
					<label class="form-label">Username</label>
					<input type="text" class="form-control" name="Username">
				   </div>

				   <div class="mb-3">                             
					<label class="form-label">Password</label>
					<input type="password" class="form-control" name="Password">
				   </div>
															
				   <div class="col-12 d-flex justify-content-center p-0 mt-1">
					<button type="submit" class="btn btn-sm btn-outline-primary">LOGIN</button>
				   </div>

				</form>
			</div>

		</section>
	
		<div class="row py-3">                          <!-- Registruotis mygtukas -->
			<div class="col-12 d-flex justify-content-center">
				<a class="btn btn-sm btn-outline-primary" href="register.php">Register</a>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
 </html>