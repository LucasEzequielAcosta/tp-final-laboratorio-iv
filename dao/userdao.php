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
            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE (user="' . $user->getUser() . '");';
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            }

            catch(\PDOException $ex)
            {  
                throw $ex;
            }

            if(!empty($resultSet))            
                return $this->map($resultSet);
            
            else
                return false;
        }

        public function verifyPassword(User $user) //Verifica password
        {   
            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE (user="' . $user->getUser() . '") AND (password="' . $user->getPassword() . '");';
            $response= false;

            try{
                $this->connection = Connection::GetInstance();
                $response = $this->connection->Execute($query);
            }

            catch(\PDOException $ex)
            { 
                throw $ex;
            }

            if($response != false)
                return true;

            else
                return false;
        }


        public function searchUser(User $user) //Verifica si el nombre de usuario ya existe
        {
            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE (user="' . $user->getUser() . '");';
            $response= false;

            try{
                $this->connection = Connection::GetInstance();
                $response = $this->connection->Execute($query);
            }

            catch(\PDOException $ex)
            {  
                throw $ex;
            }

            if($response != false)
                return true;

            else
                return false;
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

            catch (\PDOException $ex)
            {
                throw $ex;
            }            
        }

        protected function map($queryResult)
        {
            $queryResult = is_array($queryResult) ? $queryResult : [];

            $mapping = array_map(function($aux){return new User($aux['user'], $aux['password'], $aux['type']);}, $queryResult);

            return count($mapping) >= 1 ? $mapping : $mapping['0'];
        }


        public function getAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            }

            catch (\PDOException $ex)
            {
                throw $ex;
            }

            if(!empty($resultSet))
                return $this->map($resultSet);

            else   
                return false;
        }        
    }
?>