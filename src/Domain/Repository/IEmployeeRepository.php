<?php

    namespace GSManager\Domain\Repository;

    interface IEmployeeRepository extends IRepository
    {
        public function checkEmployeeID($id);
    }