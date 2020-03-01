<?php 
            require('mysqli_connect.php');
            require('checkout.php');

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
                    $q = 'INSERT INTO bookinventoryorder(firstname, lastname, payment, BookID) VALUES('.$_POST['firstname'].','.$_POST['lastname'].','.$_POST['payment'].',(SELECT BookID FROM bookInventory WHERE '.$book=$_SESSION['bookname'].'))';
                    $r=@mysqli_query($dbc,$q);
                    if($r){
                        echo "success";
                        echo("<script>console.log('PHP: " . $q . "');</script>");
                    }
                }
            }

        


            
                
            

            mysqli_close($dbc);

        ?>