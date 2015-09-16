<html>
<head>
</head>
<body>
<?php
if(!isset($_SESSION['status'])) {
    require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
}
else{

    require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');

}
?>
<?php
foreach($res as $row){
    ?>
    <div>
        <p><?php echo $row ['product_name'] ?></p>
        <p><?php echo $row ['price'] ?></p>
        <img height="400" width="300" src='/fashionable/views/image/<?php echo $row["name"]?>'/>
        <form method="post" action="/fashionable/cart/addToCart">
            <input type="hidden" name="product_id" value=<?php echo $row["product_id"]?>/>
            <input type="submit" name="submit_add" value="Add to cart"/>
        </form>
    </div>
<?php
}
?>
</body>
</html>