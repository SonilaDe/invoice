<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Invoice</title>
</head>
<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crud';
$table = 'invoice';


if (isset($_POST['update'])) {
    
    $id = $_POST['id']; 
    $invoicenumber = $_POST['invoicenumber'];
    $companyname = $_POST['companyname'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $unitcost = $_POST['unitcost'];
    $totalprice = $_POST['totalprice'];

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "UPDATE $table SET 
                    InvoiceNumber = :invoicenumber, 
                    CompanyName = :companyname, 
                    Address = :address, 
                    Description = :description, 
                    UnitCost = :unitcost, 
                    Total = :totalprice 
                WHERE ID = :id";
     
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':invoicenumber' => $invoicenumber,
            ':companyname' => $companyname,
            ':address' => $address,
            ':description' => $description,
            ':unitcost' => $unitcost,
            ':totalprice' => $totalprice,
            ':id' => $id
        ]);

       
        if ($stmt->rowCount() > 0) {
           
            header('Location: read2.php');  
            exit;  
        } else {
            echo "No changes were made to the invoice.";
        }

    } catch (PDOException $e) {

        echo "Error: " . $e->getMessage();
    }
}
?>

</body>
</html>
