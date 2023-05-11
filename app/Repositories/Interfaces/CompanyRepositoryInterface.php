<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;

interface CompanyRepositoryInterface
{

    public function getAll() : array;

    public function getAllWithContacts() : array;

    public function findById($id) : ?Company;

}
