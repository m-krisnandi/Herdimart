@extends('layouts.app')
@section('content')

<div class="py-5 container">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <section class="text-center container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody class="align-middle">
                @if ($cart)
                @php $i = 1 @endphp
                @foreach ($cart->items as $product)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td><img src="{{ Storage::url($product['image']) }}" width="100"></td>
                <td>{{ $product['name'] }}</td>
                <td>Rp. {{ $product['price'] }}</td>
                <td>
                    <form action="{{ route('cart-update', $product ['slug']) }}" method="POST"> @csrf
                        <input type="text" name="qty" value="{{ $product['qty'] }}">
                        <button class="btn btn-secondary btn-sm ">
                            <i class="fas fa-sync"> Update</i>
                        </button>
                        {{-- <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{ $product['id'] }}')">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a class="btn btn-reduce" href="#" wire:click.prevent="increaseQuantity('{{ $product['id'] }}')" >
                            <i class="fas fa-minus"></i>
                        </a> --}}
                    </form>
                </td>
                <td>
                    <form action="{{ route('cart-remove', $product ['slug']) }}" method="POST"> @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
              </tr>
                @endforeach
            </tbody>
          </table>
            <div class="card-footer">
                <button class="btn btn-primary">Continue shopping</button>
                <span style="margin-left:270px; margin-right:270px;">Total Price: Rp. {{ $cart->totalPrice }}</span>
                <a href="{{ route('booking', $cart->totalPrice) }}"><button class="btn btn-success">Booking</button></a>
            </div>
            @else
            <h3>Cart is empty</h3>
            @endif
      </section>
</div>
@endsection
