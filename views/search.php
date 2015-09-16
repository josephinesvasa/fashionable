<?php
if(isset($_GET['submit_search'])) {
    ?>
    <html>
    <head>
        <link href="/fashionable/views/css/search.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="search_body">
    <?php
    if (!isset($_SESSION['status'])) {
        require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
    } else {

        require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');
    }
    ?>
    </body>
    </html>
    <div class="result">
        <?php
        foreach ($result as $row) {
            ?>
            <div class="search_div">
                <img class="img_result" height="150" width="150"
                     src="/fashionable/views/image/<?php echo $row ['name'] ?>"/>

                <form class="add" method="post" action="/fashionable/cart/addToCart">
                    <input type="hidden" name="product_id" value=<?php echo $row["product_id"] ?>/>
                    <input class="add_this" type="submit" name="submit_add" value="Add"/>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
else{
    header("location:/fashionable/start");
}