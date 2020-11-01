<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use dao\IUserDao as IUserDao;
    use models\User as User;

    class UserDao implements IUserDao
    {
        private $connection;
        private $tableName = "users";

        public function fullUser(User $user) //Busca usuario completo y devuelve
        {
            $userList = array();
            $userList = $this->getAll();

            foreach($userList as $_user)
            {
                if($_user->getUser() == $user->getUser())
                {
                    $fullUser= $_user;
                }
            }

            return $fullUser; 
        }

        public function verifyPassword(User $user) //Verifica password
        {   
            $userList = array();
            $userList = $this->getAll();
            $response= false;

            foreach($userList as $_user)
            {
                if($_user->getUser() == $user->getUser())
                {
                    if($_user->getPassword() == $user->getPassword())
                    {
                        $response= true;
                    }
                }
            }

            return $response;            
        }


        public function searchUser($name) //Verifica si el nombre de usuario ya existe
        {
            $userList = array();
            $userList = $this->getAll();
            $response= false;

            foreach($userList as $_user)
            {
                if($_user->getUser() == $name)
                {
                    $response= true;                    
                }                
            }

            return $response;
        }

   
        //Crear vista para administrar usuarios?????????
        /*public function changeType(User $user, $type)
        {
            $this->getAll();

            foreach($this->userList as $_user)
            {
                if($_user->getUser() == $user->getUser())
                {
                    $_user->setType($type);
                }
            }
            $this->saveData();
        }
        */
  

        public function register(User $user)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (user, password, type) VALUES (:user, :password, :type);";

                $parameters["user"] = $user->getUser();
                $parameters["password"] = $user->getPassword();
                $parameters["type"] = $user->getType();                

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }            
        }


        public function getAll()
        {
            try
            {
                $userList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $user = new User();
                    $user->setUser($fila["user"]);
                    $user->setPassword($fila["password"]);
                    $user->setType($fila["type"]);                    

                    array_push($userList, $user);
                }

                return $userList;                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }        
    }
?>