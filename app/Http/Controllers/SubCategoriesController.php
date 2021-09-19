<?php

namespace App\Http\Controllers;

use App\SubCategories;
use Illuminate\Http\Request;
use App\Categories;
use App\WebmasterSection;

class SubCategoriesController extends Controller
{

    public function create()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $categories = Categories::all();
        $subCategories = SubCategories::all();
        return view('backEnd.categories.sub_categories',compact('GeneralWebmasterSections','categories','subCategories'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:sub_categories',
            'parent_category' => 'required',
        ]);

        $category = new SubCategories();
        $category->name = $request->name;
        $category->parent_id = $request->parent_category;
        $category->slug = strtolower($request->slug);
        $category->status = 'Active';
        $category->save();

        return redirect()->back()->with('doneMessage','SubCategory Created Successfully.');
    }
    public function active($slug)
    {
        $category = SubCategories::where('slug',$slug)->firstOrFail();
        $category->status = 'Active';
        $category->save();
        return redirect()->back()->with('doneMessage','Category Active Successfully.');
    }
    public function disable($slug)
    {
        $category = SubCategories::where('slug',$slug)->firstOrFail();
        $category->status = 'Disable';
        $category->save();
        return redirect()->back()->with('doneMessage','Category Disable Successfully.');
    }
    public function delete($slug)
    {
        $category = SubCategories::where('slug',$slug)->delete();
        return redirect()->back()->with('doneMessage','Category Deleted Successfully.');
    }
    public function edit($slug)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $category = SubCategories::where('slug',$slug)->firstOrFail();
        $categories = Categories::all();
        return view('backEnd.categories.sub_edit',compact('category','categories','GeneralWebmasterSections'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:sub_categories',
        ]);

        $category = SubCategories::find($request->id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_category;
        $category->slug = strtolower($request->slug);
        $category->save();

        return redirect()->route('SubCategories')->with('doneMessage','Category Created Successfully.');
    }
}
