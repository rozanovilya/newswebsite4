<?php
foreach ($dataleft as $news) {
	echo "<div class='NewsItemLeft'>";
	$link = '/news/'.$news->NewsId;
	echo "<h4><a href=$link>$news->SeoH1</a></h4>";
	echo "<p>$news->SeoDescription</p>";
	echo "</div>";
}
?>