<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Mail\Contacts;
use Mail;

class ContactController extends BaseController
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'subject' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Errors!', $validator->errors());
        }
        $user = auth()->user();
        $contact = new Contact;
        $contact->subject = $request->subject;
        $contact->body = $request->body;
        $contact->customer_id = $user->id;
        $contact->save();
         
        Mail::to("kop@wahfyservices.com")
            ->send(new Contacts($contact));

        return $this->sendResponse($contact, 'Contact Message Sent');
    }
}
