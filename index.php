<html>
<link rel="stylesheet" href="material.indigo-pink.min.css">
<script defer src="material.min.js"></script>
<head>
	<title>JSearch</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table>
	<td>
		<form  action="index.php"  method="get">
		<input  class="textbox" type="text" placeholder="Search Word" name="word"><br>
		<input type="submit"class="button" value="SEARCH">
		</form>
	</td>
</table>
<table>
  <thead>
    <tr>
      <th colspan="10">Dictionary</th>
    </tr>
    <tr>
      <th colspan="1">#</th>
      <th colspan="1">Word</th>
      <th colspan="4">Type</th>
      <th colspan="4">Definition</th>
     </tr>
    
<?php
function myfunction($searchkey){
$conn = new mysqli('localhost', 'root', 'abc','jsearch');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM entries WHERE MATCH (word) AGAINST ('".$searchkey."' IN NATURAL LANGUAGE MODE)";
//$sql="SELECT * FROM songs";
$result = $conn->query($sql);
//echo $result;

$count=1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    //echo $row['id']."   song name -".$row['loc']."<br>";
     $name_list = explode("/", $row['definition']);
   // echo $name_list[sizeof($name_list)-1];
       $exact_name = explode(".mp3", $name_list[sizeof($name_list)-1]);
   // echo $name_list[sizeof($name_list)-1];
   //href='http://$_SERVER[HTTP_HOST]".$row['loc']."'
    echo "<tr><td>".$count."</td>";
    echo "<td>".$row['word']."</td>";
    echo "<td>".$row['wordtype']."</td>";
    echo "<td>".$row['definition']."</td></tr>";
    $count++;
    }
} else {
   // echo "0 results";
}

$conn->close();
}
$name = $_GET["word"];
if(!empty(trim($name))&&(trim($name)!=".mp3")&&(trim($name)!="mp3")){
	myfunction($name);
}

?>

       <td>
      </td>
    </tr>
  </thead>
  <tbody>
</tbody>
</table>
</body>
</html>
