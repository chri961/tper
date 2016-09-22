<h1>Admin Page</h1>
<?php
$a=time();
$b=date('d M y - H:i:s', $a);
if(isset($_SERVER['REMOTE_ADDR'])){
    echo "<p>".$b." - IP: ".$_SERVER['REMOTE_ADDR']." - HOSTNAME: ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."</p>";
}
?>
<form action="?r=actione" method="POST">
 User: <input type="text" name="user" value="" />
 Password: <input type="password" name="password" value ="" />
 <a href="?r=recoverPassword">Forget Password?</a>
 <p><input value="LogIn" type="submit"></p>
</form>

