<?php

namespace App\Services\WebSite\Contact;

use App\Helpers\ApiResponse;
use App\Interfaces\WebSite\Repositories\Contact\ContactRepositoryInterface;
use App\Interfaces\WebSite\Services\Contact\ContactServiceInterface;
use Illuminate\Support\Facades\Auth;

class ContactService implements ContactServiceInterface
{
    private $contactRepository;
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }
    public function sendMessage($data)
    {
        try {
            if (Auth::guard('patient')->check()) {
                $data['patient_id'] = Auth::guard('patient')->id();
            }
            if (!$this->contactRepository->sendMessage($data)) {
                return ApiResponse::error("Message didn't saved");
            }
            return ApiResponse::success([], 'Message sent successfully', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Internal Error', 500);
        }
    }
}