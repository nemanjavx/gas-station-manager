<?php

    namespace GSManager\Domain\Repository;

    interface IStockRepository extends IRepository
    {
        public function checkUserGasStation($userID, $gsID);
        public function alreadyExists($gsID, $fuelID);
    }