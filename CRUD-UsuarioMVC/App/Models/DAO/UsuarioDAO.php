<?php
namespace App\Models\DAO;
use App\Models\Entidades\Usuario;
use Exception;
use PDO;
class UsuarioDAO extends BaseDAO{
    public function autenticar($login, $senha) {
        try {
            $resultado = $this->select("SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'");
            $dados_usuario = $resultado->fetch(PDO::FETCH_ASSOC);

            if ($dados_usuario) {
                return $dados_usuario;
            } else {
                throw new \Exception("Usuário ou senha inválidos.", 401);
            }
        } catch (Exception $e) {
            throw new \Exception("Erro na autenticação do usuário: " . $e->getMessage(), 500);
        }
    }

    public function listar($login = null){
        if($login){
            $resultado = $this->select("SELECT * FROM usuario WHERE login = '$login'");
            return $resultado->fetchObject(Usuario::class);
        }else{
            $resultado = $this->select("SELECT * FROM usuario");
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
        }
    }

    public function salvar(Usuario $usuario){
        try {
            $login = $usuario->getLogin();
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();
    
            $existe = $this->verifica('usuario', 'login', "login = '$login'");
            if ($existe > 0) {
                throw new \Exception("Login já existe. Escolha outro.", 409);
            }

            $result = $this->insert(
                'usuario',
                ":login, :nome, :senha, :email, :permissao",
                [
                    ':login' => $login,
                    ':nome' => $nome,
                    ':senha' => $senha,
                    ':email' => $email,
                    ':permissao' => $permissao
                ]
            );
    
            if ($result === false) {
                throw new \Exception("Erro ao salvar usuário.", 500); // Erro interno do servidor
            }
    
            return $result;
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao salvar usuário: " . $e->getMessage(), 500);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function atualizar(Usuario $usuario){
        try{
            $login = $usuario->getLogin();
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();

            return $this->update(
                'usuario', "nome = :nome, senha = :senha, email = :email, permissao = :permissao",
                [
                    ':login'=>$login,
                    ':nome'=>$nome,
                    ':senha'=>$senha,
                    ':email'=>$email,
                    ':permissao'=>$permissao
                ],
                'login = :login'
            );
        }catch(\Exception $e){
            throw new \Exception("Erro na gravação dos dados", 500);
        }
    }
    public function excluir(Usuario $usuario){
        try{
            $login = $usuario->getLogin();
            return $this->delete('usuario', "login = '$login'");
        }catch(Exception $e){
            throw new \Exception("$e");
        }
    }
}