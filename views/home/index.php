<?php
if(is_array($this->data)) {
	foreach ($this->data as $key => $value) {
		if ($value['noNews'] != 1) {
		
		$this->newsMax = $value['newsMax'];
		$this->output = $value['output'];
		$BGTIME = (60 * 60) * 7;
		
		
		$timeLine = $value['newDate'] + $BGTIME; //25200 = 7h
			echo '<h2>' . $value['newName'] . '</h2>
				  <p>' . nl2br($value['newText']) . '</p>
					<p class="post-footer align-right">					
					<a href="index.php?url=user&method=viewProfile&u='.$value['newAuthor'].'" class="comments">' . $value['newAuthor'] . '</a>
					<span class="date">Обновено в ' . date("d.m.Y, H:i:s", $timeLine) . '</span>';
			if (Session::getSess('userGroup') == 1) {
			
				echo '<a href="index.php?url=home&method=editNew&parameter=' . $value['id'] . '"><span>Редактирай </span></a> / ';
				echo '<a href="index.php?url=home&method=delNew&parameter=' . $value['id'] . '"><span>Изтрий</span></a>';
			}
			echo '</p>';
			
			
		} else {
			return false;
		}
		
	}
		if($this->newsMax > 0) {
			$paging = new Pag(NEWS_PER_PAGE, $this->newsMax);
			echo $paging->output;
		}
	
	
} else {
	?>
		<h2> Няма новини в сайта </h2>
		<p>В сайта все още няма добавени новини, но това ще стане съвсем скоро.</p>
	<?php
}

?>