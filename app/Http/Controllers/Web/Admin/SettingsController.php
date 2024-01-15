<?php
 
namespace App\Http\Controllers\Web\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Models\PaymentSettings;

use Illuminate\Support\Str;
 
class SettingsController extends Controller{

    public function __construct() {
        
    }

    public function payment_settings(Request $request){

        if(isset($_POST['create_payment'])){
            $this->validate($request, [
                'name' => 'required',
                'address' => 'required',
            ]);

            $record = PaymentSettings::where("name", $request->name)->first();

            if($record){
                return back()->with("error", "payment already exist");
            }
            else{
                PaymentSettings::create([
                    "name"=>$request->name,
                    "address"=>$request->address,
                ]);

                return back()->with("success", "Record Added");
            }
            
        }

        if(isset($_POST['edit_payment'])){
            $this->validate($request, [
                'c_id' => 'required',
                'name' => 'required',
                'address' => 'required',
            ]);

            $record = PaymentSettings::where("name", $request->name)->first();

            if($record){
                return back()->with("error", "payment already exist");
            }
            else{
                PaymentSettings::create([
                    "name"=>$request->name,
                    "address"=>$request->address,
                ]);

                return back()->with("success", "Record Added");
            }
            
        }

        if(isset($_POST['delete_payment'])){
            $this->validate($request, [
                'c_id' => 'required',
            ]);

            $record = PaymentSettings::find($request->c_id);

            if($record){
                $record->delete();
                return back()->with("success", "Record Deleted");
            }
            else{
                return back()->with("error", "Record not Found");
            }
            
        }

        $data['page_title'] = "Payment Settings";
        $data['settings'] = PaymentSettings::orderBy('id', 'desc')->get();
        return view('admin/payments', $data);
    }

       
}
