<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct() {
        
    }
    public function index(Request $request)
    {

        if (isset($_POST['update_contact'])) {
            $this->validate($request, [
                'c_id' => 'required',
            ]);

            $contact = Contact::find($request->c_id);
            if($contact){

            $contact -> update([
                'mobile_1' => $request->mobile1,
                'mobile_2' => $request->mobile2,
                'address' => $request->address,
                'email' => $request->email,
            ]);
                return back()->with('success', 'Contact created successfully');
            } else {
                return back()->with('error', 'Contact creation failed');
            }
        }

        $data['page_title'] = 'Contacts';
        $data['contacts'] = Contact::all();
        return view('admin/contacts', $data);
    }
}
