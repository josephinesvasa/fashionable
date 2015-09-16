<?php

foreach($result as $row1){
    ?>
    <p><?php echo $row1['product_name'] ?></p>
    <p><?php echo $row1['price'] ?></p>
    <p><?php echo $row1['product_id'] ?></p>
    <img src="/fashionable/views/image/<?php echo $row1['name']?>"/>
    <form method="post" action="/fashionable/cart/addToCart">
        <input type="hidden" name="product_id" value=<?php echo $row1["product_id"]?>/>
        <input type="submit" name="submit_add" value="Add to cart"/>
    </form>

<?php
}