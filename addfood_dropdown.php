<?php
require 'connect.php';
$sql_i = "select * from Type";
$stmt_s = $conn->prepare ($sql_i);
$stmt_s->execute();
?>

<!DOCTYPE html>
<html lang="en">
<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update food </title>
  </head>

<body>
<div class="container justify-content-center align-center-item">
      <div class="row">
        <div class="col-md-4"> <br>
        <div class="form-group">
    <h1>Add Food</h1>
    
   <form action="addfood_dropdown.php" method="POST" enctype="multipart/form-data">
   <input type="text" placeholder="รหัสอาหารสัตว์" class="d-grid gap-6 form-control " name="FoodID" a-describedby="FoodID">
        <br><br/>
        <input type="text" placeholder="ชื่ออาหารสัตว์" class="d-grid gap-6 form-control " name="FoodName" a-describedby="FoodName">
         <br><br/>
         <input type="number" placeholder="ราคา" class="d-grid gap-6 form-control " name="Foodprice" a-describedby="Foodprice">
         <br><br/>
         <input type="file" name="Picture" class="form-control" required> 
         <br><br/>
         <label> ประเภทอาหาร </label>
         <select name="TypeID">
         <?php 
         while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
         ?>
         <option value="<?php echo $cc['TypeID']  ?>">
            <?php echo $cc['TypeName'] ?>
         </option>
            <?php
            endwhile
            ?>

         </select> 
         <br><br/>
         <input type="submit">
         


    </form>

</body>
</html>


<?php
try{
if (isset($_POST['FoodID']) && isset($_POST['FoodName'])):
echo $_GET['a'];
    $uploadFile = $_FILES['image']['name'];
    $tmpFile = $_FILES['image']['tmp_name'];

require 'connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "insert into animalfood values(:FoodID, :FoodName, :Foodprice, :TypeID, :image)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':FoodID', $_POST['FoodID']);
$stmt->bindParam(':FoodName', $_POST['FoodName']);
$stmt->bindParam(':Foodprice', $_POST['Foodprice']);
$stmt->bindParam(':image',$uploadFile);
$stmt->bindParam(':TypeID', $_POST['TypeID']);

           


            $fullpath = "./Picture/" . $uploadFile;
            echo " fullpath = " . $fullpath;
            move_uploaded_file($tmpFile, $fullpath);
            
            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    $message = 'Successfully add new Food';
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add Food",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    $message = 'Fail to add new Food';
                endif;
                // echo $message;
            } catch (PDOException $e) {
                 echo 'Fail! ' . $e;
            }
            $conn = null;
        
    ?>
    <?php
if ($stmt->execute()): 
    $message ='Suscessfully add new Food';
else :

    $message = 'Fail to add new Food';
endif;
echo $message;

$conn = null;
    endif;
}
 catch (PDOException $e) {
    echo $e->getMessage();
}
?>