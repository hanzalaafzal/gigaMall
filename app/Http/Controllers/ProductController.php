<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Shop;
use Auth;
use App\Categories;
use App\ProductGallery;
use App\ProductType;
use App\WebmasterSection;
use App\SubCategories;
use App\OrderProducts;
use App\Cart;
use Carbon\Carbon;
use App\wallet;
use App\Favourite;
use App\WalletTransaction;
use App\EditProduct;

class ProductController extends Controller
{
    public function create_slug($slug)
    {
        $slug = strtolower($slug);
        $slug = preg_replace("/[^A-Za-z0-9\-]/", ' ', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $count = 0;
        for ($i = 0; $count == 0; $i++) {
            $check_slug = Product::where('slug', $slug)->get();
            if (count($check_slug) > 0) {
                $slug .= '-' . rand(0, 99);
            } else
                $count = 1;
        }
        return $slug;
    }

    public function create()
    {
        $shops = Shop::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
        $categories = Categories::all();
        $product_types = ProductType::all();
        if (count($shops) > 0) {
            return view('frontEnd.vendor.products.create', compact('categories', 'shops', 'product_types'));
        } else
            return redirect()->route('shopCreate')->with('errorMessage', 'Create Shop to add new Product');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:190',
            'description' => 'required',
            'original_price' => 'required',
            'price' => 'required',
            'shipping_price' => 'required',
            'quantity' => 'required',
            'shop_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'photo' => 'required',
            'product_type' => 'required',
        ]);

        if($request->original_price < $request->price){
             return redirect()->back()->with('errorMessage', 'Something Went Wrong');
        }

        $shop = Shop::where('slug', $request->shop_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', 'Active')
            ->first();
        if (count($shop) == 0) {
            return redirect()->back()->with('errorMessage', 'Something Went Wrong');
        }
        $count = count($shop->products);
        if ($count >= $shop->packages->products) {
            return redirect()->back()->with('errorMessage', 'You reached the limit of max products in this shop.');
        }

        $slug = $this->create_slug($request->title);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->shop_id = $shop->id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->price = $request->price;
        $product->shipping_price = $request->shipping_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->daily_sale = $request->has('daily_sale')?1:0;
        $product->slug = $slug;
        $product->product_type = $request->product_type;
        $product->status = 'Pending';

        if (!empty(request()->file('photo'))) {
            $destinationPath = base_path() . '/public/frontEnd/images/products';
            $extension = request()->file('photo')->getClientOriginalExtension();
            $fileName = 'product-photo-' . time() . rand() . $product->id . '.' . $extension;
            request()->file('photo')->move($destinationPath, $fileName);

            $product->photo = $fileName;
        }
        $product->save();

        if (count(request()->file('gallery_photos')) > 0) {
            foreach (request()->file('gallery_photos') as $mul_image) {
                $destinationPath = base_path() . '/public/frontEnd/images/products/gallery';
                $extension = $mul_image->getClientOriginalExtension();
                $fileName = 'gallery-photo-' . time() . rand() . $product->id . '.' . $extension;
                $mul_image->move($destinationPath, $fileName);

                $gallery = new ProductGallery;
                $gallery->product_id = $product->id;
                $gallery->photo = $fileName;
                $gallery->save();
            }
        }
        return redirect()->route('myProducts')->with('doneMessage', 'Product Added Successfully');
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', '!=', 'Deleted')
            ->where('user_id', Auth::user()->id)
            ->first();
        $edit_product = EditProduct::where('slug', $slug)->where('user_id', Auth::user()->id)->first();
        if (count($edit_product) > 0) {
            $product = $edit_product;
        }
        if (count($product) == 0) {
            return redirect()->back()->with('errorMessage', 'Product Not Found!');
        }
        $shops = Shop::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
        if (count($shops) == 0) {
            return redirect()->back()->with('errorMessage', 'You do not have Active Shop.');
        }
        $categories = Categories::all();
        $subCategories = SubCategories::where('parent_id', $product->category_id)->get();
        $product_types = ProductType::all();

        return view('frontEnd.vendor.products.edit', compact('product', 'shops', 'categories', 'product_types', 'subCategories'));
    }

    public function editGallery($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', '!=', 'Deleted')
            ->where('user_id', Auth::user()->id)
            ->first();
        if (count($product) == 0) {
            return redirect()->back()->with('errorMessage', 'Product Not Found!');
        }
        return view('frontEnd.vendor.products.gallery_edit', compact('product'));
    }

    public function updateGallery(Request $request)
    {
        $product = Product::where('slug', $request->slug)
            ->where('status', '!=', 'Deleted')
            ->where('user_id', Auth::user()->id)
            ->first();
        if (count($product) == 0) {
            return redirect()->back()->with('errorMessage', 'Product Not Found!');
        }
        if ((count($product->galleries) + count(request()->file('gallery_photos'))) > 5) {
            return redirect()->back()->with('errorMessage', 'You have only 5 images space in gallery.');
        }

        if (count(request()->file('gallery_photos')) > 0) {
            foreach (request()->file('gallery_photos') as $mul_image) {
                $destinationPath = base_path() . '/public/frontEnd/images/products/gallery';
                $extension = $mul_image->getClientOriginalExtension();
                $fileName = 'gallery-photo-' . time() . rand() . $product->id . '.' . $extension;
                $mul_image->move($destinationPath, $fileName);

                $gallery = new ProductGallery;
                $gallery->product_id = $product->id;
                $gallery->photo = $fileName;
                $gallery->save();
            }
        }

        return redirect()->back()->with('doneMessage', 'Gallery images updated successfully.');
    }

    public function deleteGallery(Request $request)
    {
        $product = Product::where('slug', $request->slug)
            ->where('status', '!=', 'Deleted')
            ->where('user_id', Auth::user()->id)
            ->first();
        if (count($product) == 0) {
            return redirect()->back()->with('errorMessage', 'Product Not Found!');
        }
        if (count($request->gallery) > 0) {
            foreach ($request->gallery as $gal) {
                $gallery = ProductGallery::where('id', $gal)->where('product_id', $product->id)->first();
                if (count($gallery) > 0) {
                    unlink(base_path() . '/public/frontEnd/images/products/gallery/' . $gallery->photo);
                    $gallery = ProductGallery::where('id', $gal)->where('product_id', $product->id)->delete();
                }
            }
        }

        return redirect()->back()->with('doneMessage', 'Gallery images deleted successfully.');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'original_price' => 'required',
            'price' => 'required',
            'shipping_price' => 'required',
            'quantity' => 'required',
            'shop_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_type' => 'required',
        ]);

        if($request->original_price < $request->price){
             return redirect()->back()->with('errorMessage', 'Something Went Wrong');
        }

        $shop = Shop::where('slug', $request->shop_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', '!=', 'Deleted')
            ->first();
        if (count($shop) == 0) {
            return redirect()->back()->with('errorMessage', 'Something Went Wrong');
        }
        $count = count($shop->products);
        if ($count >= $shop->packages->products) {
            return redirect()->back()->with('errorMessage', 'You reached the limit of max products in this selected shop.');
        }

        $product = EditProduct::where('slug', $request->slug)
            ->where('status', '!=', 'Deleted')
            ->where('user_id', Auth::user()->id)
            ->first();
        if (count($product) == 0) {
            $product = new EditProduct();
        }
        $product->user_id = Auth::user()->id;
        $product->shop_id = $shop->id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->price = $request->price;
        $product->shipping_price = $request->shipping_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_type = $request->product_type;
        $product->slug = $request->slug;

        if (!empty(request()->file('photo'))) {

            $destinationPath = base_path() . '/public/frontEnd/images/products';
            $extension = request()->file('photo')->getClientOriginalExtension();
            $fileName = 'product-photo-' . time() . rand() . $product->id . '.' . $extension;
            request()->file('photo')->move($destinationPath, $fileName);

            $product->photo = $fileName;
        }
        $product->save();

        /*if (count(request()->file('gallery_photos')) > 0) {
            foreach (request()->file('gallery_photos') as $mul_image) {
                $destinationPath = base_path() . '/public/frontEnd/images/products/gallery';
                $extension = $mul_image->getClientOriginalExtension();
                $fileName = 'gallery-photo-'.time().rand(). $product->id . '.' . $extension;
                $mul_image->move($destinationPath, $fileName);

                $gallery = new ProductGallery;
                $gallery->product_id = $product->id;
                $gallery->photo = $fileName;
                $gallery->save();
            }
        }*/

        return redirect()->route('myProducts')->with('doneMessage', 'Product Updated Successfully! Wait for admin approval');
    }

    public function myProducts()
    {
        $count['all'] = Product::where('user_id', Auth::user()->id)->where('status', '!=', 'Deleted')->count();
        $count['active'] = Product::where('user_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['pending'] = Product::where('user_id', Auth::user()->id)->where('status', 'Pending')->count();
        $count['disable'] = Product::where('user_id', Auth::user()->id)->where('status', 'Disable')->count();
        $products = Product::where('user_id', Auth::user()->id)->where('status', '!=', 'Deleted')->paginate(20);
        return view('frontEnd.vendor.products.my_products', compact('products', 'count'));
    }
    public function myProductsActive()
    {
        $count['all'] = Product::where('user_id', Auth::user()->id)->where('status', '!=', 'Deleted')->count();
        $count['active'] = Product::where('user_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['pending'] = Product::where('user_id', Auth::user()->id)->where('status', 'Pending')->count();
        $count['disable'] = Product::where('user_id', Auth::user()->id)->where('status', 'Disable')->count();
        $products = Product::where('user_id', Auth::user()->id)->where('status', 'Active')->paginate(20);
        return view('frontEnd.vendor.products.my_products', compact('products', 'count'));
    }
    public function myProductsPending()
    {
        $count['all'] = Product::where('user_id', Auth::user()->id)->where('status', '!=', 'Deleted')->count();
        $count['active'] = Product::where('user_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['pending'] = Product::where('user_id', Auth::user()->id)->where('status', 'Pending')->count();
        $count['disable'] = Product::where('user_id', Auth::user()->id)->where('status', 'Disable')->count();
        $products = Product::where('user_id', Auth::user()->id)->where('status', 'Pending')->paginate(20);
        return view('frontEnd.vendor.products.my_products', compact('products', 'count'));
    }
    public function myProductsDisable()
    {
        $count['all'] = Product::where('user_id', Auth::user()->id)->where('status', '!=', 'Deleted')->count();
        $count['active'] = Product::where('user_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['pending'] = Product::where('user_id', Auth::user()->id)->where('status', 'Pending')->count();
        $count['disable'] = Product::where('user_id', Auth::user()->id)->where('status', 'Disable')->count();
        $products = Product::where('user_id', Auth::user()->id)->where('status', 'Disable')->paginate(20);
        return view('frontEnd.vendor.products.my_products', compact('products', 'count'));
    }









    /////////////// Admin Functions ////////////////////////

    public function approveList()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::where('status', 'Pending')->orderBy('updated_at', 'acs')->get();
        return view('backEnd.products.list', compact('products', 'GeneralWebmasterSections'));
    }
    public function approve($id)
    {
        $prducts = Product::find($id);
        $prducts->status = 'Active';
        $prducts->save();
        return redirect()->back()->with('doneMessage', 'Prduct Approved Successfully');
    }

    public function editApproveList()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = EditProduct::orderBy('updated_at', 'acs')->get();
        return view('backEnd.products.edit-list', compact('products', 'GeneralWebmasterSections'));
    }

    public function editApprove($id)
    {
        $edit_prduct = EditProduct::find($id);
        $product = Product::where('slug', $edit_prduct->slug)->first();

        $product->shop_id = $edit_prduct->shop_id;
        $product->title = $edit_prduct->title;
        $product->description = $edit_prduct->description;
        $product->price = $edit_prduct->price;
        $product->shipping_price = $edit_prduct->shipping_price;
        $product->quantity = $edit_prduct->quantity;
        $product->category_id = $edit_prduct->category_id;
        $product->sub_category_id = $edit_prduct->sub_category_id;
        $product->product_type = $edit_prduct->product_type;


        if (!empty($edit_prduct->photo)) {
            unlink(base_path() . '/public/frontEnd/images/products/' . $product->photo);
            $product->photo = $edit_prduct->photo;
        }
        $product->save();


        $edit_prduct = EditProduct::where('id', $id)->delete();

        return redirect()->back()->with('doneMessage', 'Edit Product Approved Successfully!');
    }

    public function editDisapprove($id)
    {
        $edit_prduct = EditProduct::where('id', $id)->delete();
        return redirect()->back()->with('doneMessage', 'Edit Product Disabled Successfully!');
    }

    public function disable($id)
    {
        $product = Product::find($id);
        $product->status = 'Disable';
        $product->save();

        $cart = Cart::where('product_id', $product->id)->delete();
        $fav = Favourite::where('product_id', $product->id)->delete();

        return redirect()->back()->with('doneMessage', 'Product Disabled Successfully');
    }

    public function active($id)
    {
        $product = Product::find($id);
        $product->status = 'Active';
        $product->save();

        return redirect()->back()->with('doneMessage', 'Product Active Successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->status = 'Deleted';
        $product->save();

        return redirect()->back()->with('doneMessage', 'Product Deleted Successfully');
    }

    //Details
    public function productsAll()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    public function productsActive()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->where('status', 'Active')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    public function productsPending()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->where('status', 'Pending')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    public function productsDisable()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->where('status', 'Disable')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    public function productsRenewal()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->where('status', 'Renewal')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    public function productsDeleted()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::orderBy('updated_at', 'acs')->where('status', 'Deleted')->paginate(10);

        $count['All'] = Product::count();
        $count['Active'] = Product::where('status', 'Active')->count();
        $count['Disable'] = Product::where('status', 'Disable')->count();
        $count['Pending'] = Product::where('status', 'Pending')->count();
        $count['Renewal'] = Product::where('status', 'Renewal')->count();
        $count['Deleted'] = Product::where('status', 'Deleted')->count();
        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }

    //Search
    public function searchProducts(Request $request)
    {
        return redirect()->route('searchProductsSlug', $request->name);
    }
    public function searchProductsSlug($title)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = Product::where('title', 'like', '%' . $title . '%')->paginate(10);

        return view('backEnd.details.products_list', compact('products', 'GeneralWebmasterSections'));
    }

    //Featured
    public function productsFeaturedCreate($id)
    {
        $product = Product::find($id);
        $product->is_featured = 1;
        $product->save();
        return redirect()->back()->with('doneMessage', 'Prduct Featured!');
    }
    public function productsUnFeatured($id)
    {
        $product = Product::find($id);
        $product->is_featured = 0;
        $product->save();
        return redirect()->back()->with('doneMessage', 'Prduct Removed From Featured!');
    }


    public function editProductAdmin($id)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $product = Product::find($id);
        return view('backEnd.products.edit', compact('product', 'GeneralWebmasterSections'));
    }

    public function updateProductAdmin(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'original_price' => 'required'
        ]);

        // Store Shop
        $product = Product::find($request->id);
        $product->title = $request->name;
        $product->price=$request->price;
        $product->original_price=$request->original_price;
        $product->description = $request->description;
        $product->shipping_price=$request->shipping_price;
        $product->quantity=$request->quantity;
        $product->status=$request->status;
        if($request->has('is_slider')){
          if($request->is_slider=='on'){
            $product->is_slider="1";
          }else{
            $product->is_slider="0";
          }
        }else{
          $product->is_slider="0";
        }
        $product->save();

        return redirect()->back()->with('doneMessage', 'Product updated Successfully!');
    }
    public function approveDeliveredProducts(Request $request)
    {
       $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = OrderProducts::orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = OrderProducts::count();
        $count['Delivered'] = OrderProducts::where('status', 'Delivered')->count();
        $count['Completed'] = OrderProducts::where('status', 'Completed')->count();
        $count['Rejected'] = OrderProducts::where('status', 'Rejected')->count();
        // $count['Disable'] = Product::where('status','Disable')->count();
        // $count['Pending'] = Product::where('status','Pending')->count();
        // $count['Renewal'] = Product::where('status','Renewal')->count();
        // $count['Deleted'] = Product::where('status','Deleted')->count();
        return view('backEnd.details.order_products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }
    public function productsActiveDelivered(Request $request)
    {



        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = OrderProducts::where('status', 'Delivered')->orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = OrderProducts::count();
        $count['Delivered'] = OrderProducts::where('status', 'Delivered')->count();
        $count['Completed'] = OrderProducts::where('status', 'Completed')->count();
        $count['Rejected'] = OrderProducts::where('status', 'Rejected')->count();
        return view('backEnd.details.order_products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }
    public function productsActiveCompleted(Request $request)
    {
        // echo "approve completed products active";die();


        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = OrderProducts::where('status', 'Completed')->orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = OrderProducts::count();
        $count['Delivered'] = OrderProducts::where('status', 'Delivered')->count();
        $count['Completed'] = OrderProducts::where('status', 'Completed')->count();
        $count['Rejected'] = OrderProducts::where('status', 'Rejected')->count();
        return view('backEnd.details.order_products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }
    public function productsDeactiveRejected(Request $request)
    {
        //echo "approve REJECTED products active";die();


        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $products = OrderProducts::where('status', 'Rejected')->orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = OrderProducts::count();
        $count['Delivered'] = OrderProducts::where('status', 'Delivered')->count();
        $count['Completed'] = OrderProducts::where('status', 'Completed')->count();
        $count['Rejected'] = OrderProducts::where('status', 'Rejected')->count();
        return view('backEnd.details.order_products_list', compact('products', 'GeneralWebmasterSections', 'count'));
    }
    public function productsReject($id)
    {

        $rejectProduct = OrderProducts::find($id);
        $rejectProduct->status = "Rejected";
        $rejectProduct->save();
        return redirect()->back()->with('errorMessage', 'Order Product rejected successfully');
    }
    public function productsComplete($id)
    {   $completeProduct = OrderProducts::where('id',$id)->where('status','Delivered')->first();
        if(count($completeProduct) < 1)
        {
            return redirect()->back()->with('errorMessage', 'No product found');

        }
        $completeProduct->status = "Completed";
        $completeProduct->save();
        $today = Carbon::now()->toDateString();
        $findWalletVendor=wallet::where('user_id',$completeProduct->vendor_id)->first();
        $findWalletVendor->amount+=$completeProduct->product_price*$completeProduct->quantity+$completeProduct->shipping_price*$completeProduct->quantity;
        $findWalletVendor->save();
        $forWalletTransaction=$completeProduct->product_price*$completeProduct->quantity+$completeProduct->shipping_price*$completeProduct->quantity;
       $walletTransaction=WalletTransaction::create(['transaction_type'=>'addition','transaction_amount'=>$forWalletTransaction,'transaction_date'=>$today,'transaction_head'=>'sold Product','user_id'=>$completeProduct->vendor_id]);
        //var_dump($completeProduct);die();
        return redirect()->back()->with('errorMessage', 'Order Product Completed successfully');
    }
    public function backToDelivered($id)
    {

        $rejectProduct = OrderProducts::find($id);
        $rejectProduct->status = "Delivered";
        $rejectProduct->save();
        return redirect()->back()->with('errorMessage', 'Order Product status back to Delivered done');
    }
    public function editOrderProductAdmin($id)
    {
//  echo "edit";echo $id;die();
 $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
 $product = OrderProducts::find($id);
 if(count($product)==0){
 return redirect()->route('approveDeliveredProducts')->with('errorMessage', 'No Product found');
 }
 return view('backEnd.products.edit-order-product', compact('product', 'GeneralWebmasterSections'));
    }
    public function editApprovedProductAdmin(Request $request)
    {

$input=$request->all();
//var_dump($input);die();
$fetchOrderProduct=OrderProducts::find($input['id']);
$fetchOrderProduct->product_price=$input['product_price'];
$fetchOrderProduct->shipping_price=$input['shipping_price'];
$fetchOrderProduct->quantity=$input['quantity'];
$fetchOrderProduct->save();
return redirect()->back()->with('doneMessage', 'Fields updated successfully');


    }
}
