<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          form {
  max-width: 600px;
  margin: 50px auto;
  padding: 30px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  font-family: 'Arial', sans-serif;
  color: #333;
}

form input[type="number"],
form input[type="text"],
form input[type="email"],
form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: 2px solid #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
  font-size: 16px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
}

form input::placeholder,
form textarea::placeholder {
  color: #aaa;
  font-style: italic;
}

form textarea {
  resize: vertical;
  min-height: 120px;
  padding: 12px;
}

form input[type="number"]:focus,
form input[type="text"]:focus,
form input[type="email"]:focus,
form textarea:focus {
  border-color: #007BFF;
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
  outline: none;
}


form input[type="submit"] {
  width: 100%;
  padding: 14px;
  font-size: 16px;
  font-weight: bold;
  background-color: #007BFF;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

form input[type="submit"]:hover {
  background-color: #0056b3;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

form input[type="submit"]:active {
  background-color: #003f7f;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
}


@media (max-width: 768px) {
  form {
    padding: 20px;
  }
}
        

        </style>
</head>
<body>
    <?php

$host='localhost';
$username='root';
$password='';
$dbname='crud';
$table='invoice';



if(isset($_GET['ID'])){
    $id=$_GET['ID'];
    $dns="mysql:host=$host; dbname=$dbname";
    $conn=new PDO($dns,$username,$password);
    $sql="SELECT * FROM $table WHERE ID=:id";
    $stmt=$conn->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $rez=$stmt->fetch();
}



?>
<form action="update2.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $rez['Id']; ?>">
    
    <input type="number" name="invoicenumber" value="<?php echo htmlspecialchars($rez['InvoiceNumber']); ?>" placeholder="Invoice Number">
    <input type="text" name="companyname" value="<?php echo htmlspecialchars($rez['CompanyName']); ?>" placeholder="Company Name">
    <input type="text" name="address" value="<?php echo htmlspecialchars($rez['Address']); ?>" placeholder="Address">
    <textarea name="description" placeholder="Description"><?php echo htmlspecialchars($rez['Description']); ?></textarea>
    <input type="number" name="unitcost" value="<?php echo htmlspecialchars($rez['UnitCost']); ?>" placeholder="Unit Cost">
    <input type="number" name="totalprice" value="<?php echo htmlspecialchars($rez['Total']); ?>" placeholder="Total Price">
    <input type="submit" name="update" value="Update Invoice">
</form>

</body>
</html>