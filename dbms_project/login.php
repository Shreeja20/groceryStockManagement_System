
<html>
<head>
<title>login and register</title>
<link rel="stylesheet" type="text/css"href="style.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="login-box">
<div class="row">
<div class="col-md-6 login-left">
<h2>login here</h2>
<form action="check.php" method="post">
<div class="form-group">
<label>username</label>
<input type="text"name="user"class="form-control"required>
</div>
<div class="form-group">
<label>password</label>
<input type="password"name="password"class="form-control"required>
</div>
<button type="submit"name="login" class="btn btn-primary">login</button>
<center><a href="hhome.php">go back</a></center>
</form>
</div>

<div class="col-md-6 login-right">
<h2>register here</h2>
<form action="registration.php" method="post">
<div class="form-group">
<label>username</label>
<input type="text"name="user"class="form-control"required>
</div>
<div class="form-group">
<label>password</label>
<input type="password"name="password"class="form-control"required>
</div>
<div class="form-group">
<label>email-id</label>
<input type="email"name="email-id"class="form-control"required>
</div>
<div class="form-group">
<label>address</label>
<input type="text"name="address"class="form-control"required>
</div>
<div class="form-group">
<label>contact_no</label>
<input type="tel"name="contact_no"class="form-control"pattern="^\d{10}$"required>
</div>
<button type="submit" name="btn"class="btn btn-primary" >register</button>
</form>
</div>
</div>
</div>


</body>
</html>
