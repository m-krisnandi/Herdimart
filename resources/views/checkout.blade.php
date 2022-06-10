@extends('layouts.app')

@section('content')

 <div class="container py-5">
    <div class="row">
        <div class="col-md-6">

           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>

    </tr>
  </thead>
  <tbody>

    @if($cart)
  @php $i=1 @endphp

@foreach($cart->items as $product)
    <tr>
      <th scope="row">{{$i++}}</th>

      <td><img src="{{Storage::url($product['image'])}}" width="100"></td>
      <td>{{$product['name']}}</td>
      <td>Rp. {{$product['price']}}</td>
      <td>
        {{$product['qty']}}
    </td>
      <td>

      </td>
    </tr>
   @endforeach
   @endif



  </tbody>
</table>
<hr>
Total Price: Rp. {{$cart->totalPrice}}
</div>

 	<div class="col-md-6">
 		<div class="card">
 			<div class="card-header">Checkout</div>
 			<div class="card-body">

 	     <form action="{{ route('cart-charge') }}" method="post" id="payment-form">@csrf
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="" value="{{auth()->user()->name}}" readonly="">
                      </div>

                      <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" name="telp" id="telp" class="form-control" required="">
                      </div>

                      <div class="">
              <input type="hidden" name="amount" value="{{$amount}}">
              <div class="mt-5">
                <button type="submit" class="w-100 btn btn-primary">Booking Now</button>
              </div>
        </div>
    </div>
</div>
</div>



<script type="text/javascript">
  // Create a Stripe client.
window.onload=function(){

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  var options={
    name:document.getElementById('name').value,
    address_line1:document.getElementById('telp').value
  }
});
}
</script>
@endsection
