<?php include('header.php');?>


	<div class="jumbotron" style="background-color:#ccc;">  
<h3 class="text-center">Admin Login</h3>
	</div>

<div class="container">
<div class="row">
	<div class="col-md-4"></div>

      <div class="col-md-4">
  <form class="form-signin" method="post" action="verify_login.php">
      <h1 class="h3 mb-3 font-weight-normal text-center">Sign in</h1>

      <?php if(isset($_SESSION['error'])){ ?>

      	<div class="alert alert-danger"><?= $_SESSION['error'];?></div>
	
	<?php }?>

      <div class="form-group">
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
      </div>
      <div class="form-group">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      </div>

       
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>
    </div>
<div class="col-md-4"></div>
</div>
</div>
<?php include('footer.php');?>