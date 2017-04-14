<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index() {
    	try {
    		//Auth::user() returns the currently logged in user as a App\User. We can access it's relationships quickly by called the associated method as if it were a property. So User->contacts is the same as User->contacts()->get(). COOL!
    		return response()->json(Auth::user()->contacts, 200);
    	} catch (\Exception $e) {
    		return response(null, 500);
    	}
    }

    public function show(Contact $contact) {
    	try {
    		if(Auth::user()->id == $contact->user_id) return response(null, 403);
    		return response()->json(["contact" => $contact], 200);
    	} catch (\Exception $e) {
    		return response(null, 500);
    	}
    }

    public function store(StoreContactRequest $request) {
    	try {
    		//create a new contact using only the values provided!!
    		$contact = Contact::create(array_merge($request->intersect(['addr_first_name', 'addr_last_name', 'addr_email_1', 'addr_email_2', 'addr_phone_1', 'addr_phone_2', 'addr_city', 'addr_region']), ['user_id' => Auth::user()->id]));
    		return response()->json(["contact" => $contact], 201);
    	} catch (\Exception $e) {
    		return response(null, 500);
    	}
    }

    public function update(StoreContactRequest $request, Contact $contact) {
    	try {
    		if(Auth::user()->id != $contact->user_id) return response(null, 403);
    		$contact->update([
                            'addr_first_name'   => request()->input('addr_first_name'),
                            'addr_last_name'    => request()->input('addr_last_name'),
                            'addr_email_1'      => request()->input('addr_email_1'),
                            'addr_email_2'      => request()->input('addr_email_2'),
                            'addr_phone_2'      => request()->input('addr_phone_2'),
                            'addr_phone_1'      => request()->input('addr_phone_1'),
                            'addr_city'             => request()->input('addr_city'),
                            'addr_region'       => request()->input('addr_region')
                        ]);
    		return response(null, 204);
    	} catch (\Exception $e) {
    		return response(null, 500);
    	}
    }

    public function destroy(Contact $contact) {
    	try {
    		if(Auth::user()->id != $contact->user_id) return response(null, 403);
    		$contact->delete();
    		return response(null, 204);
    	} catch (\Exception $e) {
    		return response(null, 500);
    	}
    }
}
