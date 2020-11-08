<div class='alert alert-success'>Insira seu email e uma senha qualquer, em seguida tente recuperar a senha. (Inisira um email válido pois serao enviadas informações para ele)</div>

<form method='post'>
<label>Nome</label>
<input type="text" name='name' class='form-control' placeholder="Nome"/><br>

<label>Usuário</label>
<input type="text" name='user' class='form-control' placeholder="Usuário"/><br>

<label>E-mail</label>
<input type="email" name='email' class='form-control' placeholder="E-mail"/><br>

<label>Senha</label>
<input type="password" name='password' class='form-control' placeholder="Senha..." /><br/>

<input type="submit" value="Entrar" name="insert" class="btn btn-primary btn-lg btn-block">
<p align="right"><a href="?pagina=recuperar">Esqueceu a senha? Recupere aqui!</a></p>
</form>
<?php
    $con = MySql::conect();
    insert_info($con);