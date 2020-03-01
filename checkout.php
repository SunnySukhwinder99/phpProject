<?php 

session_start();

?>

<?php 
            require('mysqli_connect.php');

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty($_POST['firstname'])){
                    echo '<p class="alert alert-danger">First Name cannot be empty!</p>';
                }

                if(empty($_POST['lastname'])){
                    echo '<p class="alert alert-danger">Last Name cannot be empty!</p>';
                }

                if(empty($_POST['payment'])){
                    echo '<p class="alert alert-danger">Payment Method cannot be empty!</p>';
                }

                $book="book_name";

                

                if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['payment'])){
                    echo "hello";
                    $sql1 = "INSERT INTO bookinventoryorder(firstname, lastname, payment, BookID) VALUES('".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['payment']."', '".$_SESSION['bookname']."')"; 
            
                    if ($dbc->query($sql1) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql1 . "<br>" . $dbc->error;
                    }

                    $sql2 = "UPDATE bookinventory SET quantity = quantity-1 WHERE bookid=".$_SESSION['bookname'];
                    if ($dbc->query($sql2) === TRUE) {
                        echo "quantity updated";
                    } else {
                        echo "Error: " . $sql2 . "<br>" . $dbc->error;
                    }
                }
                
            }
            

        


            
                
            

            mysqli_close($dbc);

        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 40%;
        margin: auto;
    }

    td,
    th {

        text-align: right;
        padding: 8px;
    }
    </style>

</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Bookstore</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <li class="disabled active"><a href="">Checkout</a></li>
            </ul>
        </div>
    </nav>

    <main>

        <?php

            echo "".$_SESSION["bookname"];

        ?>

        <form action="checkout.php" method="post">
            <table>
                <tr class="form-group">
                    <th class="control-label">First Name:</th>
                    <td></td>
                    <td><input type="text" name="firstname" class="form-control" required></td>
                </tr>
                <tr class="form-group">
                    <th class="control-label">Last Name:</th>
                    <td></td>
                    <td><input type="text" name="lastname" class="form-control" required></td>
                </tr>
                <tr class="form-group">
                    <th class="control-label">Payment Method:</th>
                    <td></td>
                    <td> <input list="payment_methods" name="payment" class="form-control" required>
                        <datalist id="payment_methods">
                            <option value="Debit" class="form-control">
                            <option value="Credit" class="form-control">
                            <option value="Paypal" class="form-control">
                        </datalist>
                    </td>
                </tr>
                <tr class="form-group">
                    <td></td>
                    <td><input type="Submit" value="Place Order" class="btn btn-primary" target="blank"></td>
                    <td></td>
                </tr>
            </table>
        </form>

        

    </main>

</body>

</html>