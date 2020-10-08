<?php
    namespace dao;

    use dao\ICinemaDao as ICinemaDao;
    use models\Cinema as Cinema;

    class CinemaDao implements ICinemaDao
    {
        private $cinemaList = array();

        public function Add(Cinema $cinema)
        {
            $this->RetrieveData();
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }

        private function SaveData()
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

        private function RetrieveData()
        {
            $this->cinemaList = array();

            if(file_exists('data/Cinemas.json'))
            {
                $jsonContent = file_get_contents('data/Cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema();
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setCapacity($valuesArray["capacity"]);
                    $cinema->setAdress($valuesArray["adress"]);
                    $cinema->setPrice($valuesArray["price"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>
