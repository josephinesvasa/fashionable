<?php
foreach($result as $row){
    ?>
    <p><?php echo $row['product_name'] ?></p>
    <p><?php echo $row['price'] ?></p>
    <p><?php echo $row['product_id'] ?></p>
    <img src="/fashionable/views/image/<?php echo $row['name']?>"/>
    <form method="post" action="/fashionable/cart/addToCart">
        <input type="hidden" name="product_id" value=<?php echo $row["product_id"]?>/>
        <input type="submit" name="submit_add" value="Add to cart"/>
    </form>

<?php
}
