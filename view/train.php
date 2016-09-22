<?php
require_once __DIR__.'/../model/TrainIterator.php';
        $var = array();
        $var = TrainIterator::getTrainID();
        $data=array();
        $i =0;
        echo "<table>"."<tr>"."<th>Id</th>"."<th>Matricola treno</th>"."</tr>";
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getDescrizione();
            $data[$i]= $p[$i];
            echo '<tr><td>'.$i.'</td><td>'.$data[$i].'</td></tr>';
            $i++;
        }
        echo '</table>';
        echo '</table><form><input type="button" value="Back" onClick="history.go(-1);"></form>';
