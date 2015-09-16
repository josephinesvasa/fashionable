<html>
<head>
    <script src="/fashionable/index.js" type="text/javascript"></script>
    <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
    <link href="/fashionable/views/css/pictureInspo.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/fashionable/jquery-1.11.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
    <script src="/fashionable/inspo.js"></script>
    <link href="/fashionable/views/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="/fashionable/views/css/createlook.css" rel="stylesheet" type="text/css"/>
</head>
<body id="create_body">

<?php
require_once(realpath(dirname(__FILE__) . '/..') . '/views/account.php');
?>
<div class="proc">
    <p>Choose File</p>
</div>
<div class="proc">
    <p id="choose_prod">Choose Products</p>
</div>
<div class="proc">
    <p>Upload</p>
</div>
<div id="process">
</div>
<div id="createLook">
    <form id="form_file" method="post" name="upload_picture_this" enctype="multipart/form-data" action="/fashionable/user/uploadPicture">
        <div class="upload">
            <p id="p_choose">Choose File</p>
            <input  type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <input  name="userfile" type="file" id="userfile" >
        </div>

        <select id="option_drop" class="select_drop"  name="category_drop">
            <?php
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm3 = $db->prepare("SELECT * FROM categories");
            if ($stm3->execute()) {
                $result1 = $stm3->fetchAll();

                foreach ($result1 as $row1) {
                    ?>
                    <option id="option"  value="<?php echo $row1["category_id"] ?>"><?php echo $row1["category"] ?></option>
                <?php
                }
            }
            ?>
        </select>
        <input class="select_drop" id="hash_text" type="text" placeholder="#" name="brand"/>
        <input name="upload" type="submit" class="load_file" id="upload" value=" > ">
    </form>
</div>
</body>
</html>



