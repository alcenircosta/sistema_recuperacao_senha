<form method="post">
    <h4>Recuperar Senha</h4>
    <label>Insira o email Cadastrado</label>
    <input type="email" name="email" class="form-control" required />
    <code>Insira o email cadastrado para receber orientações de redefinição de senha por email!</code><br><br><br>
    <input type="submit" value="Recuperar" class="btn btn-outline-success btn-lg btn-block">
    <input type="hidden" name="recuperarSenha" value="recform" />
</form>

<?php 
$con = MySql::conect();
echo check_info($con); 
?>