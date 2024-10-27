<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;

class AdminController extends Controller
{


    // public function index()
    // {

    //     $count = Contact::where('view' , 0)->get()->count();
    //     return ( view('admin.index' , compact('count')));

    // }



    public function view_category()
    {

        $count = Contact::where('view' , 0)->get()->count();
        $data = Category::all();
        return view('admin.category' , compact('data' , 'count'));

    }


    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
    
        // toastr()->timeOut(10000)->closeButton()->success(' Category Added Successfully');
        // toastr()->success('Category Added Successfully.');
        toastr()->target('body')->success('Category Added Successfully.');
    
        return redirect()->back();
    }
    

    public function delete_category($id)
    {

        $data = Category::findOrFail($id);
        $data->delete();
        toastr()->target('body')->success('Category Deleted Successfully.');
        return redirect()->back();

    }


    public function edit_category($id)
    {

        $count = Contact::where('view' , 0)->get()->count();
        $data = Category::findOrFail($id);
        return view('admin.edit_category' , compact('data' , 'count'));

    }


    public function update_category(Request $request , $id)
    {

        $data = Category::findOrFail($id);
        $data->category_name = $request->category ;
        $data->save();
        toastr()->target('body')->success('Category Updated Successfully.');
        return redirect('/view_category');

    }


    public function add_product() 
    {
    
        $count = Contact::where('view' , 0)->get()->count();
        $category = Category::all();
        return view('admin.add_product' , compact('category' , 'count'));

    }


    public function upload_product(Request $request)
    {
        
        $data = new Product;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->description = $request->description;
        $data->quantity = $request->quantity;

        if($request->hasfile('images')){
            $images = [];
            foreach($request->file('images') as $image){
                $imagename = time().'_'.$image->getClientOriginalName();
                $image->move('products', $imagename);
                $images[] = $imagename; // إضافة اسم الصورة إلى المصفوفة
            }
    
            // تخزين أسماء الصور كـ JSON في قاعدة البيانات
            $data->images = json_encode($images);
        }
        
        $data->save();

        return redirect()->back();

    }


    public function view_product()
    {

        $count = Contact::where('view' , 0)->get()->count();
        $product = Product::paginate(3);
        return view('admin.view_product' , compact('product' , 'count'));

    }


    public function delete_product($id)
    {

        $data = Product::findOrFail($id);
        
        // $image_path = public_path('products/'.$data->images);
        // if(file_exists($image_path)){
        //     unlink($image_path);
        // }

        $data->delete();
        return redirect()->back();

    }


    public function update_product($slug)
    {

        $count = Contact::where('view' , 0)->get()->count();
        $data = Product::where('slug' , $slug)->get()->first();
        $category = Category::all();
        return view('admin.update_product' , compact('data' , 'category' , 'count'));

    }


    public function edit_product(Request $request , $id)
    {

        $data = Product::findOrFail($id);
        $data->title = $request->title;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->description = $request->description;
        $data->quantity = $request->quantity;

        if ($request->hasFile('images')) {
            // احذف الصور القديمة إذا كانت موجودة
            if ($data->images) {
                $oldImages = json_decode($data->images);
                foreach ($oldImages as $oldImage) {
                    if (file_exists(public_path('products/' . $oldImage))) {
                        unlink(public_path('products/' . $oldImage));
                    }
                }
            }
        
            // حفظ الصور الجديدة
            $images = [];
            foreach ($request->file('images') as $image) {
                $imagename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imagename);
                $images[] = $imagename;
            }
        
            // حفظ أسماء الصور في قاعدة البيانات كـ JSON
            $data->images = json_encode($images);
        
        } else {
            // احتفظ بالصور القديمة إذا لم يتم رفع صور جديدة
            $data->images = $data->getOriginal('images');
        }        

        $data->save();

        return redirect('/view_product');

    }


    public function product_search(Request $request)
    {
        $search = $request->search;
        
        $count = Contact::where('view' , 0)->get()->count();
        // البحث عن المنتجات بناءً على العنوان أو التصنيف
        $product = Product::where('title', 'like', '%'.$search.'%')
            ->orWhere('category', 'like', '%'.$search.'%')
            ->paginate(3);
    
        // استخدام appends() للحفاظ على قيمة البحث
        return view('admin.view_product', compact('product' , 'count'))->with('search', $search);
    }
    

    public function view_orders()
    {

        $count = Contact::where('view' , 0)->get()->count();
        $data = Order::all();
        return view('admin.orders' , compact('data' , 'count'));

    }

    public function on_the_way($id)
    {

        $data = Order::findOrFail($id);
        $data->status = 'on the way';
        $data->save();
        return redirect('/view_orders');

    }


    public function delivered($id)
    {
        
        $data = Order::findOrFail($id);
        $data->status = 'delivered';
        $data->save();
        return redirect('/view_orders');

    }


    public function print_pdf($id)
    {

        $data = Order::findOrFail($id);
        $pdf = Pdf::loadView('admin.invoice' , compact('data'));
        return $pdf->download('invoice.pdf');

    }


    public function contacts()
    {

        $count = Contact::where('view' , 0)->get()->count();
        $contacts = Contact::orderBy('id' , 'ASC')->paginate(10);
        return view('admin.contact' , compact('contacts' , 'count'));

    }


    public function markAsRead($id)
    {
        $contact = Contact::find($id);
        if ($contact && $contact->view == 0) {
            $contact->view = 1;
            $contact->save();
        }
    
        // بعد التحديث، أعد توجيه المستخدم إلى صفحة الرسائل
        return redirect()->route('contacts');
    }
    
    

    




























    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
