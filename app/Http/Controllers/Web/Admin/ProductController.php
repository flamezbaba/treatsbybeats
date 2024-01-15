<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Site;

class ProductController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {

        if (isset($_POST['create_product'])) {

            $this->validate($request, [
                'name' => 'required',
                'desc' => 'required',
                'price' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg',
            ]);

            $picture = null;
            $categories = [];

            if ($request->file('image')) {
                $picture = $request->file('image')->store("products");
            }

            if ($request->categories) {
                $categories = explode(",", $request->categories);
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->desc,
                'price' => Site::fil_amount($request->price),
                'image' => $picture,
                'categories' => $categories,
            ]);

            if ($product) {
                return back()->with('success', 'Product created successfully');
            } else {
                return back()->with('error', 'Product creation failed');
            }
        }

        if (isset($_POST['edit_product'])) {

            $this->validate($request, [
                'id' => 'required',
            ]);

            $id = Product::find($request->id);

            if ($id) {
                $picture = $id->image;
                $categories = $id->categories;

                if ($request->file('image')) {
                    if ($id->image) {
                        Storage::delete($id->image);
                    }

                    $picture = $request->file('image')->store("products");
                }

                if ($request->categories) {
                    $categories = explode(",", $request->categories);
                }

                $id->update([
                    'name' => $request->name,
                    'description' => $request->desc,
                    'price' => Site::fil_amount($request->price),
                    'image' => $picture,
                    'categories' => $categories,
                ]);

                return back()->with('success', 'Product updated successfully');
            } else {
                return back()->with('error', 'Product updated failed');
            }
        }

        if (isset($_POST['delete_product'])) {
            $this->validate($request, [
                'c_id' => 'required',
            ]);

            $id = Product::find($request->c_id);

            if ($id) {
                if ($id->image) {
                    Storage::delete($id->image);
                }
                $id->delete();

                return back()->with("success", "Product Deleted succesfully");
            } else {
                return back()->with("error", "Product not Found");
            }
        }
        
        
        if (isset($_POST['toggle_status'])) {
            $this->validate($request, [
                'c_id' => 'required',
            ]);

            $id = Product::find($request->c_id);

            if ($id) {
                if ($id->is_active == 0) {
                    $id->is_active = 1;
                }
                else{
                    $id->is_active = 0;
                }
                
                $id->save();

                return back()->with("success", "Done ");
            } else {
                return back()->with("error", "Product not Found");
            }
        }


        $data['page_title'] = 'Menu List';
        $data['products'] = Product::orderBy('id', 'desc')->get();
        return view('admin/products', $data);
    }
}
