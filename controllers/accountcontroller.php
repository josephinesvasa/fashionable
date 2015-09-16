<?php


class AccountController{

    public function indexAction(){
        header("location:/fashionable/start");
    }

    public function loginAction(){

        if (isset($_POST["submit_login"])) {


            $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");
            $stm2 = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stm2->bindParam(":email", $_POST["email"], PDO:: PARAM_STR);

            if($stm2->execute()){
                $result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $hash = $row['password'];
                    if (password_verify($_POST['password'], $hash)) {

                        $_SESSION["status"] = "customers_inloggad";
                        $_SESSION["id"] = $row["user_id"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["customer_name"] = $row['name'];

                        $_SESSION['active_cart'] = false;
                        $stm3 = $db->prepare("INSERT INTO shoppingcart VALUES ()");
                        $stm3->execute();

                        $_SESSION['cart_id'] = $stm3 = $db->lastInsertId();


                        $stm2 = $db->prepare("insert into user_products (user_id, cart_id) VALUES (:user_id, :cart_id)");
                        $stm2->bindParam(":user_id", $_SESSION['id']);
                        $stm2->bindParam(":cart_id", $_SESSION['cart_id']);
                        $stm2->execute();


                        echo "<p id='reg_custom'>welcome{$row["name"]}</p>";
                        echo 'you are logged in';

                        header("location:/fashionable/start");
                    }
                }
            }
            if (!isset($_SESSION["status"])) {

                header("location:../start/index?msgTry=empty");
            }
        }
        else{
            header("location:/fashionable/start");
        }

    }

    public function logoutAction(){
        if (isset($_POST["logout"])) {
            if(isset($_SESSION['status'])) {
                session_destroy();
                session_unset();

                header("location:/fashionable/start");

            }

        }
        if (!isset($_SESSION["status"])=="customers_inloggad") {

            header("location:/fashionable/start");
        }
        else{
            header("location:/fashionable/start");
        }

    }

    public function RegAction(){
        if(!isset($_SESSION['status'])){
            require_once './views/register.php';
        }
        else{
            header("location:/fashionable/start");
        }
    }
    public function LogAction(){
        if(!isset($_SESSION['status'])){
            require_once './views/login.php';
        }
        else{
            header("location:/fashionable/start");
        }
    }

    public function registerAction(){

        if (isset($_POST["submit_register"])) {
            if ($_POST['password'] !== $_POST['password_check']) {
                header("location:../start/index?msgPass=empty");
            }
            if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST ["name"]) && !empty($_POST ["lastname"]) && !empty($_POST ["adress"])  && !empty($_POST ["postnr"]) && !empty($_POST ["city"]))  {


                if (($_POST["password"] == $_POST["password_check"])) {

                    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        $hashPass = password_hash($_POST["password"], PASSWORD_BCRYPT, array("cost" => 11));

                        $db = new PDO("mysql:host=localhost;dbname=fashionable", "root", "");

                        $stm = $db->prepare("INSERT INTO users (email, password,name,lastname, adress, city, postnr ) VALUES (:user_email, :user_password,:user_name,:lastname, :adress, :city, :postnr)");
                        $stm->bindParam(":user_email", $_POST["email"], PDO:: PARAM_STR);
                        $stm->bindParam(":user_password", $hashPass, PDO:: PARAM_STR);
                        $stm->bindParam(":user_name", $_POST["name"], PDO::PARAM_STR);
                        $stm->bindParam(":postnr", $_POST["postnr"], PDO::PARAM_INT);
                        $stm->bindParam(":adress", $_POST["adress"], PDO::PARAM_STR);
                        $stm->bindParam(":city", $_POST["city"], PDO::PARAM_STR);
                        $stm->bindParam(":lastname", $_POST["lastname"], PDO::PARAM_STR);

                        if ($stm->execute()) {

                            header("location:../start/index?msgGood=ok");

                        }
                        else{
                            header("location:../start/index?msgTry=empty");
                        }
                    }
                    else{
                        header("location:../start/index?msgEmail=email");
                    }
                }
            }
            else{
                header("location:../start/index?msgEmpty=empty");
            }
        }
        else{
            header("location:/fashionable/start");
        }
    }
}
