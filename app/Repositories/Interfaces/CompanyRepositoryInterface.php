<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{

    public function getAll() : Collection;

    public function getAllWithContacts() : array;

    public function findById(int $id) : ?Company;

    public function searchBy(string $field, string $value) : Collection;

    public function create(array $data) : Company;

    public function getIndustries() : array;

    public function truncate() : void;

}
