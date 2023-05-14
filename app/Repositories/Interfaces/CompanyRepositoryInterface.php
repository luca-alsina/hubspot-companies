<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{

    public function getAll() : Collection;

    public function getAllWithContacts() : array;

    public function findById($id) : ?Company;

    public function create(array $data) : Company;

    public function truncate() : void;

}
