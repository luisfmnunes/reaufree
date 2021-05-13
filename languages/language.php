<?php

function getLanguages(){

  if (isset($_GET['lang'])) {
      $lang = $_GET['lang'];
      switch ($lang) {
          case 'en':
              return 'languages/en.php';
              break; //Inglês
          case 'pt-br':
              return 'languages/pt_br.php';
              break; //Português Brasil
          case 'es':
              return 'languages/es.php';
              break; //Espanhol
          case 'cn':
              return 'language/cn.php';
              break; //Chinês
          default:
              return 'languages/pt_br.php';
              break;
      }
    }
  }

?>
