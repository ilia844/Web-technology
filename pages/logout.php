<?php
    setcookie("loggedUser", "", time() - 3600);
    header('Location: TASKS.php#lab6');
?>