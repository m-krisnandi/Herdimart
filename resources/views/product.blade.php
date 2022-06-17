@extends('layouts.app')
@section('content')
{{-- <script type="text/javascript">
    $( document ).ready(function() {
        console.log( "ready!" );
    });
</script> --}}
<main>

    {{-- <aside class="sidebar">
        <article>
            <h3>Kategori</h3>
            <form action="" method="GET">
            @foreach ($productCategories as $category)
            <input type="checkbox" name="category[]" value="{{ $category->slug }}"><label for="minuman">{{ $category->name }}</label> <br>
            @endforeach
            <input type="submit" value="Filter">
        </form>
        </article>
    </aside> --}}
    <aside class="sidebar">
        <article>
            <h3>Kategori</h3>
            <form action="" method="GET">
            <?php $categories = DB::table('product_categories')->orderby('name', 'ASC')->get(); ?>
            @foreach ($categories as $category)
            <input type="checkbox" checked id="brandId" name="category" value="{{ $category->slug }}"><label for="minuman">{{ $category->name }}</label> <br>
            @endforeach
        </form>
        </article>
    </aside>

    <header class="mt-5">
        <div class="jumbotron">
            <div id="inborder">
                <h1>Warung Kami Semakin Dekat</h1>
            </div>
        </div>
    </header>

    <div class="album py-5 bg-light">
      <div class="container">
          <h5>Paling Diminati</h5><hr>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-2">
          @foreach ($products as $product)

          <div class="col">
            <div class="card-sm shadow-sm h-100 border-radius">
                <img src="{{ Storage::url($product->image) }}" width="100%" height="150" >

              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Rp. {{ $product->price }}</small>
                  <div class="btn-group">
                    <a href="{{ route('add-to-cart', [$product->slug]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>

      <div class="container pt-5">
        <h5>Paling Dicari</h5><hr>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-2">
        @foreach ($products->take(4) as $product)

        <div class="col">
          <div class="card-sm shadow-sm h-100 border-radius">
              <img src="{{ Storage::url($product->image) }}" width="100%" height="150" >

            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>

              <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted">Rp. {{ $product->price }}</small>
                <div class="btn-group">
                  <a href="{{ route('add-to-cart', [$product->slug]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                </div>
              </div>
            </div>
          </div>

        </div>
        @endforeach
        <img src="{{ asset('images/dijamin.png') }}" alt="">
      </div>
    </div>
    </div>





  </main>

  {{-- <footer class="text-muted py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Back to top</a>
      </p>
      <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
      <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.2/getting-started/introduction/">getting started guide</a>.</p>
    </div>
  </footer> --}}
@endsection
