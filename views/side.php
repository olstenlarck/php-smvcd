<div id="wrap_menu" class="left">
    <div id="menu">
        <ul class="navigation">
            <li>
                <a class="client" href="#"><span class="client">Главно меню</span></a>
                <ul>
                    <?php
                    global $menu;
                    foreach ($menu as $key => $value) {
                        echo '<li><a href="' . $key . '">' . $value . '</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a class="customer" href="#"><span class="customer">Клиентска Зона</span></a>
                <ul>
                    <?php
                    if (Session::getSess('logged') === true) {


                        if (Session::getSess('userGroup') == 1) {
                            echo '<li><a href="index.php?url=home&method=addNew">Добави новина</a></li>';
                        }
                        echo '<li><a href="index.php?url=user&method=changePassword">Смени парола</a></li>';
                        echo '<li><a href="index.php?url=user&method=viewProfile&u=' . Session::getSess('userName') . '">Виж си профила</a></li>';
                        echo '<li><a href="index.php?url=user&method=logOut">Излез</a></li>';
                    } else {
                        echo '<li><a href="index.php?url=user&method=logIn">Вход в системата</a></li>';
                        echo '<li><a href="index.php?url=user&method=regUser">Регистриране</a></li>';
                        echo '<li><a href="index.php?url=user&method=recoverPassword">Смяна на парола</a></li>';
                    }
                    ?>
                </ul>
        </ul>
    </div>
</div><!-- //#wrap_menu -->
<div id="wrap_right" class="left">
