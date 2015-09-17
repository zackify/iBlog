<?php
require('../connect.php');
$result = mysql_query("SELECT * FROM siteinfo");
$info = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="pics/homescreen.gif" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
<script src="javascript/functions.js" type="text/javascript"></script>
<title><?php echo $info['name'];?>
</title>
<link href="pics/startup.png" rel="apple-touch-startup-image" />
<meta content="iPod,iPhone,Webkit,iWebkit,Website,Create,mobile,Tutorial,free" name="keywords" />
<meta content="Try out all the new features of iWebKit 5 with a simple touch of a finger and a smooth screen rotation!" name="description" />
</head>

<body>

<div id="topbar">
	<div id="title">
		<?php echo $info['name'];?></div>
		<div id="rightbutton">
		<a href="admin">Admin</a>
				</div>
		</div>
<div id="tributton">
	<div class="links">
		<a id="pressed" href="#">Home</a><a href="pages.php">Pages</a><a href="about.html">About</a></div>
</div>
<div id="content">
	<ul class="pageitem">
		<li class="textbox"><span class="header"><?php echo $info['name'];?></span><?php echo $info['short'];?></p>
		</li>
		<?php
		
		       function time_since($dt,$precision=1)
{
    $times=array(   365*24*60*60    => "year",
                30*24*60*60     => "month",
                7*24*60*60      => "week",
                24*60*60        => "day",
                60*60           => "hour",
                60              => "minute",
                1               => "second");

    $passed=time()-$dt;



    if($passed<5)
    {
        $output='less than 5 seconds ago';
    }
    else
    {
        $output=array();
        $exit=0;
        foreach($times as $period=>$name)
        {
            if($exit>=$precision || ($exit>0 && $period<60))    break;
            $result = floor($passed/$period);
      //die($result);
            if($result>0)
            {
                $output[]=$result.' '.$name.($result==1?'':'s');
                $passed-=$result*$period;
                $exit++;
            }

            else if($exit>0) $exit++;

        }
        $output=implode(' and ',$output).' ago';
    }

//  die($output);
    return $output;
}
$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$url = str_ireplace('index.php','',$url);
		$result = mysql_query("SELECT * FROM posts WHERE status='Published' ORDER BY id DESC LIMIT 7");
		while($row = mysql_fetch_array($result)){
		?>
		<li class="menu"><a href="http://<?php echo $url; echo "post.php?id="; echo $row['permalink']?>">
		<span class="name"><?php echo $row['title'];?></span><span class="comment"><?php echo time_since($row['date']);?></span><span class="arrow"></span></a></li>		
		<?php
		} 
		?>
	</ul>
</div>
<div id="footer">
	<!-- Support iWebKit by sending us traffic; please keep this footer on your page, consider it a thank you for my work :-) -->
	<p class="noeffect">Powered by <a class="noeffect" href="http://zachs.co/iblog">iBlog</a> & <a class="noeffect" href="http://snippetspace.com">iWebKit</a></p></div>

</body>

</html>
