<?php

namespace App\Services\Doctor\Contact;

use App\Helpers\ApiResponse;
use App\Http\Resources\Doctor\ContactResource;
use App\Http\Resources\PatientResource;
use App\Interfaces\Doctor\Repositories\Contact\ContactRepositoryInterface;
use App\Interfaces\Doctor\Services\Contact\ContactServiceInterface;
use Illuminate\Support\Facades\DB;

class ContactService implements ContactServiceInterface
{
    //
    private $contactRepository;
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContacts()
    {
        try {
            $Contacts = $this->contactRepository->getAllContacts();
            return ApiResponse::success([
                'Contacts' => ContactResource::collection($Contacts),
                'meta' => [
                    'current_page' => $Contacts->currentPage(),
                    'last_page' => $Contacts->lastPage(),
                    'per_page' => $Contacts->perPage(),
                    'total' => $Contacts->total(),
                ],
                'links' => [
                    'next' => $Contacts->nextPageUrl(),
                    'prev' => $Contacts->previousPageUrl(),
                ]
            ], 'Contacts fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Contacts', 500);
        }
    }
    public function getContactById($id)
    {
        try {
            $Contact = $this->contactRepository->getContactById($id);
            if (!$Contact) {
                return ApiResponse::error('Contact not found', 404);
            }
            return ApiResponse::success([
                'Contact' => new ContactResource($Contact),
            ], 'Contact fetched successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error fetching Contact', 500);
        }
    }
    public function destroyContact($id)
    {
        try {
            $Contact = $this->contactRepository->getContactById($id);
            if (!$Contact) {
                return ApiResponse::error('Contact not found', 404);
            }
            $Contact = $this->contactRepository->destroyContact($Contact);
            if (!$Contact) {
                return ApiResponse::error('Error deleting Contact', 500);
            }
            return ApiResponse::success([], 'Contact deleted successfully', 200);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error('Error deleting Contact', 500);
        }
    }
}
