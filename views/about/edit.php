<h2>Редактиране на "За мен"</h2>
<?php
foreach ($this->data as $key => $value) {
    echo '<form action="index.php?url=about&method=editAbout" method="post">
    <p>
        <textarea name="abText">' . $value['abText'] . '</textarea><br/>
        <input type="submit" class="button" name="edit" value="Редактиране" />
    </p>	
</form>';
}
?>
