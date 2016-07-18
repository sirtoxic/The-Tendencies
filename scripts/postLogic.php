<?php

require 'db.php';

function displayPosts(){
	require 'db.php';
	$records = $conn->prepare('SELECT ALL * FROM `posts` WHERE `p_visable` = 1');
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

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


?>