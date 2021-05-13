<?php

function verify_exchange($wallet){
  include 'conexao/conexao.php';
  $sql = "SELECT * FROM users WHERE wallet = '$wallet' AND exchange = 'BRBTC' LIMIT 1;";
  $busca = mysqli_query($conexao, $sql);

  if ($dados = mysqli_fetch_array($busca) > 0) {
    return "BRBTC";
  }else{
    return "NOPE";
  }
}

?>
