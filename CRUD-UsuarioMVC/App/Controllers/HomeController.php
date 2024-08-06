<?php


namespace App\Controllers;
use App\Lib\Sessao;
class HomeController extends Controller{

    public function protege(){
        if (!isset($_SESSION['usuario'])|| $_SESSION['usuario'] == null) {
            Sessao::gravaMensagem('<div class="alert alert-warning" role="alert">Você precisa estar logado para acessar esta página.</div>');
            $this->redirect('/');
        }
    }
        public function index()
    {
        $this->protege();
        $this->render('home/index');
    }


    
}
