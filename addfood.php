<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
</head>
<body>
    
    <h1>Add food</h1>
    
    <form action="addcustomer_dropdown" method="POST">
        <input type="text" placeholder="กรุณากรอกรหัสอาหาร" name="FoodID">
        <br><br/>
        <input type="text" placeholder="โปรดใส่ชื่ออาหาร" name="FoodName"> 
         <br><br/>
         <input type="number" placeholder="ราคา" name="Foodprice">
         <br><br/>
         


    </form>

</body>
</html>

<?php
try {
    if (isset($_POST['FoodID']) && isset($_POST['FoodName'])):
    
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into animalfood values(:FoodID, :FoodName, :Foodprice, :TypeID)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':FoodID', $_POST['FoodID']);
    $stmt->bindParam(':FoodName', $_POST['FoodName']);
    $stmt->bindParam(':Foodprice', $_POST['Foodprice']);
    $stmt->bindParam(':TypeID', $_POST['TypeID']);
    
    if ($stmt->execute()): 
        $message ='Suscessfully add new Food';
    else :
    
        $message = 'Fail to add new Food';
    endif;
    echo $message;
    
    $conn = null;
        endif;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    
    
    ?>