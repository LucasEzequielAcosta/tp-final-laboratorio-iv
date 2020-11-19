<?php
    namespace controllers;

    use models\User as User;
    use dao\UserDao as UserDao;
    use controllers\HomeController as HomeController;

    class UserController {

        public function showLoginView($message='')
        {
            require_once(VIEWS_PATH . "login.php");
        }

        public function showRegisterView($message='')
        {
            require_once(VIEWS_PATH. "register.php");
        }

        public function login($formUser, $formPassword) 
        {
                $_user= new User($formUser, $formPassword);
                $userDao= new UserDao();

                try{
                    if(($_user->getUser() == "admin") && ($_user->getPassword() == "123456")) //Superadmin default, para poder definir otros admin
                    { 
                        session_start();

                        $_user->setType('admin');
                        

                        $_SESSION['loggedUser'] = $_user;

                        $homeController = new HomeController();

                        $homeController->homeAdmin();                    
                    }

                

                    elseif($userDao->searchUser($_user))
                    {
                        if($userDao->verifyPassword($_user))
                        {
                            session_start();

                            $fullUser = $userDao->fullUser($_user);                            
                            
                            $_SESSION['loggedUser'] = $fullUser[0];

                            $homeController = new HomeController();

                            $homeController->homeUser(); 
                        }

                        else
                        {
                            $message = 'Contraseña errónea!';
                            $this->showLoginView($message);
                        }
                    }

                    elseif(($userDao->searchUser($_user) == false))
                    {
                        $message = 'Usuario no existente!';
                        $this->showLoginView($message);
                    }

                    else
                    {  
                        $message = 'Error no identificado!';
                        $this->showLoginView($message); 
                    }
                }

                catch(\PDOException $ex)
                {
                    $message = 'Error en la Base de Datos!';
                    $this->showLoginView($message);
                }
        }
        

        public function register($formUser, $formPassword)
        {
            
                $newUser= new User($formUser, $formPassword);
                $userDao= new UserDao();
                
                try {
                    
                    if($userDao->searchUser($newUser->getUser()))
                    {
                        $message = 'Usuario ya existente!';
                        $this->showRegisterView($message);
                    }

                    elseif($newUser->getUser() == 'admin')
                    {
                        $message = 'No se puede usar el nombre del SuperAdmin!';
                        $this->showRegisterView($message);
                    }

                    else
                    {
                        $userDao->register($newUser);
                        $message = 'Usuario creado con éxito! Bienvenido ' . $newUser->getUser();
                        $this->showLoginView($message);
                    }
                }

                catch(\PDOException $ex)
                {
                    $message = 'Error en la base de datos!';
                    $this->showRegisterView($message);
                }
            
        }

        public function logOut($message='')
        {
            session_start();
    
            session_destroy();

            require_once(VIEWS_PATH . "login.php");
        } 
    }
?>