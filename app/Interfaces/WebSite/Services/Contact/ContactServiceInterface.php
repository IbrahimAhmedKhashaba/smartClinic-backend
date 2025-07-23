<?php 

namespace App\Interfaces\WebSite\Services\Contact;

interface ContactServiceInterface{
    public function sendMessage($data);
}