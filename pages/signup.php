<?php
    function isExistsUser ($user, $users) {
        $result = false;
        $users->data_seek(0);
        while ($row = $users->fetch_assoc()) {
            if (strcmp($row['login'], $user) == 0)
                $result = true;
        }
        return $result;
    }

    $mysqli = new mysqli("localhost", "root", "", "laba6");
    $data = $_POST;

    $errLogin = "";
    $errPassword = "";
    $errPassword2 = "";
    $correctData = true;
    if (isset($data['do_signup']) && !($mysqli->connect_errno)) {

        if (mb_strlen(trim($data['login'])) < 3 ) {
            $errLogin = "Минимальная длина 3 символа";
            $correctData = false;
        }
        if (mb_strlen($data['password']) < 8 ) {
            $errPassword = "Минимальная длина 8 символов";
            $correctData = false;
        } elseif ($data['password'] != $data['password2']) {
            $errPassword2 = "Пароли не совпадают!";
            $correctData = false;
        }

        if ($correctData) {
            $login = trim($data['login']);
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $query = "SELECT login FROM users";
            $users = $mysqli->query($query);
            if (!isExistsUser($login, $users)) {
                $query = "INSERT INTO users VALUES(NULL, '$login', '$password')";
                $mysqli->query($query);
                echo '<span style="color: green;">Пользователь успешно зарегистрирован!<br>
                Можете вернуться на <a href="TASKS.php#lab6">главную</a> страницу для авторизации!</span><hr>';
            } else echo '<span style="color: red">Такой пользователь уже зарегистрирован!</span><hr>';
        }
    }
?>

<form action="signup.php" method="POST">

    <strong>Ваш логин: </strong><br>
    <input type="text" name="login" value="<?php echo @$data['login'] ?>">
    <span style="color: red;"><?php echo $errLogin ?></span><br><br>

    <strong>Ваш пароль: </strong><br>
    <input type="password" name="password">
    <span style="color: red;"><?php echo $errPassword ?></span><br><br>

    <strong>Повторите пароль: </strong><br>
    <input type="password" name="password2">
    <span style="color: red;"><?php echo $errPassword2 ?></span><br><br>

    <input type="submit" name="do_signup" value="Зарегистрироваться"><hr>
</form>