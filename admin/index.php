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
			<p><?php echo $_SESSION['user'];?> (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">iBlog</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
		<?php require("sidebar.php"); ?>

	
	<section id="main" class="column">
		<?php
		$version = file_get_contents("http://zachs.co/iblogversion.txt");
		$result = mysql_query("SELECT version FROM siteinfo") or die(mysql_error());
		$row = mysql_fetch_array($result);
		if($row['version'] < $version){
		?>
		<h4 class="alert_warning">iBlog is not up to date. The newest version is <?php echo $version;?> and you have <?php echo $row['version'];?> Please check <a target="_blank" href="http://zachs.co/iblog">http://zachs.co</a></a> to download the latest version!</h4>
		<?php
		}		?>
		
		
		<article class="module width_quarter">
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
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php
				$result = mysql_query("SELECT * FROM posts ORDER BY id DESC LIMIT 4");
			    while($row = mysql_fetch_array($result)){
			    ?>
			    <tr> 
    				<td><?php echo $row['title'];?></td> 
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
		
		</article><!-- end of content manager article -->
		<article class="module width_quarter">
			<header><h3>iBlog News</h3></header>
			<div class="message_list">
				<div class="module_content">
					<?php
				
$feedUrl = "http://zachs.co/category/iblog/feed/" ; 
$rawFeed = file_get_contents($feedUrl); 
$xml = new SimpleXmlElement($rawFeed);	
foreach ($xml->channel->item as $item) 
{     
    $article = array();
    $article["title"] = $item->title;
    $article["link"] = $item->link; 
    $article["description"] = $item->description; 
?>
<div class="message"><strong><a target="_blank" href="<?php echo $article['link'];?>"><?php echo $article['title'];?></a></strong>
<p><?php echo $article['description'];?></p>
</div>
<?php			
}
?>
								</div>
			
		</article><!-- end of messages article -->
		
				<article class="module width_quarter">
			<header><h3>Contact Messages</h3></header>
			<div class="message_list">
				<div class="module_content">
					<?php
					$result = mysql_query("SELECT * FROM contact ORDER BY id DESC");
					if(mysql_num_rows($result) == 0){
					echo "Nobody has used the contact form yet";
					}
					while($row = mysql_fetch_array($result)){
					?>
					<div class="message"><p><?php echo $row['message'];?></p>
					<p><strong><?php echo $row['from'];?> (<a href="mailto:<?php echo $row['email'];?>">Email</a>)</strong></p></div>
							<?php			
										}
					?>
								</div>
			
		</article><!-- end of messages article -->
		
		<div class="clear"></div>
	
		
		<h4 class="alert_warning">A Warning Alert</h4>
		
		<h4 class="alert_error">An Error Message</h4>
		
		<h4 class="alert_success">A Success Message</h4>
		
		<article class="module width_full">
			<header><h3>Basic Styles</h3></header>
				<div class="module_content">
					<h1>Header 1</h1>
					<h2>Header 2</h2>
					<h3>Header 3</h3>
					<h4>Header 4</h4>
					<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>

<p>Donec id elit non mi porta <a href="#">link text</a> gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>

					<ul>
						<li>Donec ullamcorper nulla non metus auctor fringilla. </li>
						<li>Cras mattis consectetur purus sit amet fermentum.</li>
						<li>Donec ullamcorper nulla non metus auctor fringilla. </li>
						<li>Cras mattis consectetur purus sit amet fermentum.</li>
					</ul>
				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>


</body>

</html>