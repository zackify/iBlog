<?php
session_start();
require('../connect.php');
$result = mysql_query("SELECT reg FROM siteinfo");
$row = mysql_fetch_array($result);
if($row['reg'] == ""){
?>
<script type="text/javascript">
<!--
window.location = "../"
//-->
</script>
<?php
die();
}
if(isset($_POST['submit'])){
if($_POST['username'] != "" && $_POST['password'] != "" && $_POST['email'] != ""){
$username = mysql_real_escape_string($_POST['username']);
$email = mysql_real_escape_string($_POST['email']);
$twitter = mysql_real_escape_string($_POST['twitter']);
$result = mysql_query("SELECT * FROM users WHERE username='$username'");
if(mysql_num_rows($result) != 0){
die("user already exists");
}
$password = hash("sha256",hash("sha256",mysql_real_escape_string($_POST['password'])));
$check = mysql_query("SELECT * FROM users");
if(mysql_num_rows($check) == 0){
$lvl = 3;
}
else{
$lvl = 0;
}
mysql_query("INSERT INTO users (username,password,email,twitter,lvl) VALUES ('$username','$password','$email','$twitter','$lvl')") or die(mysql_error());
$result = mysql_query("SELECT * FROM users WHERE username='$username'");
$row = mysql_fetch_array($result);
$_SESSION['user'] = $row['username'];
$_SESSION['id'] = $row['id'];
$_SESSION['lvl'] =$row['lvl'];
?>

<script type="text/javascript">
<!--
window.location = "index.php"
//-->
</script>
<?php
die();


}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/demo.css">
    <link rel="stylesheet" type="text/css" href="form-kit/css/style.css">
    <link rel="stylesheet" type="text/css" href="form-kit/css/uniform.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="form-kit/js/jquery.tools.js"></script>
    <script type="text/javascript" src="form-kit/js/jquery.uniform.min.js"></script>
    
</head>

<body class="wrapped">



<div class="TTWForm-container">

    <div class="TTWForm-wrapper wrapped">


        <form enctype="multipart/form-data" action="register.php" class="TTWForm clearfix"
              method="post" novalidate="">

<center><?php echo $error;?></center>
            <div id="field1-container" class="field f_100">
                <label for="field1">
                Username
                </label>
                <input name="username" id="field1" required="required" type="text">
            </div>
 <div id="field1-container" class="field f_100">
                <label for="field1">
               Email
                </label>
                <input name="email" id="field1" required="required" type="email">
                 <label for="field1">
              Twitter
                </label>
                <input name="twitter" id="field1" required="required" type="text">
                       </div>  <div id="field1-container" class="field f_100">
                <label for="field1">
               Password
                </label>
                <input name="password" id="field1" required="required" type="password">
            </div>
            
                  

            <div id="form-submit" class="field f_100 clearfix submit">
                <input name="submit" value="Submit" type="submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>