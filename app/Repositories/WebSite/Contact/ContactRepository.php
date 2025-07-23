<?php 

namespace App\Repositories\WebSite\Contact;

use App\Interfaces\WebSite\Repositories\Contact\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface{
    public function sendMessage($data){
        return Contact::create($data);
    }
}