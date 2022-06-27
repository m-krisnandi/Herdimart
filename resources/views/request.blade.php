@extends('layouts.app')
@section('content')
<div class="wrapper-cart">
    <div class="card-container-cart">
        <h2 class="text-center">Form Request</h2>
        <div class="divider"></div>
        <div class="col-md-11 m-2">
            <div class="card">
                <div class="card-header">Request Product</div>
                <div class="card-body">

             <form  action="" method="post" id="request">@csrf
                         <div class="form-group">
                           <label>Name</label>
                           <input type="text" name="name" id="name" class="form-control" required="" value="{{auth()->user()->name}}" readonly="">
                         </div>
                         <br>
                         <div class="form-group">
                           <label>Produk apa yang ingin diadakan di Herdimart?</label>
                           {{-- <input type="textarea" name="description" id="description" class="form-control" required=""> --}}

                           <textarea name="description" id="" cols="55" rows="5" required=""></textarea>
                         </div>
                 <div class="mt-5">
                   <button type="submit" class="w-100 btn btn-primary">Request Now</button>
                 </div>
           </div>
       </div>
    </div>
</div>

@endsection
