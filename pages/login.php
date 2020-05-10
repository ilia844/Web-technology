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

    function getPassword($user, $mysqli) {
        $query = "SELECT password FROM users WHERE login='$user'";
        $res = $mysqli->query($query);
        $row = $res->fetch_assoc();
        return $row['password'];
    }

    function encode($unencoded,$key){
        $string = base64_encode($unencoded);

        $arr=array();
        $x=0;
        while ($x++< strlen($string)) {
            $arr[$x-1] = md5(md5($key.$string[$x-1]).$key);
            $newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];
        }
        return $newstr;
    }

    function decode($encoded, $key){
        $strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";
        $x=0;
        while ($x++<= strlen($strofsym)) {
            $tmp = md5(md5($key.$strofsym[$x-1]).$key);
            $encoded = str_replace($tmp[3].$tmp[6].$tmp[1].$tmp[2], $strofsym[$x-1], $encoded);
        }
        return base64_decode($encoded);
    }

    $mysqli = new mysqli("localhost", "root", "", "laba6");
    $data = $_POST;

    $errLogin = "";
    $errPassword = "";
    $correctData = true;
    if (isset($data['do_login'])) {

        if (mb_strlen(trim($data['login'])) < 3 ) {
            $errLogin = "Минимальная длина 3 символа";
            $correctData = false;
        }

        if ($correctData) {
            $login = trim($data['login']);
            $query = "SELECT login FROM users";
            $users = $mysqli->query($query);
            if ($data['remember'] == "1") {
                $encodedPassword = encode($data['password'], 12345);
                setcookie("$login", "$encodedPassword", time() + (1000*60*60*24*30));
            }
            if (isExistsUser($login, $users)) {
                if (isset($_COOKIE["$login"])) {
                    $password = decode($_COOKIE["$login"], 12345);
                } else $password = $data['password'];
                $userPassword = getPassword($login, $mysqli);
                if (password_verify($password, $userPassword)) {
                    setcookie("loggedUser",  "$login", time() + 3600);
                    echo '<span style="color: green;">Пользователь успешно авторизован!<br>
                    Можете вернуться на <a href="TASKS.php#lab6">главную</a> страницу!</span><hr>';
                } else echo '<span style="color: red;">Неверно введен пароль!</span><hr>';
            } else echo '<span style="color: red;">Пользователь с таким логином не найден!</span><hr>';

        }
}

?>

<form action="login.php" method="POST">

    <strong>Ваш логин: </strong><br>
    <input type="text" name="login" value="<?php echo @$data['login'] ?>">
    <span style="color: red;"><?php echo $errLogin ?></span><br><br>

    <strong>Ваш пароль: </strong><br>
    <input type="password" name="password">
    <span style="color: red;"><?php echo $errPassword ?></span><br><br>

    <span>Запомнить меня</span>
    <input type="checkbox" name="remember" value="1"><br><br>

    <input type="submit" name="do_login" value="Войти"><hr>
</form>