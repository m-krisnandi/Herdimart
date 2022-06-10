@extends('layouts.app')
@section('content')
<main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto" style="background-image: url('{{ asset('admin/img/banner-hero.png') }}'); width:100%; height:200px; ">
          <h1 class="fw-light pt-5 ">Warung Kami Semakin Dekat</h1>
        </div>
      </div>
    </section>



    <div class="album py-5 bg-light">
      <div class="container">
          <h3>Paling Diminati</h3><hr>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          @foreach ($products as $product)

          <div class="col">
            <div class="card shadow-sm">
                <img src="{{ Storage::url($product->image) }}" width="100%" height="225" >

              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Rp. {{ $product->price }}</small>
                  <div class="btn-group">
                    <a href="product/{{ $product->slug }}"><button type="button" class="btn btn-sm btn-outline-success">View</button></a>
                    <a href="{{ route('add-to-cart', [$product->slug]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Back to top</a>
      </p>
      <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
      <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.2/getting-started/introduction/">getting started guide</a>.</p>
    </div>
  </footer>
@endsection
