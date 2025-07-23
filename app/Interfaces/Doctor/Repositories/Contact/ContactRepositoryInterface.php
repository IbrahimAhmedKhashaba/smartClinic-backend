<?php

namespace App\Interfaces\Doctor\Repositories\Contact;

interface ContactRepositoryInterface
{
    //
    public function getAllContacts();
    public function getContactById($id);
    public function destroyContact($contact);
}
