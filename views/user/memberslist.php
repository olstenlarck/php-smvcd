<h2>Последни 15 потребителя</h2>
<div id="userTable">
    <?php
    foreach ($this->usersData as $k => $v) {
        if($v['noMembers'] != 1) {
        ?>
        <div class="memberRow">
            <a href="index.php?url=user&method=viewProfile&u=<?= $v['userName']; ?>" title="<?= $v['userName']; ?> - преглед на профила">
                <div class="userName"><?php echo $v['userName']; ?></div>
            </a>
            <div class="userEmail"><?php echo $v['userEmail']; ?></div>
            <div class="userRegDate"><?php echo date("d.m.Y, h:i:s", $v['userRegDate']); ?></div>
            <div class="userIP"><?php echo $v['userIP']; ?></div>
            <div class="userGroup">
                <?php
                if ($v['userGroup'] == 1) {
                ?>
                <a href="#">Админ</a>
                <?php
                } else {
                echo 'Потребител';
                }
                ?>
            </div>
            <div style="clear: both;"></div>
        </div>

        <?php
        } else {
            echo 'Няма потребители';
        }
    }
    ?>
</div>
