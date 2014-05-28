<h2>Редактиране на новина</h2>
<?php
foreach ($this->data as $key => $value) {
    echo '<form action="index.php?url=home&method=editNew&parameter=' . $value['newID'] . '" method="post">
    <p>
        <input type="text" name="newName" value="' . $value['newName'] . '" />
        <textarea name="newText">' . $value['newText'] . '</textarea><br/>
        <input type="submit" class="button" name="edit" value="Редактиране" />
    </p>	
</form>';
}
?>
