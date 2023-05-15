<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository implements Interfaces\ContactRepositoryInterface
{

    /**
     * @param array|null $fields
     * @return array Contacts
     */
    public function getAll(array|null $fields): Collection
    {
        return Contact::all()->get($fields);
    }

    /**
     * @param int $id
     * @param array|null $fields
     * @return Contact|null Contact
     */
    public function findById(int $id, array|null $fields): ?Contact
    {
            return Contact::find($id)->get($fields);
    }

    /**
     * @param array $data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * @return void
     */
    public function truncate(): void
    {
        Contact::truncate();
    }
}
