<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo $this->title; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="generator" content="HAPedit 3.1">
<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">
<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
<div id="container">
    <div id="header"><img src="images/fer.jpg" align="center">
        </div>
<div id="wrapper">
<div id="content">
  <?php $this->setContent(); ?>
</div>
</div>
<div id="navigation">

     <?php
      if (isset($_SESSION['user'])){
          $log="logout";
          $item="Logout";
      }
      else {
          $log="administration";
          $item="Login";
      }
      $this->setNavigationBar(array(
          "index" => "Home",
          "documentation" => "Documentation",
          $log => $item,
      ));
      ?>
</div>
<div id="extra">
<!--p><strong>3) More stuff here.</strong> very text make long column make filler fill make column column silly filler text silly column fill silly fill column text filler make text silly filler make filler very silly make text very very text make long filler very make column make silly column fill silly column long make silly filler column filler silly long long column fill silly column very </p-->
</div>
<div id="footer"><p>Powered by PitApp</p></div>
</div>
</body>
</html>


