<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;

interface ContactRepositoryInterface
{

    public function getAll() : array;

    public function findById($id) : ?Contact;

}
