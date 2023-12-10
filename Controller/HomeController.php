
<?php

require 'Core/Controller.php';

class HomeController extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['user-id'])) {
            header('Location: /login', true, 301);
            exit;
        } else {
            $this->view('Layout/Header');
            $this->view('Home/Home');
            $this->view('Layout/Footer');
        }
    }
}
?>  