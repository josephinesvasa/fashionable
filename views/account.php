<?php

if(!isset($_SESSION['status'])=="customers_inloggad") {
    header("location:/fashionable/start");

}
else{
    ?>
    <html>
    <head>
        <script src="/fashionable/product.js" type="text/javascript"></script>
        <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/overlay_products.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/start.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/reset.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
        <script src="/fashionable/index.js" type="text/javascript"></script>
        <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/account.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="account_body">

    <div id="header_login">
        <ul>
            <li class="menu">
                <a href="/fashionable/start" id="head">Fashionable</a>
            </li>
            <li class="menu_login">
                <div>
                    <form id="get" action="/fashionable/user/GetAllProducts">
                        <input class="buttn" type="submit" name="GetProducts" value="Shop"/>
                    </form>
                </div>
            </li>
            <li class="menu_login">
                <a id="create_look" href="/fashionable/user/createLook">Create look</a>
            </li>
            <li class="menu_login">
                <form method="get" action="/fashionable/user/getAllMyPictures">
                    <input class="buttn" type="submit" name="show_pictures" value="My looks"/>
                </form>
            </li>
            <li class="menu_login">
                <form method="get" action="/fashionable/user/GetAllPictures">
                    <input class="buttn" type="submit" name="showAll" value="Looks"/>
                </form>
            </li>
            <li class="menu_login">
                <form method="post" action="/fashionable/account/logout">
                    <input class="buttn" type="submit" value="Sign out" name="logout"/>
                </form>
            </li>
            <li class="menu_login">
                <form method="get" action="/fashionable/cart/ShowCart">
                    <input id="cart_sub" class="buttn" type="submit" name="show_cart" value="Cart"/>
                </form>
            </li>
            <li class="menu_login">
                <div>
                    <form method="get" action="/fashionable/user/GetSearch">
                        <input id="search_text_account" type="text" name="search_clothes" placeholder="Search"/>
                        <input id="search_button_account" type="submit" name="submit_search" value=""/>
                    </form>
                </div>
            </li>
            <?php
            if (isset($_GET["msgLogin"])) {
                echo '<div class="msg_div">';
                echo "<p class='message'>You need to login to do this!</p>";
                echo '<div>';
            }
            if (isset($_GET["msgSearch"])) {
                echo '<div class="msg_div">';
                echo "<p class='message'>What are you searching for?</p>";
                echo '<div>';
            }
            if (isset($_GET["msgError"])) {
                echo '<div class="msg_div">';
                echo "<p class='message'>You don't have permission to this</p>";
                echo '<div>';

            }
            ?>
        </ul>
    </div>
    <!---
        <fieldset style="width: 300px;">
            <form method="get" action="/fashionable/user/GetColor">
                <input type="submit" value=" " name="blackSubmit"/>
                <label for="black">Black</label><br />

                <input type="submit" value=" " name="whiteSubmit"/>
                <label for="sommar">White</label> <br />

                <input type="submit" value=" " name="beigeSubmit"/>
                <label for="host">Beige</label> <br />

                <input type="submit" value=" " name="greenSubmit"/>
                <label for="vinter">Green</label>
            </form>
        </fieldset>-->


    </body>
    </html>
<?php
}