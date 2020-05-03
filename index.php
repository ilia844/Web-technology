<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/header+footer.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/main_page.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <title>GymHouse</title>
</head>
<body>
    <header class="header">
        <div class="main-container">
            <div class="top-panel">
                <a class="main_logo_link" href="index.php">
                    <img class="logo_img" src="img/ManAndWomew.png" alt="logo">
                    <h1 class="logo_text">GymHouse</h1>
                </a>
                <input type="checkbox" name="toggle" id="menu" class="toggleMenu">
                <label for="menu" class="toggleMenu"><i class="fa fa-bars"></i></label>
                <ul class="menu">
                    <li class="menu_item"><a href="pages/TASKS.php" class="menu_link normal_page"><i class="fa fa-gift fa-fw"></i>Задания</a></li>
                    <li class="menu_item"><a href="pages/price.php" class="menu_link normal_page"><i class="fa fa-shopping-cart fa-fw"></i>Стоимость</a></li>
                    <li class="menu_item"><a href="pages/staff.php" class="menu_link normal_page"><i class="fa fa-users fa-fw"></i>Тренеры</a></li>
                    <li class="menu_item"><a href="pages/gallery.php" class="menu_link normal_page"><i class="fa fa-camera fa-fw"></i>Галерея</a></li>
                    <li class="menu_item"><a href="pages/company.php" class="menu_link normal_page"><i class="fa fa-info fa-fw"></i>Компания</a></li>
                </ul>
            </div>
        </div>
    </header>
    <section class="stock_preview">
        <div class="stock_preview_button bt-left"></div>
        <div class="main-container">
            <div class="stock_preview_info">
                <h1>Первое занятие - <br><span>бесплатно</span></h1>
                <div class="enter_button">
                    <h2>Заниматься бесплатно</h2>
                    <div class="enter_button_icon"></div>
                </div>
            </div>
        </div>
        <div class="stock_preview_button bt-right"></div>
    </section>
    <section class="advantages">
        <div class="main-container">
                <h1 class="main_advantages_header">Причины присоединиться</h1>
                <div class="main_advantages">
                    <div class="main_advantages_item item-working">
                        <img src="img/time-icon.png" alt="Working-time">
                        <h2>Работаем 24/7</h2>
                        <p>Клуб открыт 24 часа в сутки, приходи в любое время: снимай стресс или просто занимайся в удовольствие.</p>
                    </div>
                    <div class="main_advantages_item item-parking">
                        <img src="img/parking-icon.png" alt="Parking">
                        <h2>Бесплатная парковка</h2>
                        <p>Не знаешь, где оставить машину? Бесплатная парковка ждет тебя, но помни: это все-таки центр города.</p>
                    </div>
                    <div class="main_advantages_item item-trainers">
                        <img src="img/trainer-icon.png" alt="Trainers">
                        <h2>Профессиональные тренажеры</h2>
                        <p>Life Fitness, Teсhnogym, Hammer Strengh, TRX… Не знаешь, что это? Приходи и узнай в наш тренажерный зал!</p>
                    </div>
                    <div class="main_advantages_item item-limitations">
                        <img src="img/limitation-icon.png" alt="Limitations">
                        <h2>Никаких ограничений</h2>
                        <p>Утром разминка, днем штанга, вечером пробежка? Без проблем, посещения не ограничены – приходи сколько хочешь!</p>
                    </div>
                </div>
        </div>
    </section>
    <section class="comments">
        <div class="main-container">
            <h1 class="comment_header">Отзывы наших клиентов</h1>
            <div class="comment_viewer">
                <div class="comments_control bt-left-white"></div>
                <div class="comment">
                    <img src="img/andrew_comment.jpg" alt="Andrew photo">
                    <div class="comment-description">
                        <h2>Андрей</h2>
                        <p>Думаю на данный момент прошло достаточно времени чтобы оставить отзыв о фитнес клубе gym24. В связи с тем, что по образованию и месту работы я менеджер, то мне свойственно обращать внимание на определённые вещи, использовать анализ и сравнение. Не часто пишу отзывы , так как привык, по долгу работы, все подробно и максимально понятно объяснять, а это отнимает время …</p>
                        <span class="button_details">Показать полность</span>
                    </div>
                </div>
                <div class="comments_control bt-right-white"></div>
            </div>
        </div>
    </section>
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
                <img src="img/payments2.png" alt="Pay variants" class="footer_item">
            </div>
        </div>
    </footer>
</body>
</html>