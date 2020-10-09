<?php
    namespace dao;

    use dao\ICineDao as ICineDao;
    use models\Cine as Cine;

    class CineDao implements ICineDao
    {
        private $cineList = array();

        public function add(Cine $cine)
        {
            $this->retrieveData();
            
            array_push($this->cineList, $cine);

            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->cineList;
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {
                $valuesArray["name"] = $cine->getName();
                $valuesArray["capacity"] = $cine->getCapacity();
                $valuesArray["adress"] = $cine->getAdress();
                $valuesArray["price"] = $cine->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/cines.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->cineList = array();

            if(file_exists('data/cines.json'))
            {
                $jsonContent = file_get_contents('data/cines.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new Cine();
                    $cine->setName($valuesArray["name"]);
                    $cine->setCapacity($valuesArray["capacity"]);
                    $cine->setAdress($valuesArray["adress"]);
                    $cine->setPrice($valuesArray["price"]);

                    array_push($this->cineList, $cine);
                }
            }
        }
    }
