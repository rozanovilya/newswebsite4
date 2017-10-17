<head>
<title><?php echo $data->SeoTitle?></title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<?php
$rubric = $data->oNewsRubric;
$rubricname = $rubric->RubricName;
$rubriclink = "/rubric/".$data->NewsRubric;
//var_dump($rubrilink);
?>

<h1><?php echo $data->SeoH1?></h1>
<?php echo "<p class='NewsRubric'>Другие новости из рубрики: <a href= $rubriclink > $rubricname </a></p>"?> 
<p class='NewsSource'><a href="<?php echo $data->NewsSource?>">Источник</a></p>
<?php
$imagelink="/images/".$data->PreviewPhoto;
?>
<img src="<?php echo $imagelink?>" alt="<?php echo $data->SeoH1?>" class='newsphoto'> <br>
<?php echo $data->NewsText?>
<?php 
$comments = $data->oComments;
$commentsnumber = count($comments);
?>
<!--

<h4>Комментарии (<?php echo $commentsnumber ?>)</h4>
<?php 
foreach ($comments as $comment)
{
	//if ($comment->Moderated) {
		$user = $comment->oCommentAuthor;
		$username = $user->UserName;
		echo "<h5>Автор - $username</h5>";
		echo "<p>$comment->CommentText</p>";
	//}
}
$actionlink = "/news/".$data->NewsId;
?>
<h4>Добавить комментарий</h4>
<form action="<?php $actionlink?>" method="post"> 
Имя пользователя: <input type="text" name="username"> <br>
Пароль: <input type="password" name="password"> <br>
Комментарий: <textarea rows="10" cols="45" name="commenttext"></textarea>
 <input type="submit" name="Submit">

</form>
-->
<?php
echo $data2;