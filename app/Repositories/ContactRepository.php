<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getContacts()
    {
        return Contact::all();
    }

    public function createContact(array $data)
    {
        return Contact::create($data);
    }

    public function deleteContact(string $id)
    {
        return Contact::destroy($id);
    }
}
