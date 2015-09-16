<html>
<head>
    <script src="../jquery-1.11.2.min.js" type="text/javascript"></script>
    <link href="/fashionable/views/css/clothes.css" rel="stylesheet" type="text/css"/>
    <script src="/fashionable/product.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
    <script src="/fashionable/jquery-1.11.1.min.js"></script>
</head>
<body id="clothes_body" onclick="close_add()">
<?php
if(!isset($_SESSION['status'])) {
    require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
}
else{

    require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');

}
?>
<?php
if(isset($_GET["added"])) {

    echo "<p class='thismessage'>Your product was added to your cart!</p>";
}
?>

<div id="prod_overlay" onclick="closeProduct()">

</div>
<div id="showProduct">

</div>

<?php

foreach ($result as $row) {
    ?>
    <div class="prod">
        <ul>
            <li>
                <input id="prod_pic" type="image" onkeypress="return event.keyCode!=13" height="150" width="150" src="/fashionable/views/image/<?php echo $row["name"] ?>" value="<?php echo $row['product_id'] ?>" onclick="ShowImg(this.value)"/>
            <li>
            <li>
                <form id="add" method="post" action="/fashionable/cart/addToCart">
                    <input type="hidden" class="hej" name="product_id" value=<?php echo $row["product_id"] ?>/>
                    <input class="add_this" type="submit" name="submit_add" value="Add"/>

                </form>
            </li>
        </ul>
    </div>
<?php
}
?>

</body>
</html>