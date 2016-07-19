<?php

session_start();

require '../scripts/db.php';

//if( !isset($_SESSION['user_id']) ){
   // header("Location: ../admin/admin.php");
//}

$message = '';

if (!empty($_POST['content'])&& !empty($_POST['title'])) {
    $sql = "INSERT INTO posts (p_creator, p_title, p_content, p_visable) VALUES (:creator, :title, :content, :visable)";


    $statment = $conn->prepare($sql);

    $statment->bindParam(':creator',$_SESSION['user_id']); 
    $statment->bindParam(':title',$_POST['title']); 
    $statment->bindParam(':content',$_POST['content']); 
    $statment->bindParam(':visable',$_POST['visable']); 

    if ($statment->execute()) {
        $message = "<div class=\"alert alert-success\" role=\"alert\">
                        <strong>Well done!</strong> Successfully Created Post
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
                        <a href="../admin/admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="../admin/createuser.php"><i class="fa fa-user-plus"></i> Create User</a>
                    </li>
                    <li>
                        <a href="../admin/deleteuser.php"><i class="fa fa-user-times"></i> Delete User</a>
                    </li>
                    <li class="active">
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
                            Create Post<small> Create a new post to the front page</small>
                        </h1>
                        <?php echo $message; ?>
                    </div>
                </div>
                <!-- /.row -->

                <form action="createpost.php" method="POST">
                    <div class="input-group">
                        <h4>Post Title</h4>
                        <input type="text" class="form-control" placeholder="Post Title" aria-describedby="sizing-addon2" name="title">
                    </div>
                    <div class="input-group col-xs-6">
                        <h4>Post Content</h4>
                        
                        <h4><a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-bold"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<i></i>');return false;"><i class="fa fa-italic"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<u></u>');return false;"><i class="fa fa-underline"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<s></s>');return false;"><i class="fa fa-strikethrough"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<img class=&quot;&quot; src=&quot;&quot; hight=&quot;&quot; width=&quot;&quot;>');return false;"><i class="fa fa-picture-o"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<a href=&quot;&quot;></a>');return false;"><i class="fa fa-link"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;&quot; frameborder=&quot;0&quot; allowfullscreen></iframe>');return false;"><i class="fa fa-television"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-list"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<p></p>');return false;"><i class="fa fa-paragraph"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<h4></h4>');return false;"><i class="fa fa-header"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-list-ol"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<br>');return false;"><i class="fa fa-level-down"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-envelope-o"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-paint-brush"></a></i>
                        <a href="#" onclick="insertAtCaret('comment','<b></b>');return false;"><i class="fa fa-file"></a></i></h4>

                        <textarea class="form-control" rows="5" id="comment" name="content" placeholder="Type Post Content here"></textarea>
                    </div>
                    <input type="hidden" name="visable" value="0"> 
                    <input type="checkbox" name="visable" checked value="1"> Post Visable 
                    <br><br>
                    <input class="btn btn-primary btn-lg" type="submit"  >
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
    <script src="../scripts/textToFeild.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
