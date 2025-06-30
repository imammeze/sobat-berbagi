<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function getContacts();
    public function createContact(array $data);
    public function deleteContact(string $id);
}
