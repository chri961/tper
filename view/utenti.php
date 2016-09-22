<?php
require_once __DIR__.'/../model/User.php';
        $var = array();
        $var = User::findAllUser();
        $data=array();
        $i =0;
        echo "<table>"."<tr>"."<th>Id</th>"."<th>User</th><th>Ruolo</th>"."</tr>";
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getUser();
            $p[$i+1]= $samples->getRuolo();
            $data[$i]= $p[$i];
            $data[$i+1]= $p[$i+1];
            echo '<tr><td>'.$i.'</td><td>'.$data[$i].'</td><td>'.$data[$i+1].'</td></tr>';
            $i++;
        }
        echo '</table>';
         echo '</table><form><input type="button" value="Back" onClick="history.go(-1);"></form>';

