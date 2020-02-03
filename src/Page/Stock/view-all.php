<?php

    $session = $this->container->get("Session");
    $session->checkSessionAndRedirect(basename(__FILE__, ".php"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo $this->pageSettings->getStyle() ?>" rel="stylesheet">
    <title>View Current Stock</title>
</head>
<body>
    <?php require_once "../src/Page/menu.php"; ?>
    <div class="container">
        <h1 class="header-main header">Stock</h1>
        <?php
            
            $getStock = $this->container->get("GetStock");
            $result = $getStock->get();

            if ($result["success"]) {

                $this->pageSettings->createDisplayDataTable($result);

            } else {

                if (isset($result["error"])) {

                    echo "<div class='error'>" . $result["error"] . "</div>";

                } else {

                    echo "<div class='no-result'>No stock info in database.</div>";
                }
            }


            // Only if user is an admin, then he can delete stock
            if ($this->pageSettings->checkAdmin($this->config["UserSettings"]["ADMIN"])) {

                // Delete Stock
                echo "<h2 class='header'>Delete Stock</h2>";
                require_once "../src/Page/delete.php";
    
                if (isset($_POST["submit-delete"])) {
    
                    $deleteStock = $this->container->get("DeleteStock");
                    $deleteResult = $deleteStock->delete();
    
                    if ($deleteResult["success"]) {
    
                        header("Location: index.php?page=view-all&type=employee");
                        exit();
    
                    } else {
    
                        echo "<div class='error'>" . $deleteResult["error"] . "</div>";
                    }
                }
            }

            // Update Stock
            echo "<h2 class='header'>Update Stock</h2>";
            require_once "../src/Page/Stock/update.php";

            if (isset($_POST["submit-update"])) {

                $updateStock = $this->container->get("UpdateStock");
                $updateResult = $updateStock->update();

                if ($updateResult["success"]) {

                    header("Location: index.php?page=view-all&type=stock");
                    exit();

                } else {

                    echo "<div class='error'>" . $deleteResult["error"] . "</div>";
                }
            }

        ?>
    </div>
</body>
</html>