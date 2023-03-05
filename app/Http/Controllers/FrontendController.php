<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    public function index ()
    {
        try {
            $merchantCode   = 'DS12776';
            $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
            $duitkuConfig = new \Duitku\Config($merchantKey, $merchantCode);
            $duitkuConfig->setSandboxMode(true);
            $duitkuConfig->setSanitizedMode(false);
            $duitkuConfig->setDuitkuLogs(true);
            $paymentAmount = "100000";
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
        $products = Product::with('assets', 'category')
            ->latest()
            ->take(4)

            ->where('is_front', true)
            ->get();

        $posts = Post::latest()->take(2)->get();

        return view('frontend.index',  compact('products', 'posts', 'paymentMethodList'));
    }    

   
}
