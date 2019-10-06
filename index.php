<?php


$connect = mysqli_connect("localhost", "root", "", "search") or die("Error");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Test</title>
</head>
<body>
<form method="post">
	<input type="text" name="search" class="search"><input type="submit" name="submit" value="Поиск">
</form>
<hr>
<?php
	if(isset($_POST['submit'])){
		$search = explode(" ", $_POST['search']);
		$count = count($search);
		$array = array();
		$i = 0;
		foreach ($search as $key) {
			$i++;
			if($i < $count) $array[] = "CONCAT ('title', 'text') LIKE '%".$key."%' OR"; else $array[] = "CONCAT ('title', 'text')LIKE '%".$key."%'";
		}
		$sql = "SELECT * FROM 'test' WHERE ".implode("", $array);
		echo $sql;
		$query = mysqli_query($connect, $sql);
		while($row = mysqli_fetch_assoc($query)) echo "<h1>".$row['title']."</h1><p>".$row['text']."</p><br>";
	}
?>
</body>
</html>