@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Order</li>
              <li class="breadcrumb-item active" aria-current="page">Order Tables</li>
            </ol>
          </div>

           	<div class="row justify-content-center">
 		<div class="col-md-8">
 			@foreach($carts as $cart)

 			<div class="card mb-3">
 				<div class="card-body">
 					@foreach($cart->items as $item)
 					<span class="float-right">
 						<img src="{{Storage::url($item['image'])}}" width="100">
 					</span>

 					<p>Name:{{$item['name']}}</p>
 					<p>Price:{{$item['price']}}</p>
 					<p>Qty:{{$item['qty']}}</p>


 					@endforeach

 				</div>

 			</div>
             <div class="row g-3 px-5 ml-4">
 			<p>
 				<button type="button" class="btm btn-success">
 					<span class="">
 						Total price: Rp.{{$cart->totalPrice}}
 					</span>
 				</button>
 			</p>

 			@endforeach

                <div class="col ml-5 px-5">
                    @if ($cekStatus->is_paid)
                        <span class="badge bg-success">Paid</span>
                    @else
                        <span class="badge bg-warning">Waiting to Accept</span>
                    @endif
                </div>
                <div class="col">
                    @if (!$cekStatus->is_paid)
                        <form action="{{ route('checkout.update', [$cekStatus->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm">Set to Paid</button>
                        </form>
                    @endif
                </div>
              </div>

 		</div>
 	</div>



 @endsection
