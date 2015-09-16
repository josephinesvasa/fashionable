<?php


class CartController{

    public function IndexAction(){
        $this->ShowCartAction();
    }
    public function AddToCartAction(){

        if (!isset($_SESSION['status'])) {

            if (isset($_SESSION['active_cart']) == false) {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm5 = $db->prepare("INSERT INTO shoppingcart VALUES ()");
                if ($stm5->execute()) {
                    $_SESSION['active_cart'] = true;
                    $_SESSION['no_logged_cart_id'] = $stm5 = $db->lastInsertId();
                }

            }

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1=$db->prepare("select * from shoppingcart_products where cart_id=:cart_id and product_id=:product_id");
            $stm1->bindParam(":cart_id",$_SESSION['no_logged_cart_id']);
            $stm1->bindParam(":product_id",$_POST['product_id']);
            $stm1->execute();
            $res=$stm1->fetchAll();
            if(!empty($res)){

                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity +1 WHERE product_id = :product_id and cart_id= :cart_id");
                $stm->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                $stm->bindParam(":product_id", $_POST['product_id'], PDO::PARAM_STR);
                if($stm->execute()){
                    header("location:/fashionable/user/GetAllProducts?added");
                }

            }
            else  {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm6 = $db->prepare("INSERT INTO shoppingcart_products (cart_id, product_id) VALUES (:cart_id, :product_id)");
                $stm6->bindParam(":cart_id", $_SESSION['no_logged_cart_id'], PDO::PARAM_STR);
                $stm6->bindParam(":product_id", $_POST["product_id"], PDO::PARAM_STR);


                if ($stm6->execute()) {
                    header("location:/fashionable/user/GetAllProducts?added");
                }

                else {
                    header("location:/fashionable/start");

                }
            }

        }
        if (isset($_SESSION['status'])) {

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1=$db->prepare("select * from shoppingcart_products where cart_id=:cart_id and product_id=:product_id");
            $stm1->bindParam(":cart_id",$_SESSION['cart_id']);
            $stm1->bindParam(":product_id",$_POST['product_id']);
            $stm1->execute();
            $res=$stm1->fetchAll();
            if(!empty($res)){

                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity +1 WHERE product_id = :product_id and cart_id= :cart_id");
                $stm->bindParam(":cart_id", $_SESSION['cart_id']);
                $stm->bindParam(":product_id", $_POST['product_id'], PDO::PARAM_STR);
                if($stm->execute()){
                    header("location:/fashionable/user/GetAllProducts?added");
                }

            }
            else{
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm = $db->prepare("INSERT INTO shoppingcart_products (cart_id, product_id) VALUES (:cart_id, :product_id)");
                $stm->bindParam(":cart_id", $_SESSION['cart_id'], PDO::PARAM_STR);
                $stm->bindParam(":product_id", $_POST["product_id"], PDO::PARAM_STR);


                if ($stm->execute()) {

                    header("location:/fashionable/user/GetAllProducts?added");
                } else {
                    header("location:/fashionable/start");


                }
            }
        }
    }

    public function ShowCartAction() {

        if (!isset($_SESSION['status']) == "customers_inloggad") {
            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1 = $db->prepare("Select * from shoppingcart_products
                                    join products on shoppingcart_products.product_id=products.product_id
                                    join product_pictures on shoppingcart_products.product_id=product_pictures.product_id
                                    join pictures on product_pictures.picture_id=pictures.picture_id
                                    where cart_id=:cart_id");

            $stm1->bindParam(":cart_id", $_SESSION['no_logged_cart_id'], PDO::PARAM_STR);


            if ($stm1->execute()) {
                $res = $stm1->fetchAll();

                $totallysum = "";
                $sub_price = "";
                $frakt = 29;

                require_once './views/shoppingcart.php';

                if($stm1->rowCount()==true) {

                    echo '<input class="buy_no_logged" onclick="showForm()" type="submit" name="submit_cart" value="Checkout"/>';

                }

                if ($stm1->rowCount() == 0) {
                    echo '<div class="wrap_this">';
                    echo '<div class="empty_div">';
                    echo "<p class='empty_cart'>Your shoppingcart is empty...</p>";
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <style>
                        #body_shoppingcart{
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
                        }
                        .wrap_this{
                            padding-top: 180px;
                        }
                        .back_wrap{
                            display: none;
                        }
                    </style>
                <?php
                }



            } else {
                echo "<p>Some Unknown Error!</p>";

                var_dump($_SESSION);

            }
        } else if (isset($_SESSION['status'])) {

            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm1 = $db->prepare("select * from shoppingcart where cart_id=:cart_id");
            $stm1->bindParam(":cart_id", $_SESSION['cart_id']);
            $stm1->execute();
            $res = $stm1->fetchAll();
            foreach ($res as $row) {
            }
            if ($row['status'] == 0) {
                $stm = $db->prepare("Select * from shoppingcart_products
                                    join products on shoppingcart_products.product_id=products.product_id
                                    join product_pictures on shoppingcart_products.product_id=product_pictures.product_id
                                    join pictures on product_pictures.picture_id=pictures.picture_id
                                    where cart_id=:cart_id");
                $stm->bindParam(":cart_id", $_SESSION['cart_id'], PDO::PARAM_STR);

                if ($stm->execute()) {
                    $result = $stm->fetchAll();
                    $totallysum = "";
                    $sub_price = "";
                    $frakt = 29;


                    require_once './views/shoppingcart.php';
                    if($stm->rowCount()==true) {
                        echo '<form id="submit_cart" method="post" action="/fashionable/cart/SubmitCart">';
                        echo '<input class="buy_logged" type="submit" name="submit_cart" value="Checkout"/>';
                        echo '</form>';
                    }

                    if ($stm->rowCount()==0) {
                        echo '<div class="wrap_this">';
                        echo '<div class="empty_div">';
                        echo "<p class='empty_cart'>Your shoppingcart is empty...</p>";
                        echo '</div>';
                        echo '</div>';
                        ?>
                        <style>
                            #body_shoppingcart{
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
                            }
                            .wrap_this{
                                padding-top: 180px;
                            }
                            .back_wrap{
                                display: none;
                            }
                        </style>
                    <?php
                    }
                }
            }
            else {
                echo "<p>Some unknown error</p>";
            }
        }
    }


    public function DeleteFromCartAction()
    {
        if (isset($_SESSION['status'])) {
            if (isset($_POST['product_id_delete'])) {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm = $db->prepare("DELETE from shoppingcart_products WHERE product_id = :product_id and cart_id= :cart_id");
                $stm->bindParam(":cart_id", $_SESSION['cart_id']);
                $stm->bindParam(":product_id", $_POST['product_id_delete'], PDO::PARAM_STR);

                if ($stm->execute()) {
                    header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                }
            }
            else{
                header("location:/fashionable/start");
            }
        }

        if (!isset($_SESSION['status'])) {
            if (isset($_POST['product_id_delete_non'])) {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm2 = $db->prepare("DELETE from shoppingcart_products WHERE product_id = :product_id and cart_id= :cart_id");
                $stm2->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                $stm2->bindParam(":product_id", $_POST['product_id_delete_non'], PDO::PARAM_STR);

                if ($stm2->execute()) {
                    header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                }
            }
            else
            {
                header("location:/fashionable/start");
            }
        }
    }

    public function UpdateCartAddAction(){
        if(isset($_SESSION['status'])) {
            if (isset($_POST['product_id_update'])) {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity +1 WHERE product_id = :product_id and cart_id= :cart_id");
                $stm->bindParam(":cart_id", $_SESSION['cart_id']);
                $stm->bindParam(":product_id", $_POST['product_id_update'], PDO::PARAM_STR);

                if ($stm->execute()) {
                    header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                }
            }

            else{
                header("location:/fashionable/start");
            }
        }

        if(!isset($_SESSION['status'])){
            if(isset($_POST['product_id_update_non'])){
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm2 = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity +1 WHERE product_id = :product_id and cart_id= :cart_id");
                $stm2->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                $stm2->bindParam(":product_id", $_POST['product_id_update_non'], PDO::PARAM_STR);

                if($stm2->execute()){
                    header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                }
            }
            else{
                header("location:/fashionable/start");
            }
        }

    }

    public function UpdateCartRemoveAction(){
        if(isset($_SESSION['status'])){
            if(isset($_POST['product_id_remove'])){
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm1=$db->prepare("select * from shoppingcart_products where product_id=:product_id and cart_id=:cart_id");
                $stm1->bindParam(":product_id",$_POST['product_id_remove']);
                $stm1->bindParam(":cart_id", $_SESSION['cart_id']);
                if($stm1->execute()) {
                    $res=$stm1->fetchAll();
                    foreach($res as $row) {
                        if ($row['quantity'] == "1") {
                            header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                        }

                        else{
                            $stm = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity -1 WHERE product_id = :product_id and cart_id= :cart_id");
                            $stm->bindParam(":cart_id", $_SESSION['cart_id']);
                            $stm->bindParam(":product_id", $_POST['product_id_remove'], PDO::PARAM_STR);

                            if($stm->execute()){
                                header("location:/fashionable/cart/ShowCart?show_cart=Cart");

                            }
                        }
                    }
                }
            }
        }
        else{
            header("location:/fashionable/start");
        }

        if(!isset($_SESSION['status'])) {
            if (isset($_POST['product_id_remove_non'])) {
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm1 = $db->prepare("select * from shoppingcart_products where product_id=:product_id and cart_id=:cart_id");
                $stm1->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                $stm1->bindParam(":product_id", $_POST['product_id_remove_non']);
                if ($stm1->execute()) {
                    $res = $stm1->fetchAll();
                    foreach ($res as $row) {
                        if ($row['quantity'] == "1") {
                            header("location:/fashionable/cart/ShowCart?show_cart=Cart");
                        } else {

                            $stm2 = $db->prepare("UPDATE shoppingcart_products SET quantity =quantity -1 WHERE product_id = :product_id and cart_id= :cart_id");
                            $stm2->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                            $stm2->bindParam(":product_id", $_POST['product_id_remove_non'], PDO::PARAM_STR);

                            if ($stm2->execute()) {
                                header("location:/fashionable/cart/ShowCart?show_cart=Cart");

                            }
                        }
                    }
                }
            } else {
                header("location:/fashionable/start");
            }
        }
    }
    public function SubmitCartRegAction()
    {
        if (isset($_POST['cart_id'])) {
            if (!isset($_SESSION['status'])) {

                if (empty($_POST["Name"]) && empty($_POST["Lastname"]) && empty($_POST ["Adress"]) && empty($_POST ["Postnr"]) && empty($_POST ["City"])) {
                    header("location:../cart/showcart?msgWrong=empty");
                }
                else{
                    $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                    $stm2 = $db->prepare("Insert into non_users (Name, Lastname, Adress,postnr, city, cart_id) VALUES (:name, :lastname, :adress, :postnr, :city, :cart_id)");
                    $stm2->bindParam(":name", $_POST['Name']);
                    $stm2->bindParam(":lastname", $_POST['Lastname']);
                    $stm2->bindParam(":adress", $_POST['Adress']);
                    $stm2->bindParam(":postnr", $_POST['Postnr']);
                    $stm2->bindParam(":city", $_POST['City']);
                    $stm2->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);

                    if ($stm2->execute()) {
                    }
                    $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                    $stm1 = $db->prepare("UPDATE shoppingcart SET status =1 WHERE cart_id= :cart_id");
                    $stm1->bindParam(":cart_id", $_SESSION['no_logged_cart_id']);
                    if ($stm1->execute()) {
                        session_destroy();
                        session_unset();
                        require_once './views/checkout.php';
                    }
                }
            }
            else{
                header("location:/fashionable/user");
            }
        }

        else {
            header("location:/fashionable/user");
        }
    }

    public function SubmitCartAction(){
        if(isset($_POST['submit_cart'])){

            if ($_SESSION['status']){
                $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
                $stm2 = $db->prepare("UPDATE shoppingcart SET status =1 WHERE cart_id= :cart_id");
                $stm2->bindParam(":cart_id", $_SESSION['cart_id']);
                $stm2->execute();

                $stm3 = $db->prepare("INSERT INTO shoppingcart VALUES ()");
                $stm3->execute();

                $_SESSION['cart_id']=$stm3=$db->lastInsertId();

                $stm1=$db->prepare("insert into user_products (user_id, cart_id) VALUES (:user_id, :cart_id)");
                $stm1->bindParam(":user_id", $_SESSION['id']);
                $stm1->bindParam(":cart_id",$_SESSION['cart_id']);
                $stm1->execute();

                require_once './views/checkout.php';
            }
        }
        else{
            header("location:/fashionable/start");
        }
    }
}
