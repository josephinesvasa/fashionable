<?php

if(isset($_SESSION['status'])) {
    header("location:/fashionable/start");
}
?>
    <html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lekton' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
        <script src="/fashionable/product.js" type="text/javascript"></script>
        <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/overlay_products.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/start.css" rel="stylesheet" type="text/css"/>
        <link href="/fashionable/views/css/reset.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
    </head>
    <body id="bod">
    <div id="header">

        <ul>
            <li class="menu">
                <a href="/fashionable/start" id="head_name">Fashionable</a>
            </li>
            <li class="menu">
                <div>
                    <form id="get" action="/fashionable/user/GetAllProducts">
                        <input id="clothes_submit" type="submit" name="GetProducts" value="Shop"/>
                    </form>
                </div>
            </li>
            <li class="menu">
                <div id="inspo">
                    <form method="get" action="/fashionable/user/GetAllPictures">
                        <input id="inspiration_submit" type="submit" name="showAll" value="Looks"/>
                    </form>
                </div>
            </li>
            <li class="menu">
                <div>
                    <a href="/fashionable/account/Reg" id="register">Register</a>
                </div>
            </li>
            <li class="menu">
                <a id="login" href="/fashionable/account/log">Login</a>
            </li>
            <li class="menu">
                <div id="cart">
                    <form method="get" id="cart" action="/fashionable/cart/ShowCart">
                        <input id="cart_submit" type="submit" name="show_cart" value="Cart"/>
                    </form>
                </div>
            </li>
            <li class="menu">
                <div id="search">
                    <form method="get" action="/fashionable/user/GetSearch">
                        <input id="search_text" type="text" name="search_clothes" placeholder="Search"/>
                        <input id="search_button" type="submit" name="submit_search" value=""/>
                    </form>
                </div>
            </li>

        </ul>

        <?php
        if (isset($_GET["msgTry"])) {
            echo '<div class="msg_div">';
            echo "<p class='message'>Something went wrong please try again</p>";
            echo '<div>';

        }
        if (isset($_GET["msgEmpty"])) {
            echo '<div class="msg_div">';
            echo "<p class='message'>You forgot to fill in something</p>";
            echo '<div>';

        }
        if (isset($_GET["msgPass"])) {
            echo '<div class="msg_div">';
            echo "<p class='message'>Password don't match</p>";
            echo '<div>';

        }
        if (isset($_GET["msgEmail"])) {
            echo '<div class="msg_div">';
            echo "<p class='message'>Your email is not valid!</p>";
            echo '<div>';
        }
        if (isset($_GET["msgGood"])) {
            echo '<div class="msg_div">';
            echo "<p class='message'>You are now registered!</p>";
            echo '<div>';
        }
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
    </div>

    <!---<fieldset style="width: 300px;">
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
    </fieldset> -->

    </body>
    </html>

<?php


