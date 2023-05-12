<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository implements Interfaces\ContactRepositoryInterface
{

    /**
     * @return array Contacts
     */
    public function getAll(): array
    {
        return Contact::all();
    }

    /**
     * @param $id int Contact ID
     * @return Contact|null Contact
     */
    public function findById($id): ?Contact
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
