@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <section class="gallery-wrap">

                    <div class="img-big-wrap">
                        <div> <a href="{{ Storage::url($product->image) }}"><img src="{{ Storage::url($product->image) }}"  ></a></div>
                    </div>
                </section>

            </aside>
            <aside class="class-sm-7">
                <section class="card-body p-5">
                    <h3 class="title mb-3">
                        {{ $product->name }}
                    </h3>
                    <p class="price-detail-wrap">
                        <span class="price h3">
                            <span class="currency">Rp. </span><span class="num">{{ $product->price }}</span>
                        </span>
                    </p>
                </section>
            </aside>
        </div>
    </div>
</div>

@endsection
