<?php

namespace App\Repositories\Doctor\Contact;

use App\Interfaces\Doctor\Repositories\Contact\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    //
    public function getAllContacts()
    {
        return Contact::with('patient')->paginate(10);
    }
    public function getContactById($id)
    {
        return Contact::find($id);
    }
    public function destroyContact($contact)
    {
        return $contact->delete();
    }
}
