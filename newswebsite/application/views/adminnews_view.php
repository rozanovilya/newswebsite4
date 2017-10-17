<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<h1>Добавить или отредактировать новость</h1>
<p><a href='/admin'>К списку новостей</a></p>
<?php
$actionname = '/adminnews'.$data->NewsId;
//var_dump($_POST);
?>
<form action="<?php $actionname?>" method='post' enctype="multipart/form-data">

<!--   //hard-coded solution
<select>
<option value ="1" <?php //if($_POST['NewsRubricId']==1) echo "selected";?> >Политика</option>
<option value ="2" <?php //if($_POST['NewsRubricId']==2) echo "selected";?> >Общество</option>
<option value ="3" <?php //if($_POST['NewsRubricId']==3) echo "selected";?> >Спорт</option>
</select>
-->
Рубрика<select name="NewsRubricId">
<?php
//var_dump($data);
foreach ($data as $rubric) {
	$optionstring = "<option";
	$value = $rubric->RubricId;
	$optionstring = $optionstring.' value="'.$value.'"';
	if ($_POST['NewsRubricId']==$rubric->RubricId){
		$optionstring = $optionstring." selected";
	}
	$optionstring = $optionstring.">".$rubric->RubricName."</option>";
	echo $optionstring;
}
	//<option value=$rubric->RubricId" <?php if($_POST['NewsRubricId']==$rubric->RubricId) echo "selected";?> > $rubric->RubricName </option>";
}
?>
</select><br>

Заголовок<input type="text" name="SeoH1" value="<?php echo $_POST['SeoH1'] ?>" size="100"><br>
Title<input type="text" name="SeoTitle" value="<?php echo $_POST['SeoTitle']?>" size="100"> <br>
Description<input type="text" name="SeoDescription" value="<?php echo $_POST['SeoDescription']?>" size="100"> <br>
Текст новости<textarea type="text" name="NewsText" rows="20" cols="100" > <?php echo $_POST['NewsText']?> </textarea><br>
Источник <input type="text" name="NewsSource" value="<?php echo $_POST['NewsSource']?>" size="100"> <br>
Фото <input type="file" name="PreviewPhoto" accept="image/jpg" value="<?php echo $_POST['PreviewPhoto']?>">  <br>
Логин <input type="text" name = "username"> <br>
Пароль <input type="password" name = "password"> <br>
<input type="submit" name="Submit">
</form>
</body>
<?php
echo $data2;
//var_dump($_POST);