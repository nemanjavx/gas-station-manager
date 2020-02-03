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
            $this->requestData = $_POST;

            $data["gas_station_id"] = $_POST["gstation"];
            $data["fuel_id"] = $_POST["fuel"];
            $data["amount"] = $_POST["amount"];

            $dbResult = $this->repository->update($data);

            if ($dbResult["success"] && $dbResult["result"]) {

                $this->result["success"] = true;

            } else {

                $this->result["success"] = false;
                $this->result["error"] = $dbResult["error"];
            }

            return $this->result;

        }

    }