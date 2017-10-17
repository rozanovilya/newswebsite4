<!DOCTYPE>
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 3.0 License

Name       : Accumen
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120712

Modified by VitalySwipe
-->
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>News team</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>

	</head>
<?php 

function CBR_XML_Daily_Ru() {
    $json_daily_file = __DIR__.'/daily.json';
    if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
        if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
            file_put_contents($json_daily_file, $json_daily);
        }
    }

    return json_decode(file_get_contents($json_daily_file));
}

$valutes = CBR_XML_Daily_Ru();
?>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<a href="/">News</span> <span class="cms">team</span></a>
					 <span id="info">Сегодня <?php echo date("d-m-Y H:i:s")?> Курс доллара <?php echo $valutes->Valute->USD->Value ?> Курс евро <?php echo $valutes->Valute->EUR->Value ?>
					 </span>	
				</div>
				<div id="menu">
					<ul>
						<li class="first active"><a href="/">Главная</a></li>
						<li><a href="/rubric/1">Политика</a></li>
						<li><a href="/rubric/2">Общество</a></li>
						<li><a href="/rubric/3">Спорт</a></li>
						<!--<li class="last"><a href="/register">Регистрация</a></li>-->
					</ul>
					<br class="clearfix" />
				</div>
			</div>
			<div id="page">
				<div id="sidebar">

					<div class="side-box">
						<h3>Рубрики</h3>
						<ul class="list">
						<li class="first active"><a href="/">Главная</a></li>
						<li><a href="/rubric/1">Политика</a></li>
						<li><a href="/rubric/2">Общество</a></li>
						<li><a href="/rubric/3">Спорт</a></li>
						<!--<li class="last"><a href="/register">Регистрация</a></li>-->
						</ul>
					</div>
					<div class="side-box">
						<h3>Последнее:</h3>
						<?php //include 'application/views/leftnews_view.php'; ?>
						<?php
						foreach ($dataleft as $news) {
						echo "<div class='NewsItemLeft'>";
						$link = '/news/'.$news->NewsId;
						echo "<h4><a href=$link>$news->SeoH1</a></h4>";
						echo "<p>$news->SeoDescription</p>";
						echo "</div>";
					}
					?>
<a href="https://clck.yandex.ru/redir/dtype=stred/pid=7/cid=1228/*https://yandex.ru/pogoda/12" target="_blank"><img src="https://info.weather.yandex.net/12/1_white.ru.png?domain=ru" border="0" alt="Яндекс.Погода"/><img width="1" height="1" src="https://clck.yandex.ru/click/dtype=stred/pid=7/cid=1227/*https://img.yandex.ru/i/pix.gif" alt="" border="0"/></a>
					
					</div>	
				</div>
				<div id="content">
					<div class="box">
					<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
<!--
		<div id="footer">
			<a href="/">News team</a> &copy; <?php echo date("Y");?> </a>
		</div> -->
	</body>
</html>