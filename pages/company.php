<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/header+footer.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/company.css">
    <link rel="stylesheet" type="text/css" href="../css/media.css">
    <title>О компании</title>
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
    <section class="company_background">
        <?php include "visitCount.php"; ?>
        <div class="main-container">
            <div class="company-info">
                <h1>GymHouse фитнес-клуб нового поколения</h1>
                <div class="info-block block-1">
                    <div class="text-info">
                        <p>GymHouse – первый автономный тренажерный зал в центре Минска, который предлагает всем желающим тренировки в удобном для них формате за минимальную стоимость.</p>
                        <p>Наша цель – сделать спорт доступным для каждого. Низкие цены – результат правильных управленческих решений и отсутствия ненужных дополнительных услуг, а не экономии на посетителях: тренажеры в зале профессионального уровня и отличного качества (Life Fitness, Technogym, Hummer Strength).</p>
                        <p>Наша философия – самодостаточность и прозрачность. Чтобы купить абонемент, не надо приходить в зал – он приобретается через интернет, а в личном кабинете можно отслеживать оставшееся время, замораживать абонемент и продлевать его: управление полностью в твоих руках.</p>
                        <p>Наш подход к фитнесу – плод использования многолетнего опыта фитнес-клубов Европы, приспособленного к белорусским реалиям. Мы предлагаем больше, чем просто фитнес-клуб – мы предлагаем передовой тренажерный зал с биометрической системой контроля и свободой посещения.</p>
                        <p>Подтягивайся в наш круглосуточный тренажерный зал GymHouse и займись своим телом и здоровьем – сейчас самое время начать!</p>
                    </div>
                    <img src="../img/about%20company/gym24-klub.jpg" alt="Photo">
                </div>
                <div class="info-block block-2">
                    <img src="../img/about%20company/DSC08749-2.jpg" alt="Photo">
                    <div class="text-info">
                        <p>Мы любим спорт, он делает нас сильнее, увереннее, спокойнее. Мы любим спортивных людей и хотим, чтобы их было больше, красивых, привлекательных. Мы верим, что спорт доступен каждому. Поэтому мы создали фитнес-клуб в котором нет ничего лишнего, за что приходится переплачивать.</p>
                        <ul>
                            <li>Более 90 профессиональных тренажеров ( новейшие “Life fitness, Hammer strength, Technogym”)</li>
                            <li>Открыт круглосуточно</li>
                            <li>Биометрическая система обслуживания по отпечатку пальца</li>
                            <li>Бесплатная фильтрованная, кипяченая и охлажденная питьевая вода</li>
                            <li>Без ограничения посещений и времени</li>
                            <li>Продажа абонементов через интернет или терминалы, которые установлены в клубе</li>
                            <li>Возможность cамому приостановить годовой абонемент через свой аккаунт на 30 дней</li>
                            <li>Рядом бесплатный паркинг</li>
                        </ul>
                        <strong>Присоединяйся, пусть твой мир начнет меняться в месте с тобой.</strong>
                    </div>
                </div>
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
                <img src="../img/payments2.png" alt="Pay variants" class="footer_item">
            </div>
        </div>
    </footer>
</body>
</html>