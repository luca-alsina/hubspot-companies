<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Collection;

class ContactRepository implements Interfaces\ContactRepositoryInterface
{

    /**
     * @param array|null $fields
     * @return array Contacts
     */
    public function getAll(): Collection
    {
        return Contact::all();
    }

    /**
     * @param int $id
     * @param array|null $fields
     * @return Contact|null Contact
     */
    public function findById(int $id): ?Contact
    {
            return Contact::find($id);
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
