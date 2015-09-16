<html>
<head>
    <link href="/fashionable/views/css/login.css" rel="stylesheet" type="text/css"/>
    <link href="/fashionable/views/css/reset.css" rel="stylesheet" type="text/css"/>
</head>
<body id="login_body">
<?php
require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
?>
<div id="login">
    <form method="post" action="/fashionable/account/login">
        <input class="login_input" type="text" name="email" placeholder="Email"/>
        <br>
        <input id="pass" class="login_input" type="password" name="password" placeholder="Password"/>
        <br>
        <input id="submit_login" class="login_input" type="submit" name="submit_login" value="Login"/>
    </form>
</div>
</body>
</html>