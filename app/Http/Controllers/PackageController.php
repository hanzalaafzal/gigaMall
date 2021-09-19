<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\WebmasterSection;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $packages = Package::all();
        return view('backEnd.packages.packages',compact('GeneralWebmasterSections','packages'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required',
            'products' => 'required',
        ]);

        $package = new Package();
        $package->name = $request->name;
        $package->price = $request->price;
        $package->products = $request->products;
        $package->status = 'Active';
        $package->save();

        return redirect()->back()->with('doneMessage','Package Created Successfully.');
    }

    public function active($id)
    {
        $package = Package::find($id);
        $package->status = 'Active';
        $package->save();
        return redirect()->back()->with('doneMessage','Package Active Successfully.');
    }
    public function disable($id)
    {
        $package = Package::find($id);
        $package->status = 'Disable';
        $package->save();
        return redirect()->back()->with('doneMessage','Package Disable Successfully.');
    }

    public function edit($id)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
         $package = Package::find($id);
        return view('backEnd.packages.edit',compact('package','GeneralWebmasterSections'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required',
            'products' => 'required',
        ]);

        $package = Package::find($request->id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->products = $request->products;
        $package->save();

        return redirect()->route('shopPackages')->with('doneMessage','Package Updated Successfully.');
    }


}
