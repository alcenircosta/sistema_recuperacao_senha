<?php

function load_pages($url, $ext){
        $dir = 'pages/';
        $path = $dir.$url.$ext;
        
        if(file_exists($path)){
            include ($path);
        }else{
            echo "<div class='alert alert-danger'>Página não encontrada!</div>";         
        }
    }

    function check_info($con){
        if(isset($_POST['recuperarSenha']) && $_POST['recuperarSenha'] == 'recform'){        
            $email = addslashes($_POST['email']);
            $sql = $con->prepare("SELECT * FROM users WHERE email = ?");
            $sql->bind_param("s", $email);
            $sql->execute();
            $get = $sql->get_result();
            $valor = $get->num_rows;
           
            if($valor > 0){
                $dados = $get->fetch_assoc();
                send_email($con, $dados['email']);
            }else{

            }
        }else{
            echo "Aguardando";
        }
    }

    function send_email($con, $email){
        echo $email;
    }

?>