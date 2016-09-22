<?php
require_once __dir__.'/../view/HtmlPage.php';
require_once __dir__.'/../view/ApiPage.php';
require_once __dir__.'/../conf/Config.php';
require_once __dir__.'/../model/DB.php';
require_once __DIR__.'/../model/DBMySQL.php';
require_once __DIR__.'/../model/TrainIterator.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Log.php';

/**
 * Description of Controller
 *
 * @author christianberti
 */
class Controller {
   // decommentare solo una delle prossime due linee
  const DEBUG = true;
  //const DEBUG = false;
//  private $smp;
  private $page;
  private $conf;
  private $sam;
//  private $sa;
  function __construct($html=TRUE) {
      //$this->sam= new MyIterator();
    $this->conf=new Config();
    if ($html) {
      $this->page=new HtmlPage();
    }
    else {
      $this->page=new ApiPage();
    }
    
  }
  //viene gestito il routing dell'intera applicazione. Si evita di creare uno script
  //per ogni azione da eseguire. Si noti come in base alla sintassi decide se è una
  //view di HTML oppure una chiamata API. Inoltre mediante le substring viene richiamato
  //l'opportuno metodo di action()
  public function route(){
      if (isset($_GET['r'])){
          $parts=  explode('/',$_GET['r']);
          if (count($parts)==1){
              $action=$parts[0];
              $method='action'.strtoupper(substr($action, 0, 1)).substr($action, 1);
          }
          else{
             //api 
              $control=$parts[0];
              $action=$parts[1];
              $method='action'.strtoupper(substr($control, 0, 1)).substr($control, 1).strtoupper(substr($action, 0, 1)).substr($action, 1);
              $this->page=new ApiPage();//output non html
          }
//          $method='action'.strtoupper(substr($_GET['r'], 0, 1)).substr($_GET['r'], 1);
          if(method_exists($this,$method)){
              $this->$method();
          }
          else {
              //$this->page->addData('errore', "Azione non riconosciuta: {$_GET['r']}");
              $this->page->show('Routing error','error.php');    
          }
      }
      else {
          $this->actionIndex();
      }
  }
    /*************************************
     *                                   *
     *              HTML                 *
     *                                   *
     ************************************/
  
  function actionPhpliteadmin(){
      header("location: ".Config::SQLITEADMINPATH);
  }
  function actionIndex(){
      $this->page->show('Pittogram system','index.php');    
  }
  function actionDocumentation(){
      $this->page->show("System documentation", 'doc.php');
  }
  function actionTrain(){
      $this->session();
      $this->page->show("Elenco treni", 'train.php');
  }
  function actionAdministration(){
      $this->session();
      if(isset($_SESSION['user'])){
          $this->page->show("Amministration Page", 'adminuser.php');
          return;
      }
      $this->page->show("Login Page", 'login.php');
  }
  function actionActione(){
      $this->session();
      $this->page->show("Login Page",'actione.php');
  }
  function actionRecoverPassword(){
      $this->session();
      $this->page->show("Reset password",'recoverPassword.php');
  }
  function actionRecover(){
      $this->session();
      $this->page->show("Reset result",'recover.php');
  }
  function actionInvioMail(){
      $this->session();
      $this->page->show("Admin Contact",'inviomail.php');
  }
      function actionInvioSegnalazione(){
          $this->session();
          $this->page->show("Send Segnalation", 'sendmail.php');
      }
      function actionUtente(){
          $this->session();
          $this->page->show("System User", 'utenti.php');
      }
      function actionSegnalazione(){
          $this->session();
          $this->page->show("Console segnalazioni", 'segnalazione.php');
      }
  function actionLogin(){
      if (isset($_POST['username']) && isset($_POST['password'])){
          //il form è stato compilato
          //le credenziali sono valide?
          $user =$_POST['username'];
          $pass =  $_POST['password'];
          $password = md5($pass);
          $var= User::checkLogin($user,$password);
          //echo $var;
          $string=json_decode($var);
          if ($user==$string[0]){
              if($string[1]='admin'){
                $this->session();
                $_SESSION['user']=$_POST['username'];
                $this->page->show('Autenticato', 'actione.php');
                return;
              }
              //accetto le credenziali
              $this->session();
              $_SESSION['user']=$_POST['username'];
              $this->page->show('Autenticato', 'autenticato.php');
              return;
          }
      }
      $this->page->show('Login', 'login.php');
  }
  function actionLogout(){
      $this->session();
      if(isset($_SESSION['user'])){
          unset($_SESSION['user']);
          $this->page->show('Pittogram system','index.php');
      }
      
  }
  function actionLog(){
      $this->session();
          $this->page->show('Log system','log.php');
      }
  
    /*************************************
     *                                   *
     *              APIs                 *
     *                                   *
     ************************************/
  
    public function actionApiPing(){
        $this->page->show('{ apiresult : 1 }');  
    }
    public function actionApiLogIn(){
        if(isset($_POST['user'])){
            $user=$_POST['user'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
//        $var = User::checkLogin($user, $password);
        $var = User::checkLoginApi($user, $password);
            $this->page->show($var);
        }   
    public function actionApiUser(){
        $var = array();
        $var = User::findAllUser();
        $data = array();
        $i =0;
        foreach($var as $key => $samples){
            $p[$i]= $samples->getNome();
            $data[$i]= $p[$i];
            $i++;
        }
        $this->page->show(json_encode($data));
    }
    public function actionApiPittogramma(){
        //TODO carica lista pittogrammi presenti nel treno specifico
    }
    public function actionApiAddUser(){
        //TODO
        //prevista per sviluppo futuro di funzionalità manageriale qualora utente.ruolo = admin
    }
    public function actionApiTrain(){
        if(isset($_POST['token'])&& isset($_POST['id'])){
            $id = $_POST['id'];
            $token = $_POST['token'];
            $var = Log::checkToken($id, $token);
            $data=array();
            $i =0;
            foreach ($var as $key => $sampless) {
                $p[$i]= $sampless->getId();
                $p[$i+1]= $sampless->getToken();
                $data[$i]= $p[$i];
                $data[$i+1]= $p[$i+1];
                if($id==$data[$i]&& $token==$data[$i+1]){
                    //$this->page->show("{'$data[$i]'}");
//                    $vare = array();
//                    $vare = TrainIterator::findAll();
//                    $date=array();
//                    $i =0;
//                    foreach ($vare as $key => $samples) {
//                        $pa[$i]= $samples->getMatricola();
//                        $date[$i]= $pa[$i];
//                        $i++;
//                    }
//                     $this->page->show(json_encode($date));
//                     return;
//                }else{
//                    $this->page->show("{apiresult:0}");
//                }
//            }
        
        }
       
        }
        }
    }
    
    public function actionApiUpdateImage(){
        //API aggiornamento immagini su internal storage
    }
    public function actionApiTest(){
        $this->page->show(json_encode($_GET));
    }
    public function actionApiLogout(){
        if(isset($_POST['token']) && isset($_POST['id'])){
            $var = $_POST['token'];
            $id = $_POST['id'];
            Log::hexpiredSession($id,$var);
            $this->page->show('{ apiresult : 1 }'); 
        }
    }
    /*************************************
     *                                   *
     *         private Function          *
     *                                   *
     ************************************/
    private function session(){
        session_start();
    }

}