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
                add_dados_recover($con,$email);
            }else{

            }
        }else{
            echo "Aguardando";
        }
    }

    function add_dados_recover($con, $email){
        $hash = base64_encode(rand());
        $sql = $con->prepare("INSERT INTO `recover_solicitation` (`email`, `hash`) VALUES (?,?)");
        $sql->bind_param("ss", $email, $hash);
        $sql->execute();

        if($sql->affected_rows > 0){
            send_email($con, $email);
        }else{

        }

    }

    function send_email($con, $email){
        // Aqui ta mail, mas é preciso utilizar o php mailer
        // mail($email, "Sua nova senha", "Minha senha é essa..." );
    }

?>