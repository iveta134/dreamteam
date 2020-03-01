<?php
class Controller
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    private function getReq()
    {
        // if (basename($_SERVER['PHP_SELF']) === 'register.php') {
        if (isset($_GET['register'])) {
            echo "Processing register get";
            $this->model->getRegister();
            return;
        }

        //so this would be default index.php
        if (isset($_GET['songname'])) {
            $this->model->getSongs($_GET['songname']);
        } else {
            $this->model->getSongs();
        }
    }

    private function postReq()
    {
        // if (basename($_SERVER['PHP_SELF']) === 'register.php') {
        if (isset($_POST['RegBtn'])) {
            // echo "Processing register post";
            $this->model->addNewUser();
            return;
        }

        // echo "POST Request<hr>";
        // var_dump($_POST);
        if (isset($_POST['addBtn'])) {
            $this->model->addSongs();
        } elseif (isset($_POST['delForm'])) {
            // var_dump($_POST);
            $this->model->deleteSongs();
        } elseif (isset($_POST['updateBtn'])) {
            $this->model->updateSongs();
            // var_dump($_POST);
            // $this->model->updateSongs();
        } else {
            echo "What button did you press??";
            var_dump($_POST);
        }

    }

    private function checkCookie()
    {
        if (isset($_COOKIE['uid'])) {
            $_SESSION['id'] = $_COOKIE['uid']; //NOT SAFE need to encrypt and check against encrypted version!
        }
        //TODO check on safety for setting session id directly
    }

    public function route()
    {
        $this->checkCookie();
        //GETS are for retrieval only
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->getReq();
        }
        //POSTs are for changing something
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->postReq();
        }

    }
}