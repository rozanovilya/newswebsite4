<?php
require_once("/../classes/class.PaginationLinks.php");
?>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<h1 class="mainh1">Главные новости</h1>
<?php
foreach ($data as $news) {
	echo "<div class='NewsItem'>";
	$link = '/news/'.$news->NewsId;
	echo "<h2><a href=$link>$news->SeoH1</a></h2>";
	echo "<p>$news->SeoDescription</p>";
	$imagelink="/images/".$news->PreviewPhoto;
	?>
	<img class="newsphoto" src="<?php echo $imagelink?>" alt="<?php echo $news->SeoH1?>"'>;
	<?php
	echo "</div>";
}
?>
<div class='pagination'>
<?php
echo PaginationLinks::create($data3,$data4);
?>
</div>
</body>