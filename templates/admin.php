<?php if($_SESSION['is_admin'] == '1'):?>
<?php //Форма добавления новости?>
<?php else:?>
<form method="post">
    Login: <input type="text" name="login"/><br>
    Password: <input type="password" name="pass"/><br>
    <input type="submit" value="Login"/>
</form>
<?php endif;?>