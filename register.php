<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-- Dive In Exploring -- Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="styles.css" rel="stylesheet">
	
  </head>
  <body>
  <main>

	<div class="container mt-3">
													
		<div class="row flex-nowrap align-items-center">
		  <div class="col-12 d-flex justify-content-end align-items-center">
			<a class="btn btn-outline-primary" href='login.php'>LOGIN</a>
		  </div>
		</div>
	  
	</div>
	
	<div class="container-fluid fonas mb-3 pb-5 pt-5 mt-3">   
		<div class="row pt-5 pb-5 mt-2 mb-2">
			<div class="col text-white fst-italic d-flex justify-content-center">
				<a href="" class="text-decoration-none text-white"><h1>-- Dive In Exploring --</h1></a>
			</div>
		</div>
	</div>
	  
	
	<div class="container mb-3">							
		<section class="container border border-3 rounded col-md-4 col-10 py-4 mt-3">
													  
		  <h3 class="mb-2 text-center">Registration</h3>

			<div class="container">
			  <form class="row m-0" method="post" action="register_process.php">

			   <div class="mb-3">                    
				<label class="form-label">Name</label>
				<input type="text" class="form-control" name="Name">
			   </div>

			   <div class="mb-3">                    
				<label class="form-label">Surname</label>
				<input type="text" class="form-control" name="LastName">
			   </div>
			   
			   <div class="mb-3">                   
				<label class="form-label">Date of Birth</label>
				<input type="date" class="form-control" name="BirthDate">
			   </div>
			   
			   <div class="mb-3">                   
				<label class="form-label">Email </label>
				<input type="email" class="form-control" name="Email">
			   </div>

			   <div class="mb-3">                       
				<label class="form-label">Username </label>
				<input type="text" class="form-control" name="Username">
			   </div>

			   <div class="mb-3">                     
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="Password">
			   </div>

													
			   <div class="col-12 d-flex justify-content-center p-0 mt-1">
				<button type="submit" class="btn btn-sm btn-outline-primary">Register</button>
			   </div>

			 </form>
			</div>

		</section>

	</div>
  
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</main>
  </body>
</html>