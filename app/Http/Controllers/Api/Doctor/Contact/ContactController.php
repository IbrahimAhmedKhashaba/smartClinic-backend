<?php

namespace App\Http\Controllers\Api\Doctor\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Contact\ContactRequest;
use App\Interfaces\Doctor\Services\Contact\ContactServiceInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    private $ContactService;
    public function __construct(ContactServiceInterface $ContactService)
    {
        $this->ContactService = $ContactService;
    }
    public function index()
    {
        return $this->ContactService->getAllContacts();
    }
    public function show($id)
    {
        // Logic to delete a Contact
        return $this->ContactService->getContactById($id);
    }
    public function destroy($id)
    {
        // Logic to delete a Contact
        return $this->ContactService->destroyContact($id);
    }
}
