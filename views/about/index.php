<?php
foreach ($this->data as $key => $value) {
	$BGTIME = 60 * 60 * 7;
	$timeLine = $value['abDate'] + $BGTIME;
    echo '<h2>Повече информация за системата</h2>
          <p>
            ' . nl2br($value['abText']) . '
          </p>
          <p class="post-footer align-right">					
            <span class="date">Последно обновено на ' . date("d.m.Y, H:i:s", $timeLine) . '</span>	
          ';
}
if (Session::getSess('userGroup') == 1) {
    echo '<a href="index.php?url=about&method=editAbout"><span>Редактирай</span></a>';
}
echo '</p>';
?>

