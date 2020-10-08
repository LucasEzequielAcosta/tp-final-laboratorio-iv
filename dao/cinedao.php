<?php
    namespace dao;

    use dao\ICineDao as ICineDao;
    use models\Cine as Cine;

    class CineDao implements ICineDao
    {
        private $cinemaList = array();

        public function add(Cine $cine)
        {
            $this->retrieveData();
            
            array_push($this->cinemaList, $cine);

            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->cinemaList;
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["adress"] = $cinema->getAdress();
                $valuesArray["price"] = $cinema->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/Cinemas.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->cinemaList = array();

            if(file_exists('data/Cinemas.json'))
            {
                $jsonContent = file_get_contents('data/Cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cine();
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setCapacity($valuesArray["capacity"]);
                    $cinema->setAdress($valuesArray["adress"]);
                    $cinema->setPrice($valuesArray["price"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
