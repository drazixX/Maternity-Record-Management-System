<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Maternity-Record-Management-System</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-info">
            <div class="card-header text-center">
               <a href="#" class="brand-link">
               <img src="asset/img/clinic-logo.png" alt="DSMS Logo" width="300">
               </a>
            </div>
            <div class="card-body" >
            <form action="login.php" method="post">
   <div class="input-group mb-3">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-user"></span>
         </div>
      </div>
   </div>
   <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-lock"></span>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-6 offset-3">
         <button type="submit" class="btn btn-block btn-bg" style="background-color: rgba(131,219,214);">Login</button>
      </div>
   </div>
</form>


            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
   </body>
</html>