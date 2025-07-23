<?php

namespace App\Http\Controllers\Api\WebSite\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Interfaces\WebSite\Services\Contact\ContactServiceInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactService;
    public function __construct(ContactServiceInterface $contactService){
        $this->contactService = $contactService;
    }
    public function __invoke(ContactRequest $request)
    {
        //
        return $this->contactService->sendMessage($request->all());
    }
}
