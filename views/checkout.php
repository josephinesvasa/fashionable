<html>
<head>
    <link href="/fashionable/views/css/checkout.css" rel="stylesheet" type="text/css"/>

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
<div id="wrap">
    <div id="checkout">
        <p class="p_checkout">
            Thanks for shopping
        </p>
    </div>
</div>
</body>
</html>