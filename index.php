<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "m/";
}
//-->
</script>
<?php
Session_start();
//feel free to contribute to my CMS I only ask that you
//upload your changed files to a fork of iBlog on github 
//(http://github.com/zackify/iBlog) and no where else!

//amazing piece of code thanks to one of my friends @jdrydn that gets everything between two blocks.
function stripBlocks($html, $blockname){
	$start  = "{block:$blockname}";
	$end 	= "{/block:$blockname}";
	$total  = stristr($html,$start);
	$part2  = stristr($html,$end);
	
	return substr($total,strlen($start),-strlen($part2));
}
require("connect.php");
require("Markdown.php");
$result = mysql_query("SELECT theme FROM siteinfo");
$row = mysql_fetch_array($result);
//get the selected theme from DB
$theme_url = "themes/" .$row['theme'] ."/index.html";
if(!is_file($theme_url)){
echo "Your theme is missing index.html so I reset the theme to the default. (hopefully that theme isn't missing) Just choose it in the settings to remove this error.";
$theme_url = "themes/default/index.html";
}
//$html = the theme html
$html = file_get_contents($theme_url);

//loop and return the pages

$pages2 = Stripblocks($html,"pages");
$result = mysql_query("SELECT * FROM pages ORDER by id ASC");
while($row = mysql_fetch_array($result)){
$search = array('{url}','{title}');
$replace = array("page.php?id=" .  $row['url'],$row['url']);
$pages = str_ireplace($search,$replace,$pages2);
$page .= $pages;
}
if(isset($_SESSION['user'])){
$adminlink = $pages2;
$search = array('{url}','{title}');
$replace = array("admin","Admin");
$pages = str_ireplace($search,$replace,$adminlink);
$page .= $pages;
}
else{
$adminlink = $pages2;
$search = array('{url}','{title}');
$replace = array("login","Login");
$pages = str_ireplace($search,$replace,$adminlink);
$page .= $pages;}
$html = str_ireplace($pages2,$page,$html);

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

$posts2 = Stripblocks($html,"posts");
$result = mysql_query("SELECT * FROM posts WHERE status!='Draft' ORDER by id DESC");
while($row = mysql_fetch_array($result)){
$time = $row['date'];
$timeago = time_since($time);
$u_id = $row['user'];
$userr = mysql_query("SELECT * FROM users WHERE id='$u_id'");
$user = mysql_fetch_array($userr);
$author = $user['username'];

$c_id = $row['cat'];
$catt = mysql_query("SELECT * FROM cat WHERE id='$c_id'");
$cat = mysql_fetch_array($catt);
$category = $cat['title'];
$time = $row['date'];
$timeago = time_since($time);
$search = array('{title}','{body}','{url}','{timeago}','{date}','{author}','{category}');
$replace = array($row['title'],Markdown($row['body']),"page.php?url=".$row['permalink'],$timeago,date("m/d/y",$time),$author,$category);
$posts = str_ireplace($search,$replace,$posts2);
$post .= $posts;
}	
$html = str_ireplace($posts2,$post,$html);


$html = str_ireplace('{block:pages}','',$html);
$html = str_ireplace('{/block:pages}','',$html);
$html = str_ireplace('{block:posts}','',$html);
$html = str_ireplace('{/block:posts}','',$html);
//echo out the news
$result = mysql_query("SELECT * FROM siteinfo");
$row = mysql_fetch_array($result);
$html = str_ireplace("{sitename}",$row['name'],$html);
$html = str_ireplace("{pagetitle}",$row['name'],$html);
$html = str_ireplace("{tagline}",$row['short'],$html);
$html = str_ireplace("{title}",$row['name'],$html);
$html = str_ireplace("{baseurl}","index.php",$html);
echo $html;
?>