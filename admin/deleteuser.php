<?php

session_start();

require 'db.php';

//if( !isset($_SESSION['user_id']) ){
   // header("Location: ../admin/admin.php");
//}

$message = '';

if (!empty($_POST['username'])&& !empty($_POST['confirmUser'])) {
    $records = $conn->prepare('SELECT ID, u_name FROM administrators WHERE u_name = :username');
    $records->bindParam(':username',$_POST['username']);  
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $idDelete = $results['ID'];
    $userDelete = $results['u_name'];

    $removeRecord = $conn->prepare('DELETE FROM administrators WHERE ID = :userID');
    $removeRecord->bindParam(':userID',$idDelete);  
    $removeRecord->execute();

    $message = "<div class=\"alert alert-success\" role=\"alert\">
    \"Successfully Deleted User with ID <b>".$idDelete."</b> and Username <b>".$userDelete."</b>
    </div>";
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

    <title>SB Admin - Bootstrap Admin Template</title>
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
                <a class="navbar-brand" href="index.html">The Tendencies Administration Pannel</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="../admin/createuser.php"><i class="fa fa-user-plus"></i> Create User</a>
                    </li>
                    <li class="active">
                        <a href="../admin/deleteuser.php"><i class="fa fa-user-times"></i> Delete User</a>
                    </li>
                    <li>
                        <a href="../admin/createpost.php"><i class="fa fa-plus-square-o"></i> Create Post</a>
                    </li>
                    <li>
                        <a href="../admin/editpost.php"><i class="fa fa-pencil-square-o"></i> Edit Post</a>
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
                            Delete User <small>Remove Administrator/Team member from database</small>
                        </h1>
                        <?php echo $message; ?>
                    </div>
                </div>
                <!-- /.row -->

                <form action="deleteuser.php" method="POST">
                    <div class="input-group">
                        <h4>Username</h4>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2" name="username">
                    </div>
                        <div class="input-group">
                        <h4>Confirm Username</h4>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2" name="confirmUser">
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
