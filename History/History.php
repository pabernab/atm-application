<?php

$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
$serverUserName = 'butteadmin';
$serverPassword = 'buttecmpe131';
$dbname = 'registration';


//create connection
$conn = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);


//check connection
if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}

//counts number of rows
$sql1 = "SELECT COUNT(*) filePath FROM checkDeposit where userName = 'AllenB'";
$results1 = mysqli_query($conn,$sql1);
$max = mysqli_fetch_assoc($results1);
//puts results into an array
$sql = "SELECT filePath,typess,amount FROM checkDeposit where userName = 'AllenB'";
$results = mysqli_query($conn,$sql);
$rows = array();

while($row = mysqli_fetch_assoc($results))
{
  $rows[] = $row;
}

?>


<html>
<head>
<style>

table, td
{
  border: 1px solid black;
}

</style>
</head>
<body>

<!-- Sets up table -->
<center>
<table id="myTable">
  <tr>
    <td>Name</td>
    <td>Number</td>
    <td>Type</td>
    <td>amount</td>
  </tr>
</table>
</center>
<br>



</body>
</html>




<script type = 'text/javascript'>

var rows = <?php echo json_encode($rows); ?>;
alert(rows[0]['filePath']);


var counter = 0;
var max = "<?php echo $max["filePath"]; ?>";

while(parseInt(max) > counter)
{

  var table = document.getElementById("myTable");
  var row = table.insertRow(1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  cell1.innerHTML = "AllenB";
  cell2.innerHTML = rows[counter]['filePath'];
  cell3.innerHTML = rows[counter]['typess'];
  cell4.innerHTML = '$ ' + rows[counter]['amount'];

  counter = counter + 1;
}

</script>
