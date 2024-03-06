<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="blackground.css">
    <link rel="stylesheet" href="form.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,
          wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> -->
    <title>User Registration 265</title>
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);

            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require 'connect.php';

    
    $sql_select = 'SELECT * FROM type ORDER BY TypeID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {
        if (!empty($_POST['FoodName'])) {
            $uploadFile = $_FILES['image']['name'];
            $tmpFile = $_FILES['image']['tmp_name'];
             //echo " upload file = " . $uploadFile;
             //echo " tmp file = " . $tmpFile;


            $sql = "insert into animalfood(FoodID,FoodName,Foodprice,image,TypeID)
							values (:FoodID, :FoodName, :Foodprice, :image, :TypeID)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':FoodID', $_POST['FoodID']);
            $stmt->bindParam(':FoodName', $_POST['FoodName']);
            $stmt->bindParam(':Foodprice', $_POST['Foodprice']);
            $stmt->bindParam(':image', $uploadFile);
            $stmt->bindParam(':TypeID', $_POST['TypeID']);
           




            $fullpath = "./Picture/" . $uploadFile;
            move_uploaded_file($tmpFile, $fullpath);

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
                                text: "Successfuly ADD FOOD",
                                type: "success",
                                timer: 250000,
                                showConfirmButton: "ok"
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :

                    echo '<script type="text/javascript">
            $(document).ready(function(){
              Swal({
                title: "ไม่สำเร็จ",
                text: "ไม่สามารถลบได้",
                icon: "warning",
                confirmButtonText: "ok",
              }).then(function(){
                window.location.href = "index.php";
              });
            });
          </script>';


                endif;
                // echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>




    <div class="container justify-content-center align-center-item">
        <div class="row">
            <div class="col-md-4"> <br>
                <div class="row g-3">
                    <div class="form-group">
                        <h3>เพิ่มอาหาร</h3>
                        <form action="addfood_dropdown.php" method="POST" enctype="multipart/form-data">
                        <input type="number" class="form-control" placeholder="FoodID" name="FoodID" required>
                            <br> <br>
                            <input type="text" class="form-control" placeholder="FoodName" name="FoodName" required>
                            <br> <br>
                            <input type="number" class="form-control" placeholder="Foodprice" name="Foodprice">
                            <br> <br>
                            <label>ประเภท</label>
                            <select name="TypeID" class="form-control">
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
                           
                            <br> <br>
                            แนบรูปภาพ:
                            <input type="file" name="image" class="form-control" required>
                            <br><br>
                            <input type="submit" value="Submit" name="submit" class="btn btn-success" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#animalfoodTable').DataTable();
        });
    </script>



</body>

</html>