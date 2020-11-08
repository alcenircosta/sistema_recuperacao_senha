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
            send_email($con, $email, $hash);
        }else{

        }

    }

    function send_email($con, $email, $hash){
        $recipientEmail = $email;
        $subject = "RECUPERAR SENHA";
        $body = "<h1>Você solicitou uma nova senha?</h1>
        <hr>
        <h3>Se sim, aqui está o link para voce recuperar sua senha:</h3>
        <p>Para recuper sua senha clique  <a href='".siteDir."?pagina=alterar&hash={$hash}'>AQUI!</a>.</p>
        <h4>Se você não solicitou, apenas ignore este email, porém alguem tentou alterar seus dados em nosso sistema.</h4>
        <hr>
        Atenciosamente, Alcenir.";
        $email = new Email();
        if($email->send_email($recipientEmail, $subject, $body)){
            echo "<div class='alert alert-success'>As intruções foram enviadas para o seu email, acesse-o para recuperar sua senha</div>";
        }else{
            echo "<div class='alert alert-danger'>Ocorreu um erro ao enviar as intruções!</div>";
        }
    }

    function hash_check($con){
        $sql = $con->prepare("SELECT * FROM `recover_solicitation` WHERE `hash` =  ? AND `status` = 0");
        $sql->bind_param('s',$_GET['hash']);
        $sql->execute();
        $get = $sql->get_result();
        $total = $get->num_rows;

        if($total >0){

            echo "<div class='alert alert-success'>Alteração efetuada com sucesso!</div>";
        }else{
            echo "<div class='alert alert-danger'>Hash não encontrada, tente enviar o email novamente!</div>";
        }
    }

?>