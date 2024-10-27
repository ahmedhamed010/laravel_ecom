<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;

class HomeController extends Controller
{



    public function index()
    {
        
        $count = Contact::where('view' , 0)->get()->count();
        $users = User::where('usertype' , 'user')->get()->count();
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $deliverds = Order::where('status' , 'delivered')->get()->count();
        return view('admin.index' , compact('users' , 'products' , 'orders' , 'deliverds' , 'count'));

    }


    public function home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.index', compact('product' , 'count'));
    }
    

    public function login_home()
    {

        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.index', compact('product' , 'count'));

    }


    public function product_details($id)
    {

        $data = Product::findOrFail($id);
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.product_details' , compact('data' , 'count'));

    }


    public function add_cart($id)
    {

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart ;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        return redirect()->back();

    }


    public function mycart()
    {

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
            $cart = Cart::where('user_id' , $userid)->get();
        }
        return view('home.mycart' , compact('count' , 'cart'));

    }


    public function delete_product($id)
    {
        $data = Cart::findOrFail($id);
    
        // التحقق مما إذا كانت الصور موجودة وهي بتنسيق JSON
        if ($data->images) {
            $images = json_decode($data->images);
    
            // حذف كل صورة على حدة
            foreach ($images as $image) {
                $image_path = public_path('products/'.$image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }
    
        // حذف الكارت من قاعدة البيانات
        $data->delete();
    
        return redirect()->back();
    }


    public function confirm_order(Request $request )
    {

        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id' , $userid)->get(); 

        foreach($cart as $carts){
            $order = new Order ;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();
        }
        $cart_remove = Cart::where('user_id' , $userid)->get();
        foreach ($cart_remove as $remove) {
            $data = Cart::findOrFail($remove->id);
            $data->delete();
        }

        return redirect()->back();        

    }
    

    public function my_orders()
    {

        $user = Auth::user()->id;
        $count = Cart::where('user_id' , $user)->get()->count();
        $order = Order::where('user_id' , $user)->get();
        return view('home.orders' , compact('count' , 'order'));

    }


    public function stripe($value)

    {

        return view('home.stripe' , compact('value'));

    }


    public function stripePost(Request $request , $value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from complete" 

        ]);

        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone = Auth::user()->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id' , $userid)->get(); 

        foreach($cart as $carts){
            $order = new Order ;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->payment_status = "paid";
            $order->save();
        }
        $cart_remove = Cart::where('user_id' , $userid)->get();
        foreach ($cart_remove as $remove) {
            $data = Cart::findOrFail($remove->id);
            $data->delete();
        }

        return redirect('mycart');

    }


    public function shop()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.shop', compact('product' , 'count'));
    }


    public function why()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.why', compact( 'count'));
    }


    public function testimonial()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.testimonial', compact( 'count'));
    }


    public function contact()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id' , $userid)->count();
        }else{
            $count = '';
        }
        return view('home.contact', compact( 'count'));
    }


    public function contact_store(Request $request)
    {

        $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email',
            'phone'=>'required|numeric|digits:11',
            'message'=>'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success' , 'Your Message Has Been Sent Successfully' );

    }
























    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
