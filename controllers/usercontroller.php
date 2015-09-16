<?php

class UserController {

    public function IndexAction(){

        header("location:/fashionable/start");
    }

    public function createLookAction(){
        if(isset($_SESSION['status'])){
            require_once './views/createlook.php';
        }
        else{
            header("location:../start/index?msgLogin=empty");
        }
    }
    public function ShowSelectProductsAction(){

        if(isset($_SESSION['status'])){
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from picture_inspos
                               join brands on picture_inspos.brand_id=brands.brand_id
                               where picture_inspo_id=:picture_inspo_id");
            $stm->bindParam(":picture_inspo_id", $_SESSION['lastInsertPicture']);

            if($stm->execute()) {
                $res = $stm->fetchAll();
                $stm2=$db->prepare("SELECT * FROM product_pictures join products
                                    on product_pictures.product_id=products.product_id
                                    join pictures on product_pictures.picture_id=pictures.picture_id ");
                $stm2->execute();
                $result=$stm2->fetchAll();
                require_once './views/chooseProducts.php';
            }

            else{
                header("location:../start/index?msgError=empty");
            }
        }

        else{
            header("location:../start/index?msgError=empty");
        }

    }
    public function GetAllProductsAction(){
        $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");

        $stm2 = $db->prepare("SELECT * FROM product_pictures join products on product_pictures.product_id=products.product_id join pictures on product_pictures.picture_id=pictures.picture_id");

        if ($stm2->execute()) {

            $result = $stm2->fetchAll(PDO::FETCH_ASSOC);

            require_once './views/clothes.php';
        }
    }

    public function GetProductImageAction() {

        if(isset($_GET['prod_data'])){
            header('Content-Type: application/json');

            $array=Array();

            $value=$_GET['prod_data'];
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm2 = $db->prepare("select a.picture_id,a.product_id, b.picture_id, b.name, c.description,c.brand_id ,c.price, d.brand from product_pictures a
                              join pictures b on a.picture_id=b.picture_id
                              join products c on a.product_id=c.product_id
                              join brands d on c.brand_id=d.brand_id
                              where a.product_id=:product_id");
            $stm2->bindParam(":product_id", $value);
            if($stm2->execute()) {
                $result = $stm2->fetchAll();
                foreach($result as $row1){
                    $array[]=$row1['name'];


                }
                $prod_arr=json_encode($array);
                echo $prod_arr;
            }}
        else{
            header("location:../start/index?msgError=empty");
        }
    }

    public function showInfoAction(){
        if(isset($_GET['info_data'])){
            header('Content-Type: application/json');
            $info=Array();
            $info=$_GET['info_data'];
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1 = $db->prepare("select a.picture_id,a.product_id, b.picture_id, b.name, c.description,c.brand_id ,c.price, d.brand from product_pictures a
                                  join pictures b on a.picture_id=b.picture_id
                                  join products c on a.product_id=c.product_id
                                  join brands d on c.brand_id=d.brand_id
                                  where a.product_id=:product_id");
            $stm1->bindParam(":product_id", $info);
            if($stm1->execute()) {

                $result1 = $stm1->fetchAll();
                foreach($result1 as $row2){

                    echo json_encode(array("0"=>$row2['brand'], "1"=>$row2['description'],"2"=>$row2['price']));

                }

            }
        }
        else{
            header("location:../start/index?msgError=empty");
        }
    }
    public  function UpdateInspoAction()
    {
        if(isset($_SESSION['status'])){
            if(isset($_POST['submitProducts'])) {

                foreach($_POST['product_id'] as $row) {


                    $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                    $stm = $db->prepare("insert into extend_product_inspos (product_id, picture_inspo_id) VALUES (:product_id, :picture_inspo_id)");
                    $stm->bindParam(":picture_inspo_id", $_SESSION['lastInsertPicture']);
                    $stm->bindParam(":product_id", $row);

                    if ($stm->execute()) {
                        require_once './views/uploaded.php';

                    }
                }
            }
            else{
                header("location:../start/index?msgError=empty");
            }
        }
        else{
            header("location:../start/index?msgError=empty");
        }
    }
    public function uploadPictureAction()
    {
        if (isset($_SESSION['status'])) {
            if(isset($_POST['upload'])){
                if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
                    $fileName = $_FILES['userfile']['name'];
                    $tmpName = $_FILES['userfile']['tmp_name'];
                    $fileSize = $_FILES['userfile']['size'];
                    $fileType = $_FILES['userfile']['type'];

                    $fp = fopen($tmpName, 'r');
                    $content = fread($fp, filesize($tmpName));
                    $content = addslashes($content);
                    fclose($fp);

                    if (!get_magic_quotes_gpc()) {
                        $fileName = addslashes($fileName);
                    }


                    $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                    $stm6 = $db->prepare("insert into brands (brand) VALUES (:brand)");
                    $stm6->bindParam(":brand", $_POST['brand']);

                    if ($stm6->execute()) {
                        $_SESSION['brand_insert'] = $stm6 = $db->lastInsertId();
                    }
                    $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                    $stm3 = $db->prepare("insert into picture_inspos (name, size, type, content, category_id, brand_id) VALUES ('$fileName', '$fileSize', '$fileType', '$content', :category_id, :brand_id)");
                    $stm3->bindParam(":category_id", $_POST['category_drop']);
                    $stm3->bindParam("brand_id", $_SESSION['brand_insert']);
                    if ($stm3->execute()) {
                        $_SESSION['lastInsertPicture'] = $stm3 = $db->lastInsertId();
                    }
                    $stm = $db->prepare("insert into user_picture_inspos (user_id, picture_inspo_id) VALUES (:user_id, :last_insert_picture)");
                    $stm->bindParam(":user_id", $_SESSION['id']);
                    $stm->bindParam(":last_insert_picture", $_SESSION['lastInsertPicture']);
                    if ($stm->execute()) {



                        $stm5 = $db->prepare("insert into product_inspos (picture_inspo_id, category_id) VALUES (:picture_inspo_id, :category_id)");
                        $stm5->bindParam(":picture_inspo_id", $_SESSION['lastInsertPicture']);
                        $stm5->bindParam(":category_id", $_POST['category_drop']);
                        if ($stm5->execute()) {
                            $stm2 = $db->prepare("select * from product_inspos where picture_inspo_id=:picture_inspo_id");
                            $stm2->bindParam(":picture_inspo_id", $_SESSION['lastInsertPicture']);

                            $this->ShowSelectProductsAction();
                        }
                    }
                }
                else{
                    header("location:../start/index?msgError=empty");
                }
            }
            else{
                header("location:../start/index?msgError=empty");
            }
        }

        else {
            header("location:../start/index?msgError=empty");
        }
    }



    public function GetSearchAction(){
        if (isset($_GET['submit_search'])) {

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products
            join categories on products.category_id=categories.category_id
            join brands on products.brand_id=brands.brand_id
            join product_pictures on products.product_id=product_pictures.product_id
            join pictures on product_pictures.picture_id=pictures.picture_id
            where product_name LIKE '%$_GET[search_clothes]%' OR price LIKE '%$_GET[search_clothes]%' OR description LIKE '%$_GET[search_clothes]%' OR category LIKE '%$_GET[search_clothes]%' OR brand LIKE '%$_GET[search_clothes]%'");

            $stm->bindParam(":product_name",$_GET['search_clothes']);
            $stm->bindParam(":price",$_GET['search_clothes']);
            $stm->bindParam(":description",$_GET['search_clothes']);
            $stm->bindParam(":category",$_GET['search_clothes']);
            $stm->bindParam(":brand",$_GET['search_clothes']);
            if($stm->execute()){

                $result = $stm->fetchAll();

                require_once './views/search.php';
                if ($stm->rowCount() == 0) {
                    echo '<div class="wrap_search">';
                    echo '<div class="empty_search_div">';
                    echo "<p class='empty_search'>No result was found...</p>";
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <style>
                        #search_body{
                            background: url("/fashionable/views/image/blonde-cap-dress-editorial-fashion-Favim.com-317020.jpg");
                            background-position: center;
                            background-repeat: no-repeat;
                        }
                        .empty_search_div{
                            opacity: 0.6;
                            background-color: #000000;
                            height: 300px;
                            width:400px;
                            margin-left: 470px;
                            border: 1px solid #000000;

                        }
                        .empty_search{
                            z-index: 20;
                            color: white;
                            font-size: 20px;
                            margin-top: 100px;
                        }
                        .wrap_search{
                            padding-top: 100px;
                        }
                    </style>
                <?php
                }
            }
        }
        else{
            header("location:../start/index?msgSearch=empty");
        }
    }

    public function showCategoryAction(){
        if(isset($_GET['GetCategory'])){
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products JOIN product_pictures on products.product_id=product_pictures.product_id
                               join pictures on product_pictures.picture_id=pictures.picture_id where category_id=:category_id");
            $stm->bindParam(":category_id", $_GET['GetCategory']);

            if($stm->execute()){
                $res=$stm->fetchAll();
                require_once './views/Category.php';
            }}
        else{
            header("location:../start/index?msgSearch=empty");
        }
    }
    public function GetColorAction(){
        if(isset($_GET['blackSubmit'])){
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products JOIN product_pictures on products.product_id=product_pictures.product_id
                               join pictures on product_pictures.picture_id=pictures.picture_id where color_id=3 ORDER BY RAND()");
            if($stm->execute()){
                $res=$stm->fetchAll();
                require_once './views/colorblack.php';
            }
        }
        if(isset($_GET['whiteSubmit'])){

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products JOIN product_pictures on products.product_id=product_pictures.product_id
                               join pictures on product_pictures.picture_id=pictures.picture_id where color_id=4 ORDER BY RAND()");
            if($stm->execute()){
                $result=$stm->fetchAll();
                require_once './views/colorWhite.php';
            }
        }
        if(isset($_GET['greenSubmit'])){
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products JOIN product_pictures on products.product_id=product_pictures.product_id
                               join pictures on product_pictures.picture_id=pictures.picture_id where color_id=6 ORDER BY RAND()");
            if($stm->execute()){
                $result=$stm->fetchAll();
                require_once './views/colorgreen.php';
            }
        }

        if(isset($_GET['beigeSubmit'])){
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm=$db->prepare("select * from products JOIN product_pictures on products.product_id=product_pictures.product_id
                               join pictures on product_pictures.picture_id=pictures.picture_id where color_id=5 ORDER BY RAND()");
            if($stm->execute()){
                $result=$stm->fetchAll();
                require_once './views/colorbeige.php';
            }
        }
        else{
            header("location:../start/index?msgSearch=empty");
        }
    }
    public function GetThisPictureAction(){
        if(isset($_GET['id_data'])){
            header('Content-Type: application/json');

            $id=$_GET['id_data'];
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");

            $stm2 = $db->prepare("SELECT * FROM `picture_inspos`
                                  join categories on picture_inspos.category_id=categories.category_id
                                  join brands on picture_inspos.brand_id=brands.brand_id WHERE picture_inspo_id= :picture_inspo_id");

            $stm=$db->prepare("select * from extend_product_inspos
                               join products on extend_product_inspos.product_id=products.product_id
                               join product_pictures on products.product_id=product_pictures.product_id
                                join pictures on product_pictures.picture_id=pictures.picture_id
                                where picture_inspo_id=:picture_inspo_id
              ");
            $stm->bindParam(":picture_inspo_id",$id);
            $stm2->bindParam(":picture_inspo_id",$id);

            if ($stm2->execute()) {
                $stm->execute();

                $result1 = $stm->fetchAll();
                $result = $stm2->fetchAll();

                $dcounts=Array();
                $response=array_merge($result, $result1);

                foreach($response as $row1) {
                    $dcounts[] = $row1['name'];

                }
                $arr=json_encode($dcounts);
                echo $arr;

            }
        }

        else {
            header("location:../start/index?msgError=empty");
        }
    }
    public function GetAllPicturesAction(){
        //if (isset($_GET['showAll'])) {
        //if (isset($_SESSION['status']) == "customers_inloggad") {
        $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
        $stm1 = $db->prepare("select * from  picture_inspos join user_picture_inspos on picture_inspos.picture_inspo_id=user_picture_inspos.picture_inspo_id
                                      join categories on picture_inspos.category_id=categories.category_id
                                      join brands on picture_inspos.brand_id=brands.brand_id");
        if ($stm1->execute()) {

            $res = $stm1->fetchAll();

            require_once './views/pictureInspo.php';

            if ($stm1->rowCount() == 0) {

                echo '<div class="wrap_this">';
                echo '<div class="empty_div">';
                echo "<p class='empty_cart'>You don't have any photos yet...</p>";
                echo '</div>';
                echo '</div>';
                ?>
                <style>
                    #inspo_body{
                        background: url("/fashionable/views/image/blonde-cap-dress-editorial-fashion-Favim.com-317020.jpg");
                        background-position: center;
                        background-repeat: no-repeat;
                    }
                    .empty_div{
                        opacity: 0.6;
                        background-color: #000000;
                        height: 300px;
                        width:400px;
                        margin-left: 470px;
                        border: 1px solid #000000;

                    }
                    .empty_cart{
                        z-index: 20;
                        color: white;
                        margin-top: 100px;
                        font-size: 18px;
                    }
                    .wrap_this{
                        padding-top: 180px;
                    }

                </style>
            <?php

            }
        }
        else {

            header("location:../start/index?msgWrong=empty");
        }
    }

    public function GetAllMyPicturesAction()
    {
        if (isset($_SESSION['status']) == "customers_inloggad") {

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1 = $db->prepare("select * from  picture_inspos join user_picture_inspos on picture_inspos.picture_inspo_id=user_picture_inspos.picture_inspo_id
                                      join categories on picture_inspos.category_id=categories.category_id
                                      join brands on picture_inspos.brand_id=brands.brand_id where user_id=:user_id");
            $stm1->bindParam(":user_id", $_SESSION['id']);

            if ($stm1->execute()) {
                $res = $stm1->fetchAll();

                require_once './views/pictureInspo.php';

                if ($stm1->rowCount() == 0) {
                    echo '<div class="wrap_this">';
                    echo '<div class="empty_div">';
                    echo "<p class='empty_cart'>You don't have any photos yet...</p>";
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <style>
                        #inspo_body{
                            background: url("/fashionable/views/image/blonde-cap-dress-editorial-fashion-Favim.com-317020.jpg");
                            background-position: center;
                            background-repeat: no-repeat;
                        }
                        .empty_div{
                            opacity: 0.6;
                            background-color: #000000;
                            height: 300px;
                            width:400px;
                            margin-left: 470px;
                            border: 1px solid #000000;

                        }
                        .empty_cart{
                            z-index: 20;
                            color: white;
                            margin-top: 100px;
                            font-size: 18px;
                        }
                        .wrap_this{
                            padding-top: 180px;
                        }

                    </style>
                <?php
                }
            }
            else {
                echo 'some unknown error';
            }
        }
        else {
            header("location:../start/index?msgLogin=empty");
        }
    }

}