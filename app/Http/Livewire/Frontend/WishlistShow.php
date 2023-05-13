<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
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
    
    public function removeWishlistItem(int $wishlistId)
    {
         Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
         $this->emit('wishlistAddedUpdate');
         session()->flash('message', 'Wishlist item removed successfully');
         $this->dispatchBrowserEvent('close-modal');
         $this->resetInput();

    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}
