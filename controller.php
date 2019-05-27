<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 function magaza() {
    $sql = "SELECT id, name, address, created_at,closed_at FROM store";
    $result =  $GLOBALS['conn']->query($sql);
  echo " <div class='card-body'>
    <div class='table-responsive'>
      <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
        <thead>
          <tr>
            <th> Id </th>
            <th>İsim</th>
            <th>Adres</th>
            <th>Kuruluş Tarihi</th>
            <th>Kapanış Tarihi</th>
          </tr>
        </thead>
        <tbody>
        ";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo    "
        <tr>
          <td> " .$row["id"]. " </td>
          <td>" . $row["name"]. "</td>
          <td>" . $row["address"]. "</td>
          <td>". $row["created_at"]. "</td>
          <td>". $row["closed_at"]. "</td>
        </tr>
      ";
    }
echo "     
</tbody>
</table>
</div>
</div>";
} else {
    echo "Sonuç yok";
}
    //  echo "nasilsin moruk";
 }

 function personel() {
     echo "personel kayıtları burada başkan";
 }

?>