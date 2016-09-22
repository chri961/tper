<?php
require_once __DIR__.'/../model/Log.php';
        $var = array();
        $var = Log::findAllLog();
        $data=array();
        $i =0;
        echo "<table>"."<tr>"."<th>Id Utente</th>"."<th>Ip</th><th>Token</th>"."</tr>";
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getUtenteId();
            $p[$i+1]= $samples->getIp();
            $p[$i+2]= $samples->getToken();
            $data[$i]= $p[$i];
            $data[$i+1]= $p[$i+1];
            $data[$i+2]= $p[$i+2];
            echo '<tr><td>'.$data[$i].'</td><td>'.$data[$i+1].'</td><td>'.$data[$i+2].'</td></tr>';
            $i++;
        }
        echo '</table>';

