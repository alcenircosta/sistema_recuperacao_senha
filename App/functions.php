<?php

function load_pages($url, $ext)
{
    $dir = 'pages/';
    $path = $dir . $url . $ext;

    if (file_exists($path)) {
        include($path);
    } else {
        echo "<br><div class='alert alert-danger'>Página não encontrada!</div>";
    }
}

function check_info($con)
{
    if (isset($_POST['recuperarSenha']) && $_POST['recuperarSenha'] == 'recform') {
        $email = addslashes($_POST['email']);
        $sql = $con->prepare("SELECT * FROM users WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $get = $sql->get_result();
        $valor = $get->num_rows;

        if ($valor > 0) {
            $dados = $get->fetch_assoc();
            add_dados_recover($con, $email);
        } else {
            echo "<br><div class='alert alert-danger'>Email não encontrado na base de dados, verifique se o digitou corretamente!</div>";
        }
    }
}

function add_dados_recover($con, $email)
{
    $hash = base64_encode(rand());
    $sql = $con->prepare("INSERT INTO `recover_solicitation` (`email`, `hash`) VALUES (?,?)");
    $sql->bind_param("ss", $email, $hash);
    $sql->execute();

    if ($sql->affected_rows > 0) {
        send_email($con, $email, $hash);
    } else {
        echo "<br><div class='alert alert-danger'>Não foi possível concluir a solicitação, por favor, tente novamente!</div>";
    }
}

function send_email($con, $email, $hash)
{
    $recipientEmail = $email;
    $subject = "RECUPERAR SENHA";
    $body = "<h1>Você solicitou uma nova senha?</h1>
        <hr>
        <h3>Se sim, aqui está o link para voce recuperar sua senha:</h3>
        <p>Para recuper sua senha clique  <a href='" . siteDir . "?pagina=alterar&hash={$hash}'>AQUI!</a>.</p>
        <h4>Se você não solicitou, apenas ignore este email, porém alguem tentou alterar seus dados em nosso sistema.</h4>
        <hr>
        Atenciosamente, Alcenir.";
    $email = new Email();
    if ($email->send_email($recipientEmail, $subject, $body)) {
        echo "<br><div class='alert alert-success'>As intruções foram enviadas para o seu email, acesse-o para recuperar sua senha</div>";
    } else {
        echo "<br><div class='alert alert-danger'>Ocorreu um erro ao enviar as intruções!</div>";
    }
}

function hash_check($con, $hash)
{
    $sql = $con->prepare("SELECT * FROM `recover_solicitation` WHERE `hash` =  ?");
    $sql->bind_param('s', $hash);
    $sql->execute();
    $get = $sql->get_result();
    $total = $get->num_rows;

    if ($total > 0) {
        if (isset($_POST['enviar']) && $_POST['enviar'] == 'update') {
            $new_password = addslashes(md5($_POST['pass']));
            $dados = $get->fetch_assoc();
            if (update_password($con, $dados['email'], $new_password)) {
                echo "<br><div class='alert alert-success'>Senha atualizada com sucesso!</div>";
                if (!delete_hash($con, $dados['email'])) {
                    echo "<br><div class='alert alert-danger'>ERRO: 0010102(delete_hash)</div>";
                }
                redirect("?pagina=inicio");
            } else {
                echo "<br><div class='alert alert-danger'>Ocorreu um erro ao atualizar a sua senha, tente novamente.</div>";
            }
        }
    } else {
        echo "<br><div class='alert alert-danger'>Hash não encontrada, tente enviar o email novamente!</div>";
        die();
    }
}

function update_password($con, $email, $password)
{
    $sql = $con->prepare("UPDATE `users` SET `password` = ? WHERE email = ?");
    $sql->bind_param("ss", $password, $email);
    $sql->execute();

    if ($sql->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function delete_hash($con, $email)
{
    $sql = $con->prepare("DELETE FROM `recover_solicitation` WHERE `email` = ?");
    $sql->bind_param("s", $email);
    $sql->execute();

    if ($sql->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function redirect($url)
{
    header("refresh:3;url={$url}");
}

function insert_info($con)
{
    if(isset($_POST['insert']) && $_POST['insert'] == 'Entrar'){
        $password = md5($_POST['password']);
        $sql = $con->prepare("INSERT INTO `users` (`name`,`user`,`email`,`password`) VALUES (?,?,?,?)");
        $sql->bind_param("ssss", $_POST['name'],$_POST['user'],$_POST['email'],$password);
        $sql->execute();

        if ($sql->affected_rows > 0) {
            echo "<br><div class='alert alert-success'>Dados inseridos com sucesso!</div>";
        }else{
            echo "<br><div class='alert alert-danger'>Não foi possível concluir a solicitação, por favor, tente novamente!</div>";
        }
        
    }
}