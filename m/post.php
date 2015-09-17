<?php
require('../connect.php');
require('../Markdown.php');
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
		</div>
<div id="tributton">
	<div class="links">
		<a href="index.php">Home</a><a href="pages.php">Pages</a><a href="about.html">About</a></div>
</div>
<div id="content">
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
$id = $_GET['id'];
		$result = mysql_query("SELECT * FROM posts WHERE permalink='$id'");
		$row = mysql_fetch_array($result);
		?>
		<span class="graytitle"><?php echo time_since($row['date']);?></span>
		<ul class="pageitem">
		<li class="textbox"><span class="header"><?php echo $row['title'];?></span><?php echo Markdown($row['body']);?></p>
		</li>	
	</ul>
	<ul class="pageitem"><li class="textbox">
	<?php
if($info['disqus'] == "on"){
echo $info['disqus_code']; 
}
?>	</li></ul>
			</div>
<div id="footer">
	<!-- Support iWebKit by sending us traffic; please keep this footer on your page, consider it a thank you for my work :-) -->
	<p class="noeffect">Powered by <a class="noeffect" href="http://zachs.co/iblog">iBlog</a> & <a class="noeffect" href="http://snippetspace.com">iWebKit</a></p></div>

</body>

</html>