  <h2>Login</h2>
<?php
$a=time();
$b=date('d M y - H:i:s', $a);
if(isset($_SERVER['REMOTE_ADDR'])){
    echo "<p>".$b." - IP: ".$_SERVER['REMOTE_ADDR']." - HOSTNAME: ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."</p>";
}
?>
          <form action="?r=login" method="POST">
              Username: <input id="username" name="username" type="text"/><br>
              Password: <input id="password" name="password" type="password"/><br>
              <input type="submit">
          </form>
