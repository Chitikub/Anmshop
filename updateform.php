<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update food </title>
  </head>
  <body>

<?php

    require 'connect.php';

    $sql_select = 'select * from animalfood, type order by FoodID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();
    // echo "FoodID = ".$_GET['FoodID'];

    if (isset($_GET['FoodID'])) {
        $sql_select_customer = 'SELECT * FROM animalfood WHERE FoodID=?';
        $stmt = $conn->prepare($sql_select_customer);
        $stmt->execute([$_GET['FoodID']]);
        // echo "get = ".$_GET['FoodID'];
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

?>

    
<div class="container justify-content-center align-center-item">
      <div class="row">
        <div class="col-md-4"> <br>
        <div class="form-group">
          <h3>ฟอร์มแก้ไขข้อมูลอาหาร</h3>
          <form action="update.php" method="POST" align="center">
           <input type="hidden" name="FoodID" value="<?= $result['FoodID'];?>">
            
                <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              
               <input type="text" name="FoodName" class="form-control" required value="<?php echo $result["FoodName"]; ?>">          
          
            
                <label for="name" class="col-sm-2 col-form-label"> ราคา :  </label>
             
                <input type="number" name="Foodprice" class="form-control" required value="<?php echo $result["Foodprice"] ?>">

                <label>ประเภทอาหาร</label>
                    <select name="MenuID" class="form-control">
                    <?php
                        while ($t = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
                        ?>
                            <option value="<?php echo $t['TypeID'] ?>">
                                <?php echo $t['TypeName'] ?>
                            </option>

                        <?php

                        endwhile;
                        ?>
                    </select>
            <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>
                    </div>
  </body>
</html>