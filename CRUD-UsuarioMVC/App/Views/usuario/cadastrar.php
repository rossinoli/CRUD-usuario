<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-6">
          <h1 class="mt-2">Cadastro de Usuario</h1>
            <?php
            
              echo $Sessao::retornaMensagem();
              $Sessao::limpaMensagem();
            ?>
            <form action="<?php echo 'http://'.APP_HOST.'/usuario/salvar/novo';?>" method="post" id="formCadastro">
              <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" value="<?php if (isset($viewVar['usuario'])) echo $viewVar['usuario']->getLogin();?>" required>
              </div>
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php if (isset($viewVar['usuario'])) echo $viewVar['usuario']->getNome();?>" required>
              </div>
              
              <div class="form-group">
                <label for="senha">Senha</label>
              <input type="text" class="form-control" name="senha" value="<?php if (isset($viewVar['usuario'])) echo $viewVar['usuario']->getSenha();?>">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
              <input type="text" class="form-control" name="email" value="<?php if (isset($viewVar['usuario'])) echo $viewVar['usuario']->getEmail();?>">
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
              <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
  </div>
</main>
