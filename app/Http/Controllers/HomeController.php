<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{

    public function index()
    {
        $products   =   Product::all();
        return view('home',compact('products'));
    }
    public function product_details($name)
    {
        $related_prod   = Product::where('name','!=',$name)->get();
        $product        = Product::where('name', $name)->firstOrFail();
        return view('product_details',compact('product','related_prod'));
    }
    public function PaymentDetails(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $price      = $request->input('price');
        $customer   = Customer::create(array(
    
                "address" => [
                        "line1"         => "Periyar Bus Stand",
                        "postal_code"   => "62501",
                        "city"          => "Madurai",
                        "state"         => "Tamilnadu",
                        "country"       => "IN",
                    ],
    
                "email"     => "task@gmail.com",
                "name"      => "John",
                "source"    => $request->stripeToken
             ));
    
      
    
        Charge::create ([
                "amount"        => $price * 100,
                "currency"      => "inr",
                "customer"      => $customer->id,
                "description"   => "Test payment.",
                "shipping"      => [
                  "name"            => "Airtel TeleCom Pvt",
                  "address"         => [
                    "line1"         => "Near Yadavar College, Thiruppalai",
                    "postal_code"   => "625014",
                    "city"          => "Madurai",
                    "state"         => "Tamil Nadu",
                    "country"       => "INDIA",
                  ],
                ]
        ]);

        return redirect('/')->with('flash_message', ['success','Payment Successfully Completed']);    
    }

}