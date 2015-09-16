<script src="/fashionable/index.js" type="text/javascript"></script>
<link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
<link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/fashionable/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
<script src="/fashionable/inspo.js"></script>
<link href="/fashionable/views/css/reset.css" rel="stylesheet" type="text/css"/>
<html>
<body id="inspo_body">
<?php
if(!isset($_SESSION['status'])) {
    require_once(realpath(dirname(__FILE__) . '/..') . '/views/startpage.php');
}
else{

    require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');

}
?>
<div id="overlay" onclick='hidethis()'>

</div>
<div id="lala">
    <ul id="la">

    </ul>
</div>


<?php

foreach($res as $row){

    ?>

    <div class="pictures">
        <input type="image" onkeypress="return event.keyCode!=13" class="inspo_pic" height="300" width="300" src="/fashionable/views/image/<?php echo $row["name"]?>" name="Pic" value="<?php echo $row['picture_inspo_id'] ?>" onclick="show(this.value)"/>

    </div>
<?php
}

?>
</body>
</html>




