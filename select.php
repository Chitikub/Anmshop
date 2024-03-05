<html>

<head>
    <title> Select to See Detail 651</title>
</head>

<body>
    <?php
    require "connect.php";
    $sql = "SELECT FoodID, FoodName, Foodprice, TypeName, image FROM animalfood, type WHERE animalfood.TypeID = type.TypeID;";


    $stmt = $conn->prepare($sql);
    $stmt->execute();
    ?>

    <table width="800" border="1">
        <tr>
            <th width="90">
                <div align="center">รหัสอาหารสัตว์ </div>
            </th>
            <th width="140">
                <div align="center">ชื่ออาหารสัตว์ </div>
            </th>
            <th width="120">
                <div align="center">ราตา </div>
            </th>
            <th width="100">
                <div align="center">ประเภทอาหารสัตว์ </div>
            </th>
            <th width="50">
                <div align="center">ภาพ </div>
            </th>
        </tr>

        <?php
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

            <tr>
                <td>

                    <?php echo $result["FoodID"]; ?>

                </td>

                <td>
                    <?php echo $result["FoodName"]; ?>
                </td>

                <td><?php echo $result["Foodprice"]; ?></div>
                </td>
                <td><?php echo $result["TypeName"]; ?></td>
                <td><?php echo $result["image"]; ?></div>
            </tr>

        <?php
        }
        ?>

    </table>

    <?php
    $conn = null;
    ?>

</body>

</html>