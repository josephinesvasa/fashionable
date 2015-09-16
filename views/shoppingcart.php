
<html>
<head>
    <script src="/fashionable/index.js"></script>
    <link href="/fashionable/views/css/shoppingcart.css" rel="stylesheet" type="text/css"/>
    <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
    <script src="/fashionable/shoppingcart.js"></script>
    <script src="/fashionable/jquery-1.11.1.min.js"></script>
</head>
<body id="body_shoppingcart">
<?php
if(!isset($_SESSION['status'])) {
    require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
}
else{

    require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');

}
?>
<?php

if(isset($_SESSION['status'])){
    ?>
    <div class="back_wrap">
        <div class="back">
            <a href="/fashionable/user/GetAllProducts" class="back_a"> Return to shop</a>
        </div>
    </div>
    <?php
    foreach($result as $row){
        ?>
        <div class="add_product">

            <div class="div_menu">
                <ul class="menu_shop">
                    <li class="name_div">
                        <p id="product">Product</p>
                    </li>
                    <li class="name_div">
                        <p>Price</p>
                    </li>
                    <li class="name_div">
                        <p>Quantity</p>
                    </li>
                    <li class="name_div">
                        <p>Total</p>
                    </li>
                </ul>
            </div>
            <div class="cart_img">
                <img height="80" width="70" src='/fashionable/views/image/<?php echo $row["name"]?>'/>
            </div>
            <div class="desc">
                <p id="name"><?php echo $row['product_name'] ?></p>

            </div>
            <?php

            $subtotal = $row['price'] * $row['quantity'];
            ?>
            <div class="price">
                <li class='prod_cart_under'><?php echo $row['price'] ?></li>
            </div>
            <div class="butt_cart">
                <form class="remove" method="post" action="/fashionable/cart/UpdateCartRemove">
                    <input class="button" type="hidden" name="product_id_remove" value="<?php echo $row['product_id'] ?>"/>
                    <input class="update_cart" type="submit" name="Remove_cart" value="-"/>
                </form>

                <li class="update" id="quantity1"><?php echo $row['quantity'] ?></li>
                <form class="update" method="post" action="/fashionable/cart/UpdateCartAdd">
                    <input class="button" type="hidden" name="product_id_update" value="<?php echo $row['product_id'] ?>"/>
                    <input class="update_cart" type="submit" name="Update_cart" value="+"/>
                </form>
            </div>
            <li class='remove' id="total"><?php echo $subtotal?> </li>
            <div class="delete">
                <form id="d1" method="post" action="/fashionable/cart/DeleteFromCart">
                    <input  id="delete" class="button" type="hidden" name="product_id_delete" value="<?php echo $row['product_id'] ?>"/>
                    <input class="delete_input" type="submit" name="Delete_cart" value="X"/>
                </form>
            </div>
        </div>

    <?php
    }
}

else if(!isset($_SESSION['status'])){
    if (isset($_GET["msgWrong"])) {
        echo '<div class="msg_div1">';
        echo "<p class='mess'>something went wrong plz try again!</p>";
        echo '<div>';

    }

    ?>

    <div class="back_wrap">
        <div class="back">
            <a href="/fashionable/user/GetAllProducts" class="back_a"> Return to shop</a>
        </div>
    </div>
    <?php
    foreach($res as $row){
        ?>
        <div class="add_product">
            <div class="div_menu">
                <ul class="menu_shop">
                    <li class="name_div">
                        <p id="product">Product</p>
                    </li>
                    <li class="name_div">
                        <p>Price</p>
                    </li>
                    <li class="name_div">
                        <p>Quantity</p>
                    </li>
                    <li class="name_div">
                        <p>Total</p>
                    </li>
                </ul>
            </div>
            <div class="cart_img">
                <img height="80" width="70" src='/fashionable/views/image/<?php echo $row["name"]?>'/>
            </div>
            <div class="desc">
                <p id="name"><?php echo $row['product_name'] ?></p>

            </div>
            <?php
            $subtotal = $row['price'] * $row['quantity'];
            ?>
            <div class="price">
                <li class='prod_cart_under'><?php echo $row['price'] ?></li>
            </div>
            <div class="butt_cart">
                <form class="remove" method="post" action="/fashionable/cart/UpdateCartRemove">
                    <input class="button" type="hidden" name="product_id_remove_non" value="<?php echo $row['product_id'] ?>"/>
                    <input class="update_cart" type="submit" name="Remove_cart_non" value="-"/>
                </form>
                <li id="quantity2" class="update"><?php echo $row['quantity'] ?></li>
                <form class="update" method="post" action="/fashionable/cart/UpdateCartAdd">
                    <input class="button" type="hidden" name="product_id_update_non" value="<?php echo $row['product_id'] ?>"/>
                    <input class="update_cart" type="submit" name="Update_cart_non" value="+"/>
                </form>
            </div>
            <li id="total" class="remove"><?php echo $subtotal?> </li>
            <div class="delete">
                <form id="d2" method="post" action="/fashionable/cart/DeleteFromCart">
                    <input  class="button" type="hidden" name="product_id_delete_non" value="<?php echo $row['product_id'] ?>"/>
                    <input class="delete_input" type="submit" name="Delete_cart_non" value="X"/>
                </form>
            </div>
        </div>

        <div id="reg_overlay" onclick="closeShowReg()" ></div>
        <div id="ShowReg">
            <div id="reg_div">
                <p id="register_text">Register</p>
            </div>
            <form method="post" action="/fashionable/cart/SubmitCartReg">
                <input class="shop" type="text" name="Name" placeholder="Name"/>
                </br>
                <input class="shop" type="text" name="Lastname" placeholder="Lastname"/>
                </br>
                <input class="shop" type="text" name="Adress" placeholder="Adress"/>
                </br>
                <input class="shop" type="text" name="Postnr" placeholder="Post number"/>
                </br>
                <input class="shop" type="text" name="City" placeholder="City"/>
                </br>
                <input type="hidden" name="cart_id" value="<?php $_SESSION ['no_logged_cart_id'] ?>"/>
                <input class="shop" id="buy" type="submit" name="SubmitThisCart" value="Buy"/>
            </form>
            <div>
                <img id="pic_reg" src="/fashionable/views/image/End-of-Days-Editorial-by-Fashion-Photographer-Annie-Edmonds_06.jpg">
            </div>
        </div>

    <?php
    }
}
?>
</body>
</html>