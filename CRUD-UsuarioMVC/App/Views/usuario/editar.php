<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Editar dados do usuário</h1>
        <?php

        echo $Sessao::retornaMensagem();
        $Sessao::limpaMensagem();
      
        ?>
        
        <form action="<?php echo 'http://'.APP_HOST.'/usuario/salvar/editar';?>" method="post" id="formEditarUsuario">
          
            <div class="form-group">
              <input type="hidden" name="login" value="<?php echo $viewVar['usuario']->getLogin();?>">
          </div>
          
          <div class="form-group">
            <label for="login">Login do Usuario</label>
            <input type="text" class="form-control" name="login" value="<?php echo $viewVar['usuario']->getLogin(); ?>" disabled>
          </div>
          
          <div class="form-group">
            <label for="nome">Nome do Usuario</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
          </div>
          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="text" class="form-control" name="senha" value="<?php echo $viewVar['usuario']->getSenha(); ?>" required>
          </div>
          
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value=" <?php echo $viewVar['usuario']->getEmail();?>">
        </div>
          
        <div class="form-group">
              <label for="permissao">Permissao</label>
              <div class="input-group mb-3">
              
                <select class="custom-select" name="permissao" id="permissao" required>
                  <option value="Admin">Administrador</option>
                  <option value="Normal">Normal</option>
                  <option selected value="Leitura">Leitura</option>
                </select>
              </div>
              </div>

          <button type="submit" class="btn btn-success btn-sm">Salvar</button>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>
