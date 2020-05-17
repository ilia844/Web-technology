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
                    function setDateFormat($fieldName)
                    {
                        $time = strtotime($_POST[$fieldName]);
                        if ($time) {
                            return date('Y-m-d', $time);
                        } else return false;
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

                    function findFiles($dir, $name, $maxDate, $minDate)
                    {
                        $allFiles = scandir($dir);
                        $directory = new \RecursiveDirectoryIterator($dir);
                        $filter = new \RecursiveCallbackFilterIterator($directory, function ($current, $key, $iterator) {
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
                        $findedFiles = array();
                        $iterator = new \RecursiveIteratorIterator($filter);
                        foreach ($iterator as $info) {
                            $findedFiles[] = $info->getPathname();
                        }
                        print_r($findedFiles);
                        return $findedFiles;
                    }

                    $name = '';
                    $maxDate = '';
                    $minDate = '';

                    $errorField = '';
                    $errorVerdict = '';
                    $errorDir = '';
                    $errorDataFrom = '';
                    $errorDataTo = '';
                    $errorName = '';

                    $error = false;
                    if (isset($_POST['search'])) {
                        if ((!isset($_POST['dir'])) || $_POST['dir'] == '') {
                            $errorDir = 'Обязательное поле!';
                            $error = true;
                        } elseif (!file_exists($_POST['dir'])) {
                            $errorDir = 'Каталог не найден';
                            $error = true;
                        }
                        $info = getDateInterval();
                        if (!$info) {
                            $errorDataFrom = 'Некорректный формат даты!';
                            $error = true;
                        } else
                        {
                            if ($info['dateFrom'] > $info['dateTo']) {
                                $errorDataFrom = 'Не может быть больше верхней границы!';
                                $error = true;
                            }
                        }
                        if (!isset($_POST['name']) || $_POST['name'] == '') {
                            $errorName = 'Обязательное поле!';
                            $error = true;
                        }
                        if (!$error) {
                            $minDate = $info['dateFrom'];
                            $maxDate = $info['dateTo'];
                            $name = $_POST['name'];
                            echo '<div id="lab3_solution" class="task_solution">';
                            $files = findFiles($_POST['dir'], $name, $maxDate, $minDate);
                            if ($files) {
                                echo '<ul style="list-style: none; font-size: 25px;">';
                                for ($i = 0; $i < count($files); $i++) {
                                    echo '<li>', $files[$i], '</li>';
                                }
                                echo '</ul>';
                            }
                            echo '</div>';
                        }
                    }
                ?>
                <div id="lab3_form">
                    <?php
                        function createField($text, $fieldType, $fieldName, $errorText){
                            echo $text,'<input type = "',$fieldType,'" name = "', $fieldName, '" value = "', $_POST[$fieldName], '"><br>';
                            echo '<div style = "color:red">',$errorText,"</div>";
                            echo '<br>';
                        }
                    ?>
                    <form action="TASKS.php#lab3" method="POST" class="lab-form">
                        <?php
                        createField('Каталог для поиска:       ', 'text', 'dir', $errorDir);
                        createField('Начальная дата создания:  ', 'date', 'dateFrom', $errorDataFrom);
                        createField('Конечная дата создания:   ', 'date', 'dateTo', $errorDataTo);
                        createField('Часть имени файла:        ', 'text', 'name', $errorName);
                        ?>

                        <input type="submit" name="search" value="Поиск файла!">
                    </form>
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