<?php
require_once("/../classes/class.PaginationLinks.php");
?>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<h1>Редактировать или добавить новость</h1>
<?php

foreach ($data as $news) {
	$link = '/adminnews/'.$news->NewsId;
	echo "<h2><a href=$link>$news->SeoH1</a></h2>";
}
echo "<h2><a href='/adminnews'>Добавить новость</a></h2>"; 
echo PaginationLinks::create($data3,$data4);
?>
</body>


