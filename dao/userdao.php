<?php
    namespace dao;

    use dao\IUserDao as IUserDao;
    use models\User as User;

    class UserDao implements IUserDao
    {
        private $userList = array();

        public function fullUser(User $user) //Busca usuario completo y devuelve
        {
            $this->getAll();

            foreach($this->userList as $_user)
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
            $this->getAll();
            $response= false;

            foreach($this->userList as $_user)
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
            $this->getAll();
            $response= false;

            foreach($this->userList as $_user)
            {
                if($_user->getUser() == $name)
                {
                    $response= true;                    
                }                
            }

            return $response;
        }

   
        public function changeType(User $user, $type)
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
  

        public function register(User $user)
        {
            $this->getAll();            
            array_push($this->userList, $user);
            $this->saveData();            
        }


        public function getAll()
        {
            $this->retrieveData();

            return $this->userList;
        }


        private function saveData()
        {
            $arrayToEncode= array();

            foreach($this->userList as $user)
            {
                $valuesArray["user"] = $user->getUser();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["type"] = $user->getType();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents('data/users.json', $jsonContent);
        }
        

        private function retrieveData()
        {
            $this->userList = array();

            if(file_exists('data/users.json'))
            {
                $jsonContent = file_get_contents('data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $arrayValue)
                {
                    $user = new User();
                    $user->setUser($arrayValue["user"]);
                    $user->setPassword($arrayValue["password"]);
                    $user->setType($arrayValue["type"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }
?>