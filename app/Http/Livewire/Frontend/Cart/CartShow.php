<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $totalPrice = 0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData)
        {   
            
            if($cartData->quantity > 1)
            {
                $cartData->decrement('quantity');
                session()->flash('message', 'Quantity cannot be less than 1');
            }
            else{
                session()->flash('message', 'Something Went Wrong');
            }
        }else
        {
            session()->flash('message', 'something went wrong');
        }
    }
    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->product->quantity > $cartData->quantity)
            {
                $cartData->increment('quantity');
                session()->flash('message', 'Quantity update successful');
            }
            else{
                session()->flash('message', 'Only'.$cartData->product->quantity.'Quantity Available');
            }
        }else
        {
            session()->flash('message', 'something went wrong');
        }
    }
    
    public function resetInput(){
        $this->user_id = NULL;
        $this->product_id = NULL;
       
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function openModal() 
    {
        $this->resetInput();
    }
    
    public function removeCartItem(int $cartId)
    {
         Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->delete();
         $this->emit('CartAddedUpdate');
         session()->flash('message', 'Cart item removed successfully');
         $this->dispatchBrowserEvent('close-modal');
         $this->resetInput();

    }
    public function render()
    {
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        // $cart = Cart::orderBy('id','DESC')->paginate(1);
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $cart,
        ]);
    }
   
}
