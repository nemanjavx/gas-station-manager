<?php

    namespace GSManager\BLogic\Stock;

    use GSManager\Domain\Repository\IStockRepository;

    class UpdateStock
    {
        private $repository;
        private $requestData;
        private $result;

        public function __construct(IStockRepository $repository)
        {
            $this->repository = $repository;
        }

        public function update()
        {
            $this->requestData["gas_station_id"] = $_POST["gstation"];
            $this->requestData["fuel_id"] = $_POST["fuel"];
            $this->requestData["amount"] = $_POST["amount"];

            $this->checkAlreadyExists();

            if ($this->result["success"]) {
            
                $dbResult = $this->repository->update($this->requestData);

                if ($dbResult["success"] && $dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = $dbResult["error"];
                }
            }

                return $this->result;

        }

        public function checkUserGasStation($userID, $gsID)
        {
            $dbResult = $this->repository->checkUserGasStation($userID, $gsID);
            
            if ($dbResult["success"]) {

                if ($dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = "You are not allowed to update stock for this Gas Station.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }

            return $this->result;
        }

        private function checkAlreadyExists()
        {
            $dbResult = $this->repository->alreadyExists(
                $this->requestData["gas_station_id"],
                $this->requestData["fuel_id"]);

            if ($dbResult["success"]) {
                
                // If true, stock exists
                if ($dbResult["result"]) {

                    $this->result["success"] = true;

                } else {

                    $this->result["success"] = false;
                    $this->result["error"] = "Stock does not exists.";
                }

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }
        }

    }