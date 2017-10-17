<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<ul class='menu'>
<li><a href="/">Главная</a></li>
<?php foreach ($data as $element){
			$rubriclink = '/rubric/'.$element->RubricId;
			echo "<li><a href=$rubriclink>$element->RubricName</a></li>";
		}
?>
<li><a href="/register">Регистрация</a></li>
</ul>
</body>
<?php
//var_dump($data);