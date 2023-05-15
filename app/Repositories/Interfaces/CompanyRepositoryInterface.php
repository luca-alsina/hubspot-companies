<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{

    public function getAll() : Collection;

    public function getAllWithContacts() : array;

    public function findById(int $id) : ?Company;

    public function create(array $data) : Company;

    public function getIndustries() : array;

    public function truncate() : void;

}
