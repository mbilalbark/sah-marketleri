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
    $sql = "SELECT id, title, address, created_at,closed_at FROM store";
    $result =  $GLOBALS['conn']->query($sql);
    echo "
    <div class='my-2'></div>
    <a href='index.php?metot=yeni-magaza-index' class='btn btn-success btn-icon-split'>
    <span class='icon text-white-50'>
    <i class='fas fa-plus-square'></i>
    </span>
    <span class='text'>Yeni Mağaza</span>
  </a>";
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
          <td>" . $row["title"]. "</td>
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

 function yeniMagazaIndex() {
   echo "
    <h2> Yeni Mağaza Ekleme Formu </h2> 
   <form class='user' action='index.php' method='post'>
   <div class='form-group'>
     <input type='Text' class='form-control form-control-user' id='exampleInputEmail' name='name' aria-describedby='emailHelp' placeholder='Magaza ismi'>
   </div>
   <div class='form-group'> 
     <input type='Text' class='form-control form-control-user' id='exampleInputEmail' name='address' aria-describedby='emailHelp' placeholder='Adres'>
  </div>
   <input  type='submit' name='yeniMagaza' value='Ekle' class='btn btn-primary btn-user btn-block'/ >
   <hr>
 </form>";
 }
function yeniMagaza($name1, $address) {
  $dateNow = date('Y/m/d');
  $sql = "INSERT INTO store (title, address, created_at) VALUES ('$name1', '$address', '$dateNow' )";

if ($GLOBALS['conn']->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" .$GLOBALS['conn']->error;
}
}
?>