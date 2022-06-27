@extends('layouts.app')
@section('content')

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

<div class="wrapper-cart">
    <div class="card-container-cart">
        <h2>Keranjang</h2>
        <div class="divider"></div>
        @if ($cart)
                @php $i = 1 @endphp
                @foreach ($cart->items as $product)
        <div class="card-cart">
            <img class="item-pict" src="{{ Storage::url($product['image']) }}" alt="Avatar">
            <div class="card-desc-cart">
                <article class="item-detail">
                    <h4>{{ $product['name'] }}</h4>
                    <p><b>Rp {{ $product['price'] }}</b></p>
                </article>
                <article class="item-amount">
                    <form class="form-group" action="{{ route('cart-update', $product ['slug']) }}" method="POST"> @csrf
                        <div class="form-group-half">
                            <input class="item-total" type="text" name="qty" value="{{ $product['qty'] }}">
                        </div>
                        <div class="form-group-half">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </article>
            </div>
            <form action="{{ route('cart-remove', $product ['slug']) }}" method="POST"> @csrf
                <button style="border:none !important; background-color:#e2e2e2 !important" class="item-del"><img src="{{ asset('images/trash.svg') }}"></button>
            </form>
        </div>
        @endforeach
    </div>
    <aside class="sidebar-cart">
        <article class="bill-detail">
            <h2 style="font-size: 1.8rem;">Tagihan</h2><br>
            <h3 style="font-size: 1.2rem;">Total Pesanan (<span class="bill-item">{{ $cart->totalQty }}</span>)</h3>
            <div class="divider2"></div>
            <article class="bill-container">
                <h3><span style="font-size: 1.2rem;">Harga</span></h3>
                <h3><span class="bill-price">Rp {{ $cart->totalPrice }}</h3>
            </article>
            <a href="{{ route('booking', $cart->totalPrice) }}"><button class="bill-button">Booking (<span class="bill-item">{{ $cart->totalQty }}</span>)</button></a>
        </article>
    </aside>
    @else
        <h3>Cart is empty</h3>
    @endif
</div>


@endsection
