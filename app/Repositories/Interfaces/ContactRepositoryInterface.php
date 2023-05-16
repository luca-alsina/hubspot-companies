<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{

    public function getAll() : Collection;

    public function findById(int $id) : ?Contact;

    public function create(array $data) : Contact;

    public function truncate() : void;

}
