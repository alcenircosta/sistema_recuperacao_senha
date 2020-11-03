<?php
class LoadPage{
    public $path;
    public $dir = 'pages/';
    function __construct($url,$ext){
        $this->path = $this->dir.$url.$ext;
    }
public function load(){
      if(file_exists($this->path)){
        include ($this->path);
      }else{
        echo "<div class='alert alert-danger'>Página não encontrada!</div>";         
      }
    }
}
    ?>