<?php



require_once 'Core/Controller.php';

class AuthController extends Controller
{
    public function loginForm($test)

    {

        echo $test;

        if (isset($_SESSION['user-id'])) {
            header('Location: /');
            exit;
        } else {

            $this->view('Layout/Header');
            $this->view('Auth/Login');
            $this->view('Layout/Footer');
        }
    }

    public function login()
    {
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';


        if (!$email) {
            $this->view('Layout/Header');
            $this->view('Auth/Login', ['err' => 'enter your email']);
            $this->view('Layout/Footer');
            // header('Location: ?');
            exit;
        }


        require 'Model/User.php';
        $user = User::getUserByEmail($email);

        if (!$user) {
            $this->view('Layout/Header');
            $this->view('Auth/Login', ['err' => 'no acc with this email']);
            $this->view('Layout/Footer');
            // header('Location: ?');
            exit;
        } else {
            $_SESSION['user-id'] = $user['id'];
            if (password_verify($password, $user['password'])) {
                header('Location: /', true, 301);
                exit;
            } else {
                $this->view('Layout/Header');
                $this->view('Auth/Login', ['err' => 'wrong pass']);
                $this->view('Layout/Footer');
                // header('Location: ?');
                exit;
            }
        }
    }
    public function registerForm()
    {

        if (isset($_SESSION['user-id'])) {
            header('Location: /', true, 301);
            exit;
        } else {

            $this->view('Layout/Header');
            $this->view('Auth/Register');
            $this->view('Layout/Footer');
        }
    }
    public function register()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (!$name || !$password || !$email) {
            $this->view('Layout/Header');
            $this->view('Auth/Register', ['err' => 'fill in all inputs.']);
            $this->view('Layout/Footer');
            // header('Location: ? ');
            exit;
        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->view('Layout/Header');
                $this->view('Auth/Register', ['err' => 'wrong email.']);
                $this->view('Layout/Footer');
                // header('Location: ? ');
                exit;
            } else {
                require 'Model/User.php';
                $user = User::createNewUser($name, $email, $password);
                header('Location: /login', true, 301);
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login', true, 301);
        exit;
    }
}
