<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;


class Checkoutshow extends Component
{
    public $cartscarts, $totalProductsAmount =0;
    public $fullname, $email, $phone, $address, $payment_mode = 'NULL', $payment_id = 'NULL';

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paiOnlineOrder'
    ]; 
    public function paiOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this ->payment_mode = 'Paid by Paypal';
        $codOrder = $this->placeOrder();
        if($codOrder)
        {
            Cart::where('user_id',auth()->user()->id)->delete();
            session()->flash('message', 'Order Placed Successfully');
        }else
        {
            session()->flash('message', 'Something went wrong');
        }
    }
    public function validationForAll()
    {
        $this->validate();
    }

    public function placeOrder()
    {
         $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'linh'.Str::random(10), 
            'fullname' => $this->fullname,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'address'  => $this->address,
            'status_message'=> 'in progress' ,
            'payment_mode' => $this->payment_mode,
            'payment_id ' => $this->payment_id,
       ]);
       foreach ($this->carts as $cartItem) {
        $orderItems = Orderitem::create([
            'order_id' => $order->id,
            'product_id'=> $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' =>$cartItem->product->selling_price
       ]);
            $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity',$cartItem->quantity);
       return $order;
    }
       
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder)
        {
            Cart::where('user_id',auth()->user()->id)->delete();
            session()->flash('message', 'Order Placed Successfully');
        }else
        {
            session()->flash('message', 'Something went wrong');
        }
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'address' => 'required|string|max:500',
        ];

    }

    public function totalProductsAmount()
    {
        $this->totalProductsAmount =0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductsAmount += $cartItem->product->selling_price * $cartItem->quantity;
            
        }
        return $this->totalProductsAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductsAmount = $this->totalProductsAmount();
        return view('livewire.frontend.checkout.checkoutshow',[
            'totalProductsAmount' => $this->totalProductsAmount
        ]);
    }
}
