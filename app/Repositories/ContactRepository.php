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

}
