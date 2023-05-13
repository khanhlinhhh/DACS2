<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class CheckoutController extends Controller
{
   public function index()
   {
    return view('frontend.checkout.index');
   }
}
