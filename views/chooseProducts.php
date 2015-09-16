<?php
if(isset($_POST['upload'])) {
    ?>
    <html>
    <head>
        <link href="/fashionable/views/css/chooseProducts.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="prod_body">
    <?php
    require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');
    ?>
    <div class="proc">
        <p>Choose File</p>
    </div>
    <div class="proc">
        <p id="choose_prod">Choose Products</p>
    </div>
    <div class="proc">
        <p>Upload</p>
    </div>
    <div id="process">

    </div>
    <?php

    //echo "<img src='/fashionable/views/image/".$_SESSION['lastInsertPicture']."'/>";
    foreach ($res as $row) {
        ?>
        <img height="300" id="inspo_pic" width="300" src="/fashionable/views/image/<?php echo $row['name'] ?>"/>
        <p id="inspo_p"><?php echo $row['brand'] ?></p>
    <?php
    }

    ?>

    <form class="form_div" method="post" action="/fashionable/user/UpdateInspo">
        <div id="submit_div">
            <input id="submit_this" type="submit" value=">" name="submitProducts"/>
        </div>
        <?php
        foreach ($result as $row1){
        ?>
        <div class="choose_div">
            <img id="product" src="/fashionable/views/image/<?php echo $row1['name'] ?>"/>
            <input type="checkbox" name="product_id[]" value="<?php echo $row1['product_id'] ?>"/>

            <?php
            echo '</div>';
            }

            ?>
    </form>
    </body>
    </html>
<?php
}
else{
    header("location:../start/index?msgError=empty");
}