<?php
    namespace controllers;

    use models\User as User;
    use controllers\CineController as CineController;

    class UserController {

        public function showLoginView()
        {
            require_once(VIEWS_PATH . "login.php");
        }

        public function login() 
        {
            if($_POST)
            {
                $user = $_POST['user'];
                $password = $_POST['password'];

                if(($user == "admin") && ($password == "123456"))
                { 
                    session_start();

                    $loggedUser = new User($user, $password);

                    $_SESSION['loggedUser'] = $loggedUser;

                    $cineController = new CineController();

                    $cineController->showAddView();
                }
                else
                {  
                    $alert = "error";
                    require_once(VIEWS_PATH . "login.php");
                    echo '<script type="text/javascript">';
                    echo ' alert("Usuario y/o contraseña no válidos!")';
                    echo '</script>';
                }
            }
        }

        public function logOut()
        {
            session_start();
    
            session_destroy();

            require_once(VIEWS_PATH . "index.php");
        } 
    }
?>