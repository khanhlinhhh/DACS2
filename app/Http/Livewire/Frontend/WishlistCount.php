<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class WishlistCount extends Component
{
    public $wislistCount;
    // wishlistAddedUpdate
    protected $listeners = ['wishlistAddedUpdate' => 'checkWishlistCount'];
    public function checkWishlistCount() {
        if(Auth::check()) {
            return $this->wislistCount = Wishlist::where('user_id',auth()->user()->id)->count();
        }else{
            return $this ->wislistCount = 0;
        }
    }
    public function render()
    {  $this -> wislistCount =  $this -> checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            'wislistCount' => $this->wislistCount
        ]);
    }
}
