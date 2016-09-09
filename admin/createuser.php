<?php

session_start();

require '../scripts/db.php';

//if( !isset($_SESSION['user_id']) ){
   // header("Location: ../admin/admin.php");
//}

$message = '';

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
    $sql = "INSERT INTO administrators (f_name, l_name, u_name, password, email, phone) VALUES (:firstname, :lastname, :username, :password, :email, :phone)";
    $statment = $conn->prepare($sql);

    $statment->bindParam(':firstname',$_POST['firstname']); 
    $statment->bindParam(':lastname',$_POST['lastname']); 
    $statment->bindParam(':username',$_POST['username']); 
    $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $statment->bindParam(':password', $password_hash);
    $statment->bindParam(':email',$_POST['email']); 
    $statment->bindParam(':phone',$_POST['phone']); 

    if ($statment->execute()) {
        $message = "<div class=\"alert alert-success\" role=\"alert\">
                        <strong>Well done!</strong> Successfully Created User
                    </div>";
    } else {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">
                        <strong>Error!</strong> Somthing whent wrong :S
                    </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Tendencies Administration Pannel</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">The Tendencies Administration Pannel</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../admin/admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="../admin/createuser.php"><i class="fa fa-user-plus"></i> Create User</a>
                    </li>
                    <li>
                        <a href="../admin/deleteuser.php"><i class="fa fa-user-times"></i> Delete User</a>
                    </li>
                    <li>
                        <a href="../admin/createpost.php"><i class="fa fa-plus-square-o"></i> Create Post</a>
                    </li>
                    <li>
                        <a href="../admin/editpostlist.php"><i class="fa fa-pencil-square-o"></i> Edit Post</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create User <small>Create a new Administrator/Team member logon</small>
                        </h1>
                        <?php echo $message; ?>
                    </div>
                </div>
                <!-- /.row -->

                <form action="createuser.php" method="POST">
                    <div class="input-group">
                        <h4>First Name</h4>
                        <input type="text" class="form-control" placeholder="First Name" aria-describedby="sizing-addon2" name="firstname">
                    </div>
                    <div class="input-group">
                        <h4>Last Name</h4>
                        <input type="text" class="form-control" placeholder="Last Name" aria-describedby="sizing-addon2" name="lastname">
                    </div>
                        <div class="input-group">
                        <h4>Username</h4>
                        <input type="text" class="form-control" placeholder="Userame" aria-describedby="sizing-addon2" name="username">
                    </div>
                    <div>
                        <div class="input-group">
                        <h4>Password</h4>
                        <input type="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2" name="password">
                    </div>
                    <div>
                        <div class="input-group">
                        <h4>Email</h4>
                        <input type="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon2" name="email">
                    </div>
                    <div>
                        <div class="input-group">
                        <h4>Phone</h4>
                        <input type="text" class="form-control" placeholder="Phone" aria-describedby="sizing-addon2" name="phone">
                    </div>
                    <br>
                    <input class="btn btn-primary btn-lg" type="submit">
                </form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
