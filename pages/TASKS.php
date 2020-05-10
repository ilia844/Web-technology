<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/header+footer.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/TASKS.css">
    <title>Акции</title>
</head>
<body>
    <header class="header">
        <div class="main-container">
            <div class="top-panel">
                <a class="main_logo_link" href="../index.php">
                    <img class="logo_img" src="../img/ManAndWomew.png" alt="logo">
                    <h1 class="logo_text">GymHouse</h1>
                </a>
                <input type="checkbox" name="toggle" id="menu" class="toggleMenu">
                <label for="menu" class="toggleMenu"><i class="fa fa-bars"></i></label>
                <ul class="menu">
                    <?php include "navigation.php"; ?>
                </ul>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="main-container">
            <section id="lab2" class="lab-section">
                <h1>Лабораторная работа №2</h1>
                <p class="task_paragraph">
                    Вариант 6: Объявить пятимерный массив с целыми числами (не менее 20-ти элементов),
                    вывести массив на экран таким образом, чтобы элементы первого уровня отображались красным цветов,
                    второго – синим, третьего – зелёным, четвёртого – фиолетовым, пятого – жёлтым.
                    После этого произвести сортировку элементов, где четные числа будут отображаться красным, нечетные фиолетовым,
                    нулевые значения отображаться не будут. Данные в исходный массив вводить через поля ввода веб-формы в виде строк,
                    где данные разделены запятыми.
                </p>
                <form action="TASKS.php#lab2" method="POST" class="lab-form">
                    Элементы 1-го уровня: <input type="text" name="lvl1"><br><br>
                    Элементы 2-го уровня: <input type="text" name="lvl2"><br><br>
                    Элементы 3-го уровня: <input type="text" name="lvl3"><br><br>
                    Элементы 4-го уровня: <input type="text" name="lvl4"><br><br>
                    Элементы 5-го уровня: <input type="text" name="lvl5"><br><br>
                    <input name="sort_array" class="form-button" type="submit" value="Выполнить">
                </form>

                <?php
                    function getArray($str, &$array)
                    {
                        foreach (explode(",", $str) as $item) {
                            $array[] = (int)$item;
                        }
                    }

                    $colors = array('#ff0000', '#0000ff', '#00ff00', '#9900ff', '#fcd706');
                    function coloraizeArr(&$array, $currentLevel)
                    {
                        global $colors;
                        foreach ($array as $item) {
                            if (is_array($item)) {
                                coloraizeArr($item, $currentLevel + 1);
                            } else {
                                echo '<span style = "color:', $colors[$currentLevel], '; font-size: 20px;">', $item, ' | ', '</span>';
                            }
                        }
                    }

                    function sortArray($array)
                    {
                        $sortedArr = array();
                        foreach ($array as $item) {
                            if (is_array($item)) {
                                $child = sortArray($item);
                                $sortedArr = $child;
                            } else {
                                $sortedArr[] = $item;
                            }
                        }
                        asort($sortedArr, SORT_NUMERIC);
                        return $sortedArr;
                    }

                    if (isset($_POST['sort_array'])) {
                        echo '<div class="task_solution">';

                        $inArr = array(array(array(array(array()))));
                        if (isset($_POST['lvl1'])) getArray($_POST['lvl1'], $inArr);
                        if (isset($_POST['lvl2'])) getArray($_POST['lvl2'], $inArr[0]);
                        if (isset($_POST['lvl3'])) getArray($_POST['lvl3'], $inArr[0][0]);
                        if (isset($_POST['lvl4'])) getArray($_POST['lvl4'], $inArr[0][0][0]);
                        if (isset($_POST['lvl5'])) getArray($_POST['lvl5'], $inArr[0][0][0][0]);
                        if (count($inArr, COUNT_RECURSIVE) > 20) {
                            coloraizeArr($inArr, 0);
                            echo '<br>', 'Отсортированный массив:', '<br/>';
                            foreach (sortArray($inArr) as $item) {
                                if ($item != 0) {
                                    echo '<span style = "color: ', (($item % 2) == 1) ? '#9900ff' : '#ff0000', '; font-size: 20px;">', $item, ' | ', '</span>';
                                }
                            }
                        } else echo 'Общее количество элементов должно быть не менее 20';

                        echo '</div>';
                    }
                ?>
            </section>

            <section id="lab3" class="lab-section">
                <h1>Лабораторная работа №3</h1>
                <p class="task_paragraph">
                    Вариант 6: написать функцию, формирующую список файлов в указанном каталоге (включая подкаталоги),
                    время создания которых лежит в указанном диапазоне, а имя содержит указанное сочетание символов.
                    Данные для поиска получать через веб-форму.
                </p>
                <?php
                    $name = '';
                    $maxDate = '';
                    $minDate = '';
                    $findedFiles = array();

                    function setDateFormat($fieldName)
                    {
                        global $errorField;
                        global $errorVerdict;
                        $time = strtotime($_POST[$fieldName]);
                        if ($time) {
                            return date('Y-m-d', $time);
                        } else {
                            $errorField = $fieldName;
                            $errorVerdict = 'Некорректный формат даты!';
                            return false;
                        }
                    }

                    function getDateInterval()
                    {
                        $data = array();
                        if ($data['dateFrom'] = setDateFormat('dateFrom')) {
                            if ($data['dateTo'] = setDateFormat('dateTo')) {
                                return $data;
                            }
                        }
                        return false;
                    }

                    function findFiles($dir)
                    {
                        global $errorField;
                        global $errorVerdict;
                        if (!file_exists($dir)) {
                            $errorField = 'dir';
                            $errorVerdict = 'Каталог не найден';
                            return false;
                        }
                        $allFiles = scandir($dir);
                        $directory = new \RecursiveDirectoryIterator($dir);
                        $filter = new \RecursiveCallbackFilterIterator($directory, function ($current, $key, $iterator) {
                            global $name;
                            global $maxDate;
                            global $minDate;
                            if ($current->getFilename()[0] === '.') {
                                return FALSE;
                            }
                            if (date('Y-m-d', $current->getCTime()) > $maxDate) {
                                return FALSE;
                            }
                            if (date('Y-m-d', $current->getCTime()) < $minDate) {
                                return FALSE;
                            }
                            return is_int(strpos($current->getFilename(), $name));
                        });
                        global $findedFiles;
                        $iterator = new \RecursiveIteratorIterator($filter);
                        foreach ($iterator as $info) {
                            $findedFiles[] = $info->getPathname();
                        }
                        return true;
                    }

                    function main()
                    {
                        global $errorField;
                        global $errorVerdict;
                        if ((!isset($_POST['dir'])) || $_POST['dir'] == '') {
                            $errorField = 'dir';
                            $errorVerdict = 'Обязательное поле!';
                            return false;
                        }
                        $info = getDateInterval();
                        if (!$info) {
                            return false;
                        }
                        if ($info['dateFrom'] > $info['dateTo']) {
                            $errorField = 'dateFrom';
                            $errorVerdict = 'Не может быть больше верхней границы!';
                            return false;
                        }
                        if (!isset($_POST['name']) || $_POST['name'] == '') {
                            $errorField = 'name';
                            $errorVerdict = 'Обязательное поле!';
                            return false;
                        }
                        global $name;
                        global $minDate;
                        global $maxDate;
                        $minDate = $info['dateFrom'];
                        $maxDate = $info['dateTo'];
                        $name = $_POST['name'];
                        $files = findFiles($_POST['dir']);
                        return $files;
                    }

                    main();
                ?>
                <div id="lab3_form">
                    <?php
                        function createField($text, $fieldType, $fieldName){
                            global $errorField;
                            global $errorVerdict;
                            if(isset($errorField)){
                                echo $text,'<input type = "',$fieldType,'" name = "', $fieldName, '" value = "', $_POST[$fieldName], '"><br>';
                                if($errorField == $fieldName){
                                    echo '<div style = "color:red">',$errorVerdict,"</div>";
                                }
                            }else{
                                echo $text,'<input type = "',$fieldType,'" name = "', $fieldName, '" value = ""><br>';
                            }
                            echo '<br>';
                        }
                    ?>
                    <form action="TASKS.php#lab3" method="POST" class="lab-form">
                        <?php
                        createField('Каталог для поиска:       ', 'text', 'dir');
                        createField('Начальная дата создания:  ', 'date', 'dateFrom');
                        createField('Конечная дата создания:   ', 'date', 'dateTo');
                        createField('Часть имени файла:        ', 'text', 'name');
                        ?>

                        <input type="submit" name="search" value="Поиск файла!">
                    </form>
                </div>
                <div id="lab3_solution" class="task_solution">
                    <?php
                        global $findedFiles;
                        echo '<ul style="list-style: none; font-size: 25px;">';
                        for ($i = 0; $i < count($findedFiles); $i++) {
                            echo '<li>', $findedFiles[$i], '</li>';
                        }
                        echo '</ul>';
                    ?>
                </div>
            </section>

            <section id="lab4" class="lab-section">
                <h1>Лабораторная работа №4</h1>
                <p class="task_paragraph">
                    Вариант 6: в произвольном тексте все e-mail адреса вывести красным цветом и привести к виду
                    ссылки с параметром href равным "mailto:EMAIL". Дополнительно, в отдельном блоке вывести отдельно все e-mail адреса.
                    Текст загружать из файла.
                </p>
                <form action="TASKS.php#lab4" method="POST" enctype='multipart/form-data' class="lab-form">
                    Выберите файл: <input type="file" name="fileName"><br><br>
                    <input type='submit' value='Загрузить'>
                </form>
                <div class="task_solution">
                    <?php

                        if ($_FILES && $_FILES['fileName']['error']== UPLOAD_ERR_OK)
                        {
                            $uploads_dir = 'Y:/Programs/Web-server/bin/php/upload';
                            $name = basename($_FILES['fileName']['name']);
                            $tmp_name = $_FILES['fileName']['tmp_name'];
                            move_uploaded_file($tmp_name, "$uploads_dir/$name");
                            echo "Файл загружен<br><br>";

                            $strFileInfo = file_get_contents("$uploads_dir/$name");
                            unlink("$uploads_dir/$name");

                            $regEx = '/\b[a-zA-Z0-9_+\-.]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}\b/';
                            $allEmails = array();
                            preg_match_all($regEx, $strFileInfo, $allEmails);
                            foreach ($allEmails[0] as $email) {
                                $strFileInfo = str_replace($email, '<a href="mailto: ' . $email . '" style = "color: red;">' . $email . '</a>', $strFileInfo);
                            }
                            echo '<div>' . $strFileInfo . '</div>' . '<br><br>';
                            echo '<div style="border-radius:10px; border: black solid 1px; width: 50%; padding: 5px;">';
                            foreach ($allEmails[0] as $email) {
                                echo $email . '<br>';
                            }
                            echo '</div>';
                        }elseif ($__FILES) {
                            echo 'Ошибка: ' . $_FILES['fileName']['error'];
                        } else echo 'Файл не загружен!';

                    ?>
                </div>
            </section>

            <section id="lab5" class="lab-section">
                <h1>Лабораторная работа №5</h1>
                <p class="task_paragraph">
                    Вариант 6: написать скрипт, получающий через форму e-mail пользователя,
                    проверяющий его корректность и добавляющий его в таблицу БД в случае,
                    если такого e-mail там ещё нет.
                </p><br>
                <form action="TASKS.php#lab5" method="POST" enctype='multipart/form-data' class="lab-form">
                    Ваши иницыалы: <input type="text" name="userName"><br><br>
                    Ваш email: <input type="text" name="userEmail"><br><br>
                    Ваш сотовый номер: <input type="text" name="userContactNumber"><br><br>
                    <input type='submit' name='add_owner' value='Занести данные в БД'>
                </form>
                <div class="task_solution">
                    <?php
                        function isCorrectEmail($strEmail) {
                            $regEx = '/^[a-zA-Z0-9_+\-.]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
                            if (preg_match($regEx, $strEmail)) {
                                return true;
                            } else return false;
                        }

                        function isExistsEmail($objResult, $email) {
                            $result = false;
                            $objResult->data_seek(0);
                            $i = 0;
                            while ($row = $objResult->fetch_assoc()) {
                                if (strcmp($row['email'], $email) == 0) {
                                    //echo "email[" . $i++ . "] = " . $row['email'] . " - Уже существует в базе!<br>";
                                    $result = true;
                                }//else echo "email[" . $i++ . "] = " . $row['email'] . "<br>";
                            }
                            return $result;
                        }

                        if (isset($_POST['add_owner'])) {
                            if (($_POST['userName'] != "")  && ($_POST['userEmail'] != "") && ($_POST['userContactNumber'] != "")) {
                                $userName = $_POST['userName'];
                                echo '<span style="color: green;">Инициалы: ', $userName, ";</span>";
                                $userEmail = $_POST['userEmail'];
                                echo '<span style="color: green;">EMAIL: ', $userEmail, ';</span>';
                                $userContactNumber = $_POST['userContactNumber'];
                                echo '<span style="color: green;">Телефон: ', $userContactNumber, ';</span><br>';

                                if (isCorrectEmail($userEmail)) {
                                    echo 'EMAIL введен корректно!<br><br>';
                                    $mysqli = new mysqli("localhost", "root", "", "my_first_db");
                                    if ($mysqli->connect_errno) {
                                        echo "Не удалось подключится к MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
                                    } else {
                                        $res = $mysqli->query("SELECT email FROM owners");
                                        if (!isExistsEmail($res, $userEmail)) {
                                            $query = "INSERT INTO owners VALUES(NULL, '$userName', '$userEmail', '$userContactNumber')";
                                            $mysqli->query($query);
                                            if ($mysqli->errno) {
                                                echo "Не удалось занести данные в таблицу: (" . $mysqli->errno . ")" . $mysqli->error;
                                            }
                                            //Вывод таблицы
                                            $res = $mysqli->query("SELECT * FROM owners");
                                            $res->data_seek(0);
                                            echo '<div>';
                                            while ($row = $res->fetch_assoc()) {
                                                echo $row['name'] . " | " . $row['email'] . " | " . $row['contact_number'] . "<br>";
                                            }
                                            echo '</div>';
                                        } else echo 'EMAIL уже присутствует в таблице!';
                                    }
                                } else echo '<span style="color: red;">Введен некорректный EMAIL!</span>';
                            } else echo '<span style="color: red;">Одно из полей не задано!</span>';
                        }
                    ?>
                </div>
            </section>

            <section id="lab6" class="lab-section">
                <h1>Лабораторная работа 6</h1>
                <p class="task_paragraph">
                    Вариант 6: написать скрипт, выполняющий авторизацию пользователя на сайте с возможностью долговременной авторизации
                    через куки (функция "запомнить меня"). Используйте bcrypt/argon2 - для хеширования password и желательно еще дополнительную защиту пароля,
                    учитывая нюансы хранения паролей в куки. Проверьте наличие минимального количества символов в логине (например, 2),
                    пароле (например, 5), корректность символов. При успешной регистрации должно появляться приветствие "Здравствуйте, login".
                    Реализуйте функцию выхода с возвратом к форме регистрации.
                </p><br>
                <div class="task_solution">
                    <?php if (isset($_COOKIE['loggedUser'])) : ?>
                        Авторизован!<br>
                        Привет, <?php echo $_COOKIE['loggedUser']; ?>
                        <a href="logout.php">Выйти</a>
                    <?php else : ?>
                        <a href="login.php">Авторизация</a>
                        <a href="signup.php">Регистрация</a>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="main-container">
            <div class="footer">
                <div class="footer_item footer_info addresses">
                    <h2>Адреса</h2>
                    <span>Пр. Победителей 7А, 3 этаж, м. Немига, Минск</span>
                    <span>Машерова 76А, Минск</span>
                </div>
                <div class="footer_item footer_info contacts">
                    <h2>Контакты</h2>
                    <span>Тел: +375(29)533-26-60</span>
                    <span>Email: gymhouse@mail.ru</span>
                </div>
                <img src="../img/payments2.png" alt="Pay variants" class="footer_item">
            </div>
        </div>
    </footer>
</body>
</html>