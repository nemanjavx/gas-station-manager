<?php

    namespace GSManager\BLogic\User;

    use GSManager\BLogic\AbstractGetEntity;
    use GSManager\Domain\Repository\IDataAccess;

    class GetUser extends AbstractGetEntity
    {
        public function __construct(IDataAccess $repository)
        {
            $this->repository = $repository;
        }

        public function get()
        {
            $this->dbGetResult = $this->repository->retrieve();
            $this->removePasswordFromResult();
            $this->removeUnderscoreFromResultKeys();

            return $this->dbGetResult;
        }

        private function removePasswordFromResult()
        {
            if ($this->dbGetResult["success"]) {
   
                foreach ($this->dbGetResult["result"] as &$user) {
                    unset($user["PASSWORD"]);
                }
            }
        }
    }