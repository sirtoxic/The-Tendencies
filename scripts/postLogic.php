<?php

require 'db.php';

function displayPosts(){
	require 'db.php';
	$records = $conn->prepare('SELECT ALL * FROM `posts` WHERE `p_visable` = 1 ORDER BY `p_date`DESC');
    $records->execute();

	while($result = $records->fetch(PDO::FETCH_ASSOC)) {
		$postID = $result['p_ID'];	
		$postCreator = $result['p_creator'];
		$postDate = $result['p_date'];	
		$postTitle = $result['p_title'];
		$postContent = $result['p_content'];

	    echo 	"<div class=\"row featurette\">
    				<div class=\"col-md-7\">
      					<h2 class=\"featurette-heading\">".$postTitle."</h2>
      					<p class=\"lead\">".$postContent."</p>
	    			</div>
    				<div class=\"col-md-5\">
      					<img class=\"featurette-image img-responsive center-block\" data-src=\"holder.js/500x500/auto\" alt=\"Generic placeholder image\">
	    			</div>
  				</div>
  				<hr class=\"featurette-divider\">";
	}
}



function displayPostEdit(){
	require 'db.php';
	$records = $conn->prepare('SELECT ALL * FROM `posts` WHERE 1 ORDER BY `p_date`DESC');
    $records->execute();

    echo 	"<table class=\"table table-striped\">
            	<thead>
              		<tr>
                		<th>ID</th>
                		<th>Title</th>
                		<th>Content</th>
                		<th>Creator</th>
                		<th>Date</th>
                		<th>Visable</th>
              		</tr>
            	</thead>
            <tbody>";
  				

	while($result = $records->fetch(PDO::FETCH_ASSOC)) {
		$postID = $result['p_ID'];	
		$postCreator = $result['p_creator'];
		$postDate = $result['p_date'];	
		$postTitle = $result['p_title'];
		$postContent = $result['p_content'];
		$postVisable = $result['p_visable'];

	    echo 	"<tr>
                	<td>".$result['p_ID']."</td>
                	<td>".$result['p_title']."</td>
                	<td>".$result['p_content']."</td>
                	<td>".$result['p_creator']."</td>
                	<td>".$result['p_date']."</td>
                	<td>".$result['p_visable']."</td>
              	</tr>";
    }
    echo "</tbody>
          </table>";
}

?>