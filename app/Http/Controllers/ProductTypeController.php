<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\WebmasterSection;

class ProductTypeController extends Controller
{
    public function index(){
    	$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    	$ProductTypes = ProductType::all();
    	return view('backEnd.productTypes.create',compact('ProductTypes','GeneralWebmasterSections'));
    }
    public function store(Request $request){
    	$this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:product_types',
        ]);

        $ProductType = new ProductType();
        $ProductType->name = $request->name;
        $ProductType->slug = strtolower($request->slug);
        $ProductType->save();

        return redirect()->back()->with('doneMessage','ProductType Created Successfully.');
    }

    public function edit($slug){
    	$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    	$ProductType = ProductType::where('slug',$slug)->first();
    	return view('backEnd.productTypes.edit',compact('ProductType','GeneralWebmasterSections'));   	
    }

    public function update(Request $request){
    	$this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:shop_types',
        ]);

        $ProductType = ProductType::find($request->id);
        $ProductType->name = $request->name;
        $ProductType->slug = strtolower($request->slug);
        $ProductType->save();

        return redirect()->route('productType')->with('doneMessage','ProductType Updated Successfully.');
    }

    public function delete($id){
    	$ProductType = ProductType::find($id);
    	$ProductType->delete();
    	return redirect()->back()->with('doneMessage','ProductType Deleted Successfully.');
    }
}
