<?php
    namespace controllers;

    use models\User as User;
    use dao\UserDao as UserDao;
    use controllers\HomeController as HomeController;

    class UserController {

        public function showLoginView()
        {
            require_once(VIEWS_PATH . "login.php");
        }

        public function showRegisterView()
        {
            require_once(VIEWS_PATH. "register.php");
        }

        public function login() 
        {
            if($_POST)
            {
                $_user= new User($_POST['user'], $_POST['password']);
                $userDao= new UserDao();

                if(($_user->getUser() == "admin") && ($_user->getPassword() == "123456")) //Superadmin default, para poder definir otros admin
                { 
                    session_start();

                    $_user->setType('admin');
                    

                    $_SESSION['loggedUser'] = $_user;

                    $homeController = new HomeController();

                    $homeController->homeAdmin();                    
                }

                elseif($userDao->searchUser($_user->getUser()))
                {
                    if($userDao->verifyPassword($_user))
                    {
                        session_start();
                        
                        $_SESSION['loggedUser'] = $userDao->fullUser($_user);

                        $homeController = new HomeController();

                        $homeController->homeUser(); 
                    }

                    else
                    {
                        require_once(VIEWS_PATH . "login.php");
                        echo '<script> alert("Contraseña errónea!") </script>';
                    }
                }

                elseif(($userDao->searchUser($_user->getUser())) == false)
                {
                    require_once(VIEWS_PATH . "login.php");
                    echo '<script> alert("Usuario no encontrado!") </script>';
                }
                

                else
                {  
                    $alert = "error";
                    require_once(VIEWS_PATH . "login.php");
                    echo '<script> alert("Usuario y/o contraseña no válidos!") </script>'; 
                }
            }
        }
        

        public function register()
        {
            if($_POST)
            {
                $newUser= new User($_POST['user'], $_POST['password']);
                $userDao= new UserDao();
                

                if($userDao->searchUser($newUser->getUser()))
                {
                    require_once(VIEWS_PATH. "register.php");
                    echo '<script> alert("Usuario ya existente!") </script>';
                }

                elseif($newUser->getUser() == 'admin')
                {
                    require_once(VIEWS_PATH. "register.php");
                    echo '<script> alert("No se puede ocupar el nombre del Superadmin") </script>';
                }

                else
                {
                    $userDao->register($newUser);
                    require_once(VIEWS_PATH . "login.php");
                    echo '<script> alert("Usuario registrado exitosamente! Bienvenido '. $newUser->getUser() . ' !") </script>';
                }
            }
        }

        public function logOut()
        {
            session_start();
    
            session_destroy();

            require_once(VIEWS_PATH . "login.php");
        } 
    }
?>