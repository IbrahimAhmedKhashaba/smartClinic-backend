<?php 

namespace App\Interfaces\WebSite\Repositories\Contact;

interface ContactRepositoryInterface{
    public function sendMessage($data);
}