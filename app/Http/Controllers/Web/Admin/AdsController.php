<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {

        if (isset($_POST['create_ads'])) {

            $this->validate($request, [
                'title' => 'required',
                'position' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg',
            ]);
            
            $picture = $request->file("image")->store("ads");

            $ads = Advert::create([
                'title' => $request->title,
                'position' => $request->position,
                'url' => $request->url,
                'image' => $picture,
            ]);

            if ($ads) {
                return back()->with('success', 'Ads added');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }


        if (isset($_POST['edit_ads'])) {
            $this->validate($request, [
                'id' => 'required',
            ]);

            $id = Advert::find($request->id);

            if ($id) {
                $picture = $id->picture;

                if($request->file("image")){
                    Storage::delete($id->image);
                    $picture = $request->file("image")->store("ads");
                }

                $id->update([
                    'title' => $request->title,
                    'position' => $request->position,
                    'url' => $request->url,
                    'image' => $picture,
                ]);

                return back()->with('success', 'Ads updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }

        $data['page_title'] = 'Adverts';
        $data['adverts'] = Advert::all();
        return view('admin/adverts', $data);
    }
}
