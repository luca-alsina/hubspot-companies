<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{

    /**
     * @return array Company
     */
    public function getAll(): array
    {

        return Company::all();

    }

    /**
     * @return array Company with contacts
     */
    public function getAllWithContacts(): array
    {

        return Company::with('contacts')->get();

    }

    /**
     * @param $id int Company ID
     * @return Company|null Company
     */
    public function findById($id): ?Company
    {
            return Company::find($id);
    }

}
