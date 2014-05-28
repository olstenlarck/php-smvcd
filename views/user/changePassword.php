<h2>Смяна на парола</h2>
<form action="index.php?url=user&method=changePassword" method="post">
	<p>
		<label>Сегашна Парола:</label> <input type="password" name="oldpassword" /><br/>
		<label>Нова Парола:</label> <input type="text" name="password" /><br/>
		<label>Повтори парола:</label> <input type="password" name="repassword" /><br/><br/>
		<input type="submit" class="button" name="changePassword" value="Смяна" />
	<p>
</form>