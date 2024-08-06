<?php
namespace App\Controllers;
use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controller{

// criar a função para receber os dados do login e verificar se está tudo correto,
// alimentar a sessão com os dados do usuario

    public function logar(){ 
        //primeiro receber os dados
        $login = $_POST['login']; 
        $senha = $_POST['senha'];
        
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->autenticar($login, $senha);
        
        
        
        if($usuario){
            session_start();
            $_SESSION['usuario'] = $usuario;        
            return $this->render('home/index');
            
        }if($usuario == null){
        
        Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">login ou senha invalidos </div>');
        $this->redirect('/'); 
        }
    }
    public function protege(){
        if (!isset($_SESSION['usuario'])|| $_SESSION['usuario'] == null) {
            Sessao::gravaMensagem('<div class="alert alert-warning" role="alert">Você precisa estar logado para acessar esta página.</div>');
            $this->redirect('/');
        }
    }
    public function listar(){
        $this->protege();
        $usuarioDAO = new UsuarioDAO();
        self::setViewParam('listarUsuarios', $usuarioDAO->listar());
        $this->render('/usuario/listar');
        Sessao::limpaMensagem();
    }
    public function editar($params){
        $this->protege();
        $login = $params[0];
        $usuarioDAO = new UsuarioDAO();
        $objUsuario = $usuarioDAO->listar($login);

        if($objUsuario == null){
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Falha ao recuperar dados do usuario id='.$login.'</div>');
            $this->redirect('/usuario/editar');       
        }
        self::setViewParam('usuario', $objUsuario);
        $this->render('/usuario/editar');
        Sessao::limpaMensagem();
    }
    public function salvar($param){
        $this->protege();
        $cmd = $param[0];
        $dadosform = Util::sanitizar($_POST);

        $objUsuario = new Usuario();

        $objUsuario->setUsuario($dadosform);

        $errovalidacao = false;

        if(empty($dadosform['login'])){
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>');
            Sessao::gravaErro('errologin', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }
        if($errovalidacao){
            self::setViewParam('usuario', $objUsuario);
            if($cmd == 'editar'){
                $this->render('/usuario/editar');
            }elseif($cmd == 'novo'){
                $this->render('/usuario/cadastrar');
            }
            die();
        }
        $usuarioDAO = new UsuarioDAO();

        if($cmd == 'editar'){
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">usuario atualizado com sucesso.</div>');
        }elseif($cmd == 'novo'){
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Novo usuario cadastrado.</div>');
        }   

        Sessao::limpaErro();
        $this->redirect('/usuario/listar');
    }
    public function excluirConfirma($param){
        $param[1] = urldecode($param[1]);
        $dados = Util::sanitizar($param);

        $objusuario = new Usuario();
        $objusuario->setLogin($dados[0]);
        $objusuario->setNome($dados[1]);

        self::setViewParam('usuario', $objusuario);
        $this->render('/usuario/excluirConfirma');
    }
    public function excluir($param){
        $this->protege();
        $objusuario = new Usuario();
        $objusuario->setLogin(Util::sanitizar($_POST['login']));

        $usuarioDAO = new UsuarioDAO();

        if(!$usuarioDAO->excluir($objusuario)){
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">usuario Não Encontrado.</div>');
        }else{
        Sessao::gravaMensagem('<div class="alert alert-success" role="alert">usuario excluído com sucesso!.</div>');
        }
        $this->redirect('/usuario/listar');
    }
    public function cadastrar(){
        $this->protege();
        $this->render('usuario/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function deslogar(){
        
        unset($_SESSION['usuario']);
        $this->redirect('/');
    }
}