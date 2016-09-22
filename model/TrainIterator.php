<?php
require_once __DIR__."/DB.php";
require_once __DIR__."/SampleIterator.php";
/**
 * Description of Sample
 *
 * @author christianberti
 */
class TrainIterator {
    private $id;
    private $matricola;
    private $descrizione;
    private $cassa;
    private $blocata;
    private $foto;
    private $idtreno;
    function __construct($id, $matricola,$idtreno, $descrizione, $cassa, $blocata, $foto) {
        $this->id = $id;
        $this->matricola = $matricola;
        $this->idtreno = $idtreno;
        $this->descrizione = $descrizione;
        $this->cassa = $cassa;
        $this->blocata = $blocata;
        $this->foto = $foto;
    }

    static function factoryByRow($row) {
        $id=$row['Id'];
        $matricola=$row['MatrMR'];
        $idtreno=$row['idtreno'];
        $descrizione=$row['Descrizione'];
        $cassa=$row['Cassa'];
        $bloccata= $row['Pos_Composizione_Bloccata'];
        $foto= $row['foto'];
        return new TrainIterator($id, $matricola,$idtreno, $descrizione, $cassa,$bloccata, $foto);
    }
        static function getTrainList(){
        $db=  DB::factory();
        $result = $db->query("SELECT t.MatrMR FROM anagmr t");
        return new SampleIterator($result);
    }
    static function getTrainID(){
        $db=  DB::factory();
        $result = $db->query("SELECT * FROM anagmr t");
        return new SampleIterator($result);
    }
    static function findAll(){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM anagmr t ");
        return new SampleIterator($result);
    }
    function getId() {
        return $this->id;
    }

    function getMatricola() {
        return $this->matricola;
    }

    function getDescrizione() {
        return $this->descrizione;
    }

    function getCassa() {
        return $this->cassa;
    }

    function getBlocata() {
        return $this->blocata;
    }

    function getFoto() {
        return $this->foto;
    }


}
