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
  echo "<p> Yeni mağaza başarı ile eklenmiştir.</p>";
  magaza();
 
} else {
  echo "Error: " . $sql . "<br>" .$GLOBALS['conn']->error;
}
}

function personelList() {
  $sql = "SELECT s.id, s.name_surname, s.register_number, s.education_level, s.salary, st.title as store_title, d.title as durty_title
  FROM staffs s 
  JOIN store st ON s.store_id = st.id 
  JOIN duty d ON d.id = s.duty_id";
  $result =  $GLOBALS['conn']->query($sql);
  echo "
  <div class='my-2'></div>
  <a href='index.php?metot=yeni-calisan-index' class='btn btn-success btn-icon-split'>
  <span class='icon text-white-50'>
  <i class='fas fa-plus-square'></i>
  </span>
  <span class='text'>Yeni Çalışan</span>
</a>";
echo " <div class='card-body'>
  <div class='table-responsive'>
    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
      <thead>
        <tr>
          <th> Id </th>
          <th>Sicil No</th>
          <th>İsim</th>
          <th>Eğitim Seviyesi</th>
          <th>Çalıştığı Mağaza</th>
          <th>Çalıştığı Birim</th>
          <th>Maaşı</th>
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
        <td>" . $row["name_surname"]. "</td>
        <td> " .$row["register_number"]. " </td>
        <td>" . $row["education_level"]. "</td>
        <td>" . $row["store_title"]. "</td>
        <td> " .$row["durty_title"]. " </td>
        <td> " .$row["salary"]. " </td>
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
}
function yeniPersonelIndex() {
  $stores =""; 
  $dutys ="";
  $sqlStore  ="SELECT id, title  FROM store";
  $result =  $GLOBALS['conn']->query($sqlStore);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $stores .= "<option value='".$row['id']."'>".$row['title']."</option>";
    }
    }
    $sqlDuty ="SELECT id, title  FROM duty";
    $result = $GLOBALS['conn']->query($sqlDuty);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $dutys .= "<option value='".$row['id']."'>".$row['title']."</option>";
      }
    }
  echo "
  <h2> Yeni Personel Ekleme Formu </h2> 
 <form class='user' action='index.php' method='post'>
 <div class='form-group'>
   <input type='Text' class='form-control form-control-user' id='exampleInputEmail' name='name_surname' aria-describedby='emailHelp' placeholder='İsim Soyisim'>
 </div>
 <div class='form-group'> 
   <input type='Number' class='form-control form-control-user' id='exampleInputEmail' name='salary'  placeholder='Maaş'>
</div>
<div class='form-group'> 
<select name='education_level' aria-controls='dataTable' class='custom-select custom-select-sm form-control form-control-sm'>
  <option value='ilk okul'>ilk okul</option>
  <option value='lise'>lise</option>
  <option value='lisans'>lisans</option>
  <option value='master'>master</option>
</select>
</div>
<div class='form-group'>
Mağazalar
<select name='store_id' aria-controls='dataTable' class='custom-select custom-select-sm form-control form-control-sm'>"
.$stores.
"</select>
</div>
<div class='form-group'>
Görevler
<select name='duty_id' aria-controls='dataTable' class='custom-select custom-select-sm form-control form-control-sm'>"
.$dutys.
"</select>
</div>
 <input  type='submit' name='yeniPersonel' value='Ekle' class='btn btn-primary btn-user btn-block'/ >
 <hr>
</form>";
}

function yeniPersonel($name, $salary, $storeId, $dutyId, $edu) {
  $dateNow = date('Y/m/d');
  $register_number = time(); 
  $sql = "INSERT INTO staffs   (name_surname, register_number, education_level,store_id,duty_id,salary) VALUES ('$name','$register_number', '$edu', '$storeId', '$dutyId','$salary' )";
  $staff_id = $GLOBALS['conn']->insert_id;
if ($GLOBALS['conn']->query($sql) === TRUE) {
  
  $sqlLog = "INSERT INTO staff_log (staff_id, staff_salary, start_date, staff_store ,staff_duty) VALUES ('$staff_id','$salary', '$dateNow', '$storeId', '$dutyId')";
  if ($GLOBALS['conn']->query($sqlLog) === TRUE) {
    echo "<p> Yeni çalışan başarı ile eklenmiştir.</p>";
    personelList();
  }
  else {
    echo "Error: " . $sqlLog . "<br>" .$GLOBALS['conn']->error;
  }
} else {
  echo "Error: " . $sql . "<br>" .$GLOBALS['conn']->error;
}
}


?>