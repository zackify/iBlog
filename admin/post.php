<?php
require('checkadmin.php');
require('../connect.php');


if(isset($_POST['submit'])){

if(isset($_POST['title']) && isset($_POST['body']) && isset($_POST['category'])){

$title = mysql_real_escape_string($_POST['title']);

function permalink($v) { 
$v = preg_replace('/[^a-zA-Z0-9\s]/', '', $v);
$v = str_replace(' ','-',$v);
$v = strtolower($v);
return $v;
}
$url = date("Y/m/d/") . permalink($title)."/";
$body = mysql_real_escape_string($_POST['body']);
$category = mysql_real_escape_string($_POST['category']);
$cat = mysql_query("SELECT * FROM cat WHERE title='$category'") or die(mysql_error());
$row = mysql_fetch_array($cat);
$cat = $row['id'];
$date = time();
$status = $_POST['status'];
$result = mysql_query("SELECT * FROM posts WHERE body='$body'");
if(mysql_num_rows($result) ==0){
$u_id = $_SESSION['id'];
mysql_query("INSERT INTO posts (title,body,date,user,cat,permalink,status) VALUES ('$title','$body','$date','$u_id','$cat','$url','$status')");
$result = mysql_query("SELECT id FROM posts WHERE permalink='$url'") or die(mysql_error());
$row = mysql_fetch_array($result);
?>
<script type="text/javascript">
<!--
window.location = "edit.php?id=<?php echo $row['id'];?>&msg=posted"
//-->
</script>
<?php
}
else{
$error = "Already posted this.";
}
}
else{
$error = "Please fill in all fields.";
}
}
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
			<article class="breadcrumbs"><a href="index.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">New Post</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
		<?php require("sidebar.php"); ?>

	
	<section id="main" class="column">
		<div class="clear"></div>
		<?php
		if(isset($error)){
		?>
		<h4 class="alert_warning"><?php echo $error;?></h4>
		<?php
		}
		?>
		<article class="module width_full">
			<header><h3>Post New Article</h3></header>
				<div class="module_content">
						<form action="post.php" method="post">
						<fieldset>
							<label>Post Title</label>
							<input name="title" type="text">
						</fieldset>
						<fieldset>
							<label>Content</label><a target="_blank" href="http://daringfireball.net/projects/markdown/basics">Markdown</a> is supported!							<textarea name="body" rows="12"></textarea>
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Category</label>
							<select name="category" style="width:92%;">
								<?php
 $result = mysql_query("SELECT * FROM cat");
 $num =0;
while($row = mysql_fetch_array($result)){
$num++;
?>
                <option value="<?php echo $row['title'];?>">
                       <?php echo $row['title'];?>
                    </option>
                    <?php
                    }
                    ?>
							</select>
						</fieldset>
						<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<select name="status">
					<option>Published</option>
					<option>Draft</option>
						
					</select>
					<input name="submit" type="submit" value="Save" class="alt_btn">
					<input type="submit" value="Reset">
					</form>
				</div>
			</footer>
		</article><!-- end of post new article -->
		
	
		<div class="spacer"></div>
	</section>


</body>

</html>