<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<h1>Регистрация нового пользователя</h1>
<form action="/register" method="post"> 
Имя пользователя: <input type="text" name="username"> <br>
Пароль: <input type="password" name="password"> <br>
 <input type="submit" name="Submit" value="Зарегистрироваться">

</form>
<?php
echo $data;
?>
</body>