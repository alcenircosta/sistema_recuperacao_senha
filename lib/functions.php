<?php

function loadPages($url, $ext){
    $dir = 'pages/';
    $path = $dir.$url.$ext;
      
    if(file_exists($this->path)){
        include ($this->path);
      }else{
        echo "<div class='alert alert-danger'>Página não encontrada!</div>";         
      }
    }

    ?>