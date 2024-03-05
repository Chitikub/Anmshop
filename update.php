<?php
if (isset($_POST['FoodID']) && isset($_POST['FoodName']) && isset($_POST['Foodprice'])) {
    require 'connect.php';

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $FoodID = $_POST['FoodID'];
    $FoodName = $_POST['FoodName'];
    $Price =  $_POST['Foodprice'];

    // echo 'FoodID = ' . $FoodID;
    // echo 'FoodName = ' . $FoodName;
    // echo 'Price = ' . $Price;


    $sql = "UPDATE animalfood SET FoodName = :FoodName, Foodprice = :Foodprice WHERE FoodID = :FoodID";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':FoodName', $_POST['FoodName']);
    $stmt->bindParam(':Foodprice', $_POST['Foodprice']);
    $stmt->bindParam(':FoodID', $_POST['FoodID']);


    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    try {
        if ($stmt->execute()) :
            echo '
                <script type="text/javascript">        
                $(document).ready(function(){
            
                    swal({
                        title: "Success!",
                        text: "Successfuly update food",
                        type: "success",
                        timer: 25000,
                        showConfirmButton: "ok"
                    }, function(){
                            window.location.href = "index.php";
                    });
                });                    
                </script>
            ';
        else :
            echo '
                <script type="text/javascript">        
                $(document).ready(function(){
            
                    swal({
                        title: "Error!",
                        text: "fail to update",
                        type: "warning",
                        timer: 25000,
                        showConfirmButton: "ok"
                    }, function(){
                            window.location.href = "index.php";
                    });
                });                    
                </script>
            ';
        endif;
        // echo $message;
    } catch (PDOException $e) {
        echo 'Fail! ' . $e;
    }
    $conn = null;
}

?>