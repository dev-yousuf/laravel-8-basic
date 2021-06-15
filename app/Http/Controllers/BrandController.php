<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use Image;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

   public function AddBrand(Request $request){
       
       $validatedData = $request->validate(
           [
           'brand_name' => 'required|unique:brands|min:4',
           'brand_image' => 'required|mimes:jpg,jpeg,png',
           ],
           [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Image is Required',
            ]
        );
        
        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_loacation = 'image/brand/';
        // $last_img = $up_loacation.$img_name;
        // $brand_image->move($up_loacation, $last_img);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img = 'image/brand/'.$name_gen;
        Image::make($brand_image)->resize(300, 200)->save($last_img);
        
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function EditBrand($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }
    public function UpdateBrand(Request $request, $id){
       
        $validatedData = $request->validate(
            [
            'brand_name' => 'required|min:4',
            ],
            [
             'brand_name.required' => 'Please Input Brand Name',
            ]
         );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
    
        if($request->hasFile('brand_image')){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_loacation = 'image/brand/';
            $last_img = $up_loacation.$img_name;
            $brand_image->move($up_loacation, $last_img);
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
    
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->route('all.brand')->with('success', 'Brand Update Successfully');

    }

    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        $brand = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Delete Successfully');
    }

    /// This is for Multi Image All Medhods
    public function MultiImage(){
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request){
        // $validatedData = $request->validate(
        //     ['image' => 'required|mimes:jpg,jpeg,png'],
        //     ['image.min' => 'multi Image is Required']
        //  );
        $images = $request->file('image');
        
        foreach($images as $image){
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $last_img = 'image/multi/'.$name_gen;
            Image::make($image)->resize(300, 200)->save($last_img);
            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return Redirect()->back()->with('success', 'Multiple Image Add Successfully');
    }

}
