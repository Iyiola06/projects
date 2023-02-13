<?php 
if(!isset($_SESSION['id'])&&!isset($_SESSION['name'])){
	header("Location:login.php?error=You are not logged in. This page requires a login access");
}
$categories = $conn->prepare("SELECT * FROM category");
$categories->execute();
$category_records = array();

while($category_row=$categories->fetch(PDO::FETCH_BOTH)){
	$category_records[] = $category_row;
}


?>
<div id="menu"><a href="home.php">Home</a>

<?php foreach($category_records as $value):?>

<a href="blog_category.php?category_id=<?=$value['category_id']?>"><?=$value['category_name']?></a>

<?php endforeach;?>

<a href="logout.php">Log out</a></div>
<br />
<?php
//echo "ID: ".$_SESSION['id']."<br>";
//echo "NAME: ".$_SESSION['name'];

?>