<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>
            @if($this->totalProductsAmount)

            <div class="row">
                @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <div class="col-md-6">
                    <div class="mb-25">
                        <h4>Billing Details</h4>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <input type="text"  wire:model.defer="fullname" id ="fullname" placeholder="Full Name">
                            @error('fullname') <small class="text-danger">{{$message}}</small> @enderror
                        </div>
                      
                        
                        <div class="form-group">
                            <input type="text" wire:model.defer="address" id="address" placeholder="Address ">
                            @error('address') <small class="text-danger">{{$message}}</small> @enderror
                        </div>  
                        <div class="form-group">
                            <input  type="text" wire:model.defer="phone" id="phone" placeholder="Phone ">
                            @error('phone') <small class="text-danger">{{$message}}</small> @enderror
                        </div>
                        <div class="form-group">
                            <input  type="text" wire:model.defer="email" id="email" placeholder="Email address ">
                            @error('email') <small class="text-danger">{{$message}}</small> @enderror
                        </div>
                        
                        <div class="mb-20">
                            <h5>Additional information</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Order notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                {{-- <thead>
                                    <tr>
                                        
                                        
                                        
                                    </tr>
                                </thead> --}}
                                <tbody>
                                  
                                    
                                    
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{$this->totalProductsAmount}}</span></td>
                                    </tr>
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Payment</h5>
                            </div>
                            <div class="col-md-12 mb-3" wire:ignore>
                                <label>Select Payment Mode: </label>
                                <div class="d-md-flex align-items-start">
                                    <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button wire:loading.attr="disable" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                        <button wire:loading.attr="disable" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                    </div>
                                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                                        <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                            <h6>Cash On Delivery</h6>
                                            <hr/>
                                            <button type="button" wire:loading.attr="disable" wire:click="codOrder" class="btn btn-primary">
                                               <span wire:loading.remove wire:target="codOrder"> Place Order (Cash on Delivery) </span>
                                               {{-- <span wire:loading.remove ="codOrder"> Place Order </span> --}}
                                            </button>

                                        </div>
                                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                            <h6>Online Payment </h6>
                                            <hr/>
                                            {{-- <button type="button" wire:loading.attr="disable" class="btn btn-warning">Pay Now (Online Payment)</button> --}}
                                            <div >
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        {{-- <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button> --}}
                    </div>
                </div>
            </div>       
            @else
                <div class="card card-body shadow tex-center p-md-5">
                <h4> No item in cart to check out</h4>
                <a href="{{url('/collections')}}" class="btn btn-warning">Shop now</a>
            </div>
            @endif

        </div>
    </div>
</div>
</div>

@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AWq2Qm-ha7VKYZWdehVPM4M-VnIPVAtAFVQy3pDyjGr9k9T7b9BjX30-hvsGVb83bGiTQJ820CNevgFN&currency=USD"></script>
    <script>    
        paypal.Buttons({
            onClick: function()  {
            // Show a validation error if the checkbox is not checked
            if (!document.getElementById('fullname').value
                    ||!document.getElementById('address').value
                    ||!document.getElementById('phone').value
                    ||!document.getElementById('email').value
                   
               ) 

            {     
                Livewire.emit('validationForAll');
                return false;
            }else
            {
                @this.set('fullname',document.getElementById('fullname').value);
                @this.set('address',document.getElementById('address').value);
                @this.set('phone',document.getElementById('phone').value);
                @this.set('email',document.getElementById('email').value);
            }
            },
          // Sets up the transaction when a payment button is clicked
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: 0.1 //"{{$this->totalProductsAmount}}"
                //   "{{$this->totalProductsAmount}}" // Can also reference a variable or function
                }
              }]
            });
          },
          // Finalize the transaction after payer approval
          onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
              // Successful capture! For dev/demo purposes:
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              const transaction = orderData.purchase_units[0].payments.captures[0];
              if(transaction.status == "COMPLETED")
              {
                Livewire.emit('transactionEmit',transaction.id);

              }
            //   alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
              // When ready to go live, remove the alert and show a success message within this page. For example:
              // const element = document.getElementById('paypal-button-container');
              // element.innerHTML = '<h3>Thank you for your payment!</h3>';
              // Or go to another URL:  actions.redirect('thank_you.html');
            });
          }
        }).render('#paypal-button-container');
      </script>
@endpush

