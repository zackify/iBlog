<?php
require('checkadmin.php');
require('../connect.php');
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>iBlog Admin</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
 		<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">iBlog Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="../">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>John Doe (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">iBlog</a> <div class="breadcrumb_divider"></div> <a class="current">Posts</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php require("sidebar.php"); ?>

	<section id="main" class="column">
		
		
		<article class="module width_full">
		<header><h3 class="tabs_involved">Content Manager</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Pages</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Title</th> 
    				<th>Category</th> 
    				<th>Status</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php
				$result = mysql_query("SELECT * FROM posts ORDER BY id DESC");
			    while($row = mysql_fetch_array($result)){
			    $cat = $row['cat'];
			    $ca = mysql_query("SELECT * FROM cat WHERE id='$cat'");
			    $cat = mysql_fetch_array($ca);
			    
			    ?>
			    <tr> 
    				<td><?php echo $row['title'];?></td> 
    				<td><?php echo $cat['title'];?></td> 
    				<td><?php echo $row['status'];?></td> 
    				<td><a href="edit.php?id=<?php echo $row['id'];?>"><img src="images/icn_edit.png" title="Edit" /></a> 
    				<a href="delete.php?id=<?php echo $row['id'];?>"><img src="images/icn_trash.png" title="Trash"></a></td> 
				</tr> 			    
				<?php
			    }
			    ?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Title</th> 
    				<th>Last Edited</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			<?php
			$result = mysql_query("SELECT * FROM pages ORDER BY id DESC");
			    while($row = mysql_fetch_array($result)){
							?>
							<tr> 
    				<td><?php echo $row['title'];?></td> 
    				<td>5th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<?php
				}
				?>
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article>

</body>

</html>