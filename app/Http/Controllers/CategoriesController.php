<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\WebmasterSection;
use App\ProductType;
use DB;

class CategoriesController extends Controller
{
    
    public function create()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $categories = Categories::all();
        $types = ProductType::all();
        return view('backEnd.categories.categories',compact('GeneralWebmasterSections','categories','types'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
            'type_id' => 'required',
             'profit_percentage' => 'required|numeric|min:0|max:100'
        ]);

        $category = new Categories();
        $category->name = $request->name;
        $category->slug = strtolower($request->slug);
        $category->type_id = $request->type_id;
        $category->status = 'Active';
        $category->profit_percentage = $request->profit_percentage ?? 0;
        $category->save();

        return redirect()->back()->with('doneMessage','Category Created Successfully.');
    }
    public function active($slug)
    {
        $category = Categories::where('slug',$slug)->firstOrFail();
        $category->status = 'Active';
        $category->save();
        return redirect()->back()->with('doneMessage','Category Active Successfully.');
    }
    public function disable($slug)
    {
        $category = Categories::where('slug',$slug)->firstOrFail();
        $category->status = 'Disable';
        $category->save();
        return redirect()->back()->with('errorMessage','Category Disable Successfully.');
    }
    public function delete($slug)
    {
        $category = Categories::where('slug',$slug)->delete();
        return redirect()->back()->with('doneMessage','Category Deleted Successfully.');
    }
    public function edit($slug)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $category = Categories::where('slug',$slug)->firstOrFail();
        $types = DB::table('product_types')->get();
        return view('backEnd.categories.edit',compact('category','GeneralWebmasterSections','types'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required',
            'type_id' => 'required',
            'profit_percentage' => 'required|numeric|min:0|max:100'
        ]);

        $category = Categories::find($request->id);
        $category->name = $request->name;
        $category->slug = strtolower($request->slug);
        $category->type_id = $request->type_id;
        $category->profit_percentage = $request->profit_percentage ?? 0;
        $category->save();

        return redirect()->route('categories')->with('doneMessage','Category Created Successfully.');
    }

}

