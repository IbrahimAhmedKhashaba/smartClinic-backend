<?php

namespace App\Interfaces\Doctor\Services\Contact;

interface ContactServiceInterface
{
    //
    public function getAllContacts();
    public function getContactById($id);
    public function destroyContact($id);
}
