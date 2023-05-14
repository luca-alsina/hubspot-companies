<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{

    public function getAll() : Collection;

    public function findById($id) : ?Contact;

    public function create(array $data) : Contact;

    public function truncate() : void;

}
