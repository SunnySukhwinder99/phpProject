<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store</title>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 40%;
        margin: auto;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Bookstore</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="store.php">Store</a></li>
                <li class="disabled"><a href="">Checkout</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <?php 
require('mysqli_connect.php');
$q="select bookid, book_name from bookInventory";
$r = @mysqli_query($dbc, $q);
echo "<table><tr> <th>Book Name</th> </tr>";
if (!$dbc) { die('Could Not Connect: ' . mysqli_error($dbc) . mysqli_errno($dbc)); }
$chkRow = mysqli_num_rows($r); 
if($chkRow>0){
while($row = mysqli_fetch_array($r)) {
    
echo '<tr><td><a href="?run='.$row['bookid'].'">'.$row['book_name']."</a></td></tr>";


}
    
}
echo "</table>";

mysqli_close($dbc);
?>

        <?php 
        
        if(isset($_GET['run'])){
            $id=$_GET['run'];
            sessionFunc($id);
        }
        function sessionFunc($sess_var){
            $_SESSION["bookname"]=$sess_var;
            header("Location: checkout.php");
        }



?>

    </main>

</body>

</html>