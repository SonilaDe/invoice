<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
     table { 
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: 'Arial', sans-serif;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th {
    background-color: lightsteelblue;
    color: Black;
    padding: 12px;
    text-align: left;
    font-size: 16px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:nth-child(odd) {
    background-color: #ffffff;
}

td {
    padding: 12px;
    text-align: left;
    font-size: 14px;
    border: 2px solid #ddd;
}

a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    margin-right: 10px;
}

a:hover {
    color: #0056b3;
}

tr:hover {
    background-color: #f1f1f1;
}

#message {
    display: none;
    color: green;
    margin-top: 20px;
    font-size: 16px;
    font-weight: bold;
}


@media (max-width: 1024px) {
    th, td {
        font-size: 14px; 
        padding: 10px;
    }
}

@media (max-width: 768px) {
    th, td {
        font-size: 14px;
        padding: 10px;
    }

   
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    th, td {
        white-space: nowrap; 
    }
}

@media (max-width: 480px) {
    th, td {
        font-size: 12px;
        padding: 8px;
    }

   
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    th, td {
        white-space: nowrap; 
    }
}

    </style>
</head>
<body>
    <a href="create.php"><i class="fa-solid fa-backward"></i> Back to Create Invoice</a>

    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'crud';
    $table = 'invoice';

    try {
        $dsn = "mysql:host=$host; dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "SELECT * FROM $table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rezultati = $stmt->fetchAll();

        echo "<table>
                <tr>
                    <th>Invoice Number</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Unit Cost</th>
                    <th>Total Price</th>
                    <th>Update/Delete</th>
                </tr>";

        foreach ($rezultati as $x) {
            echo "<tr>
                    <td>{$x['InvoiceNumber']}</td>
                    <td>{$x['CompanyName']}</td>
                    <td>{$x['Address']}</td>
                    <td>{$x['Description']}</td>
                    <td>{$x['UnitCost']}</td>
                    <td>{$x['Total']}</td>
                    <td>
                        <a href='update.php?ID={$x['Id']}'>Update</a>
                        <a href='delete.php?ID={$x['Id']}'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</table>";

    } catch (PDOException $e) {
        echo "Error: ", $e->getMessage();
    }
    ?>

    <?php 
    if (isset($_GET['ID'])) {
        echo "<div id='message'>Record deleted successfully.</div>";
    }
    ?>
    
    <script>
    setTimeout(function(){
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000);
    </script>
</body>
</html>
