<?php

session_start();

require 'db.php';
z

if( isset($_SESSION['user_id']) ){
	header("Location: /PhoToe-Gallery/");
}

$message = '';

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
	$sql = "INSERT INTO customers (user_f_name, user_l_name, username, user_pass, user_email, user_phone, user_address) VALUES (:firstname, :lastname, :username, :password, :email, :phone, :address)";
	$statment = $conn->prepare($sql);

	$statment->bindParam(':firstname',$_POST['firstname']); 
	$statment->bindParam(':lastname',$_POST['lastname']); 
	$statment->bindParam(':username',$_POST['username']); 
	$password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$statment->bindParam(':password', $password_hash);
	$statment->bindParam(':email',$_POST['email']); 
	$statment->bindParam(':phone',$_POST['phone']); 
	$statment->bindParam(':address',$_POST['address']); 

	if ($statment->execute()) {
		$message = 'Successfully created new user';
		createDirectory($_POST['username']);
	} else {
		$message = 'Sorry there must have been an issue creating the account';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/form-elements.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Register Below</title>
</head>
<body>
	<div class="row">
        <div class="col-sm-8 col-sm-offset-2 text">
            <h1><strong class="wcFont"><br>White Chocolate</strong><br>Folio Creation Form</h1>
            <div class="description">
                <p>
                    White Chocolate Photography - Weddings, Events & Special Moments
                </p>
            </div>
        </div>
    </div>
	<?php if (!empty($message)) { ?>
		<p><?= $message ?> </p>
	<?php }?>

	<form action="usercreation.php" method="POST">
		<input type="text" placeholder="First Name" name="firstname">
		<input type="text" placeholder="Last Name" name="lastname">
		<input type="text" placeholder="Username" name="username">
		<input type="password" placeholder="Enter A Password" name="password">
		<input type="text" placeholder="Enter your Email" name="email">
		<input type="text" placeholder="Phone" name="phone">
		<input type="text" placeholder="Address" name="address">
		<input type="submit">
	</form>
</body>
</html>