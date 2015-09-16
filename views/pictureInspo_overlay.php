<head>
    <script src="/fashionable/index.js" type="text/javascript"></script>

</head>
<div id="show">
    <?php
    foreach($result as $row2){
        ?>

        <div>
            <p>Category:<?php echo $row2["category"]?></p>
            <p>Brand:<?php echo $row2["brand"]?></p>
            <img height="400" width="300" src='/fashionable/views/image/<?php echo $row2["name"]?>'/>
        </div>

    <?php
    }
    ?>

    <?php
    foreach($result1 as $row){
        ?>

        <div id="showThis1">
            <p>prod name:<?php echo $row["product_name"]?></p>
            <p>prod name:<?php echo $row["product_id"]?></p>
            <form method="get" action="/fashionable/user/ShowCategory">
                <input type="hidden" name="GetCategory" value="<?php echo $row["category_id"]?>"/>
                <input type="image"  height="400" width="300" src="/fashionable/views/image/<?php echo $row["name"]?>"/>
            </form>
        </div>

    <?php
    }
    ?>
</div>