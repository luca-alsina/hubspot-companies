<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{

    /**
     * @return array Company
     */
    public function getAll(): Collection
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
            return Company::with('contacts')->find($id);
    }

    /**
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company
    {
        return Company::create($data);
    }

    /**
     * @return void
     */
    public function truncate(): void
    {
        Company::truncate();
    }
}
