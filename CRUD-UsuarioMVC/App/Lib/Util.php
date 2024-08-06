<?php

namespace App\Lib;

class Util {
  

  public static function sanitizar($dados) {
    if (is_array($dados)) {
      foreach ($dados as $chave => $valor) {
        //$valor = filter_var($valor, FILTER_SANITIZE_STRING); 
        $valor = str_replace("&#x", '', $valor); 
        $valor = stripslashes($valor);
        $dados[$chave] = trim($valor);
      }
    } else {
      //$dados = filter_var($dados, FILTER_SANITIZE_STRING);
      $dados = str_replace("&#x", '', $dados); 
      $dados = stripslashes($dados);
      $dados = trim($dados);
    }
    return $dados;
  }
  
}
