<?php
if(isset($_SESSION['status'])){
    header("location:/fashionable/start");
}
?>
<html>
<head>
    <link href="/fashionable/views/css/start.css" rel="stylesheet" type="text/css"/>
    <link href="/fashionable/views/css/register.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
?>
<div id="reg_div">
    <form method="post" action="/fashionable/account/register">
        <input class="reg_input" type="text" name="name" placeholder="Name"/>
        <br>
        <input class="reg_input" type="text" name="lastname" placeholder="Lastname"/>
        <br>
        <input class="reg_input" type="text" name="email" placeholder="Email"/>
        <br>
        <input class="reg_input" type="password" name="password" placeholder="Password"/>
        <br>
        <input class="reg_input" type="password" name="password_check" placeholder="Repeat Password"/>
        <br>
        <input class="reg_input" type="text" name="adress" placeholder="Adress"/>
        <br>
        <input class="reg_input" type="text" name="postnr" placeholder="Post Number"/>
        <br>
        <input class="reg_input" type="text" name="city" placeholder="City"/>
        <br>
        <input class="reg_input" id="submit_input" type="submit" name="submit_register" value="Register"/>
    </form>
</div>
</body>
</html>
