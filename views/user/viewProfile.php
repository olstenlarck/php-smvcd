
<?php
if(is_array($this->profileView)) {

	foreach ($this->profileView as $k => $profile) {
		if($profile['exist'] == 1 && $profile['profileName'] == $profile['userName']) {
			?>
			<h2> Преглеждане на потребител: <?php echo $profile['userName']; ?></h2>
			<div id="userTable">
				<div class="memberRow">
					<a href="index.php?url=user&method=viewProfile&u=<?= $v['userName']; ?>" title="<?= $v['userName']; ?> - преглед на профила">
					<div class="userName"><?php echo $profile['userName']; ?></div>
					</a>
					<div class="userEmail"><?php echo $profile['userEmail']; ?></div>
					<div class="userRegDate"><?php echo date("d.m.Y, h:i:s", $profile['userRegDate']); ?></div>
					<div class="userIP"><?php echo $profile['userIP']; ?></div>
					<div class="userGroup">
					<?	
						if ($profile['userGroup'] == 1) {
							?>
							<a href="#">Админ</a>
							<?php
						} else {
							echo 'Потребител';
						}
					?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			<?php
		} else {
			return false;
		}
	}
} else {
	?>
		<h2> Такъв потребител не съществува! </h2>
		<p>Явно има грешка. Може да видите <a href="index.php?url=user&method=membersList" title="потребители в <?php echo SITE_NAME; ?>">списък на потребителите в сайта</a>.</p>
			
	<?php
}


?>