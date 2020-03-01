<?php
class Model
{
    const MODELNAME = "Our data store and methods";
    //no need for outsiders to access our connection
    private $conn = null;
    private $view;

    //type hinting that we need to pass View
    public function __construct($config, View $view)
    {
        $this->view = $view;
        $server = $config['server'];
        $db = $config['db'];
        $user = $config['user'];
        $pw = $config['pw'];
        //we could skip the above 4 and just put the $config[key] directly below
        $this->conn = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pw);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "<hr>Connected Successfully!<hr>";
    }

    public function getItems($itemname = null)
    {
        $userid = 0; //we assume we are not logged in yet
        if (isset($_SESSION['id'])) {
            // die("Need to figure out what to show when user is not logged in");
            $userid = $_SESSION['id'];
            //consider not doing anything maybe
        }
        if ($itemname) {
            $itemname = "%$itemname%";
            $stmt = $this->conn->prepare("SELECT *
                FROM tennisitems
                WHERE name LIKE (:itemname)
                AND (user_id = :uid)");
            $stmt->bindParam(':itemname', $itemname);
            $stmt->bindParam(':uid', $userid);
            //NOT SAFE!! https://xkcd.com/327/
            // $stmt = $this->conn->prepare("SELECT * FROM tracks WHERE name LIKE '%$itemname%'");

        } else {
            $stmt = $this->conn->prepare("SELECT * FROM tennisitems
                WHERE (user_id = :uid)
            ");
            $stmt->bindParam(':uid', $userid);
        }

        //prepare goes here
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //fetchAll might not be that good for large datasets
        $allRows = $stmt->fetchAll();
        //var_dump($allRows);
        //die("For now");
        $this->view->printItems($allRows);
    }

    private function saveImg()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

        }
        if ($uploadOk) {
            return $target_file;
        } else {
            return null;
        }
    }

    public function addItems()
    {
        if (!isset($_SESSION['id'])) {
            die("NOt going to add items before log in");
            //consider not doing anything maybe
        }
        $target_file = null;
        //we check file name for existance
        //https://stackoverflow.com/questions/2958167/how-to-test-if-a-user-has-selected-a-file-to-upload
        if (!empty($_FILES["fileToUpload"]["name"])) {
            // var_dump($_FILES["fileToUpload"]);
            // die();
            $target_file = $this->saveImg();
            // var_dump($_FILES);
            // die('should have saved a file');
        }

        $stmt = $this->conn->prepare("INSERT
                INTO tennisitems (item, firm, description, price, currency, user_id, img_loc)
                VALUES (:itemname, :firm, :description, :price, :currency, :userid, :img_loc)"); //TODO add real user id not fixed
        $stmt->bindParam(':itemname', $_POST['itemname']);
        $stmt->bindParam(':firm', $_POST['firm']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':price', $_POST['price']);
        $stmt->bindParam(':currency', $_POST['currency']);
        $stmt->bindParam(':userid', $_SESSION['id']);
        $stmt->bindParam(':img_loc', $target_file);

        //INSERT INTO `tracks` (`id`, `item`, `firm`, `price`, `description`, `created`,
        //`updated`, `user_id`) VALUES (NULL, 'Waterloo', 'Abba', 'Eurovision', '180', current_timestamp(), current_timestamp(), '')
        $stmt->execute();
        $this->getItems();
    }

    public function deleteItems()
    {
        if (!isset($_SESSION['id'])) {
            return;
        }

        $stmt = $this->conn->prepare("DELETE FROM tennisitems
            WHERE id = (:itemid)
            AND user_id = (:userid)");

        $stmt->bindParam(':itemid', $_POST['delForm']);
        $stmt->bindParam(':userid', $_SESSION['id']);
        $stmt->execute();
        $this->getItems();
        //"DELETE FROM `tracks` WHERE `tracks`.`id` = 14"
    }

    public function updateItems()
    {
        $stmt = $this->conn->prepare("UPDATE tenissitems
                SET name = (:itemName),
                firm = (:firm),
                updated = CURRENT_TIMESTAMP()
                WHERE id = (:itemid)");

        $stmt->bindParam(':itemName', $_POST['name']); //we have <input name="name"
        $stmt->bindParam(':firm', $_POST['firm']); //we have <input name="artist"

        $stmt->bindParam(':itemid', $_POST['updateBtn']);
        $stmt->execute();
        $this->getItems();
        //UPDATE `tracks` SET `name` = 'Ziemelmeitajauka' WHERE `tracks`.`id` = 17
    }

    public function getRegister()
    {
        $this->view->printRegister();
    }

    public function getId($username)
    {
        //return user id or 0 if no such user
        $stmt = $this->conn->prepare("SELECT
        id FROM users
        WHERE (name = :name)
    ");
        $stmt->bindParam(':name', $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            // var_dump($result);
            // die("For now");
            return $result[0]['id'];
        } else {
            return 0;
        }
    }

    public function getHash($username)
    {
        $stmt = $this->conn->prepare("SELECT
        hash FROM users
        WHERE (name = :name)
    ");
        $stmt->bindParam(':name', $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            // var_dump($result);
            // die("For now");
            return $result[0]['hash'];
        } else {
            return 0;
        }
    }

    public function addNewUser()
    {
        if ($this->getHash($_POST['username']) != 0) {
            // die("Got this user already");
            //or possible bad hash
            header('Location: /register.php');
            exit();
        }

        //https://stackoverflow.com/questions/1361340/how-to-insert-if-not-exists-in-mysql
        $stmt = $this->conn->prepare("INSERT INTO `users`
            (`id`, `name`, `email`, `hash`, `created`)
            VALUES (NULL, :name, :email, :hash, current_timestamp())");
        $stmt->bindParam(':name', $_POST['username']);
        $stmt->bindParam(':email', $_POST['email']);
        $hash = password_hash($_POST['pw1'], PASSWORD_DEFAULT);
        $stmt->bindParam(':hash', $hash);

        $stmt->execute();

        $_SESSION['user'] = $_POST['username'];
        $_SESSION['id'] = $this->getId($_POST['username']);

        $this->getItems();
    }
}