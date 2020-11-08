<form method="post">
<h4>Insira sua nova SENHA</h4>
<hr>
<label for="npass">INSIRA A NOVA SENHA</label>
<input required type="password" name="pass" class="form-control" id="npass" /><br>
<input type="submit" value="Alterar senha" class="btn btn-outline-success btn-lg btn-block"/>
<input type="hidden" value="upd" name="enviar"/>
</form>
<?php
$con = MySql::conect();
hash_check($con);
?>