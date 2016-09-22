<?php
require_once __DIR__.'/../model/Segnalazione.php';
        $var = array();
        $var = Segnalazione::findAllSegnalation();
        $data=array();
        $i =0;
        echo "<h2>Console segnalazioni</h2>"
        . "<table>"."<tr>"."<th>Id</th>"."<th>User</th><th>Segnalazione</th><th>Data</th><th>Stato</th>"."</tr>";
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getSeg_user();
            $p[$i+1]= $samples->getSeg_text();
            $p[$i+2]= $samples->getSeg_date();
            $p[$i+3]= $samples->getSeg_result();
            $data[$i]= $p[$i];
            $data[$i+1]= $p[$i+1];
            $data[$i+2]= $p[$i+2];
            $data[$i+3]= $p[$i+3];
            $stato;
            if($data[$i+3]=='1'){
                $stato = "risolto";
            }else {
                $stato="non risolto";
            }
            echo '<tr><td>'.$i.'</td><td>'.$data[$i].'</td><td>'.$data[$i+1].'</td><td>'.$data[$i+2].'</td><td>'.$stato.'</td></tr>';
            $i++;
        }
        echo '</table><form><input type="button" value="Back" onClick="history.go(-1);"></form>';

