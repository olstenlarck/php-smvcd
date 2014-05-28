<h2><?= WEBSITE_TITLE; ?></h2>
<form action="index.php?url=user&method=logIn" method="post">
	<p>
		<label>Потребител:</label> <input type="text" name="username" /><br/>
		<label>Парола:</label> <input type="password" name="password" /><br/><br/>
		<input type="submit" class="button" name="login" value="Влез" />
	</p>	
</form>