<?php

namespace App\Http\Livewire\Frontend\Products;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class View extends Component
{
    
    public $category, $product, $quantityCount =1;

    public function addToCart(int $productId) {
        if(Auth::check()) {
            if($this->product->where('id', $productId)->where('status','0')->exists())
            {
                if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
                {
                    session()->flash('message', 'Product Already Added ');
                    return false;
                }
                else{

                
                    if($this->product->quantity > 0)
                    {

                            if($this->product->quantity > $this->quantityCount)
                            {
                                //Insert product to cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount

                                ]);
                                $this->emit('CartAddedUpdate');

                                session()->flash('message', 'Product Added To Cart Successlly');
                            }
                            else
                            {
                                session()->flash('message', 'Only'.$this->product->quantity.'Quantity Available');
                            }
                    }
                    else
                    {
                        session()->flash('message', 'Out Of Stock');
                    }
                }
            }
            else {
                session()->flash('message', 'Product Does Not Exist');
            }
        }
        else {
            
            session()->flash('message', 'Please Login to continue');
            return false;
        }
    }

    public function addToWishList($productId) {
        if(Auth::check())
        {
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
            {
                session()->flash('message', 'Already added to wishlist');
                return false;
            }
            else{
                 Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdate');

                session()->flash('message', 'Wishlist Added Successlly');
            }
           
        }
        else
        {
            session()->flash('message', 'Please Login to continue');
            return false;
        }
    }

    public function incrementQuantity() {
        if($this->quantityCount <10) {
            $this->quantityCount++;
        }
        
    }
    public function decrementQuantity() {
        if($this->quantityCount >1) {
            $this->quantityCount--;
    }
}
   
    public function mount($category,$product) {
        $this ->category = $category;
        $this ->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.products.view',[
            'category' => $this->category,
            'product' => $this->product,

            
        ]);
    }
}
