@extends('layouts.app')
@section('content')

<div class="py-5 container">
    <div class="container">
        <div class="row text-left">
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    DASHBOARD
                </p>
                <h2 class="primary-header ">
                    Daftar Transaksi Kamu
                </h2>
            </div>
        </div>
        <div class="row my-5">
            <table class="table">
                <tbody>
                    @php $i=1; $j=1; @endphp
                    {{-- @forelse ($carts as $product) --}}
                    @forelse ($carts as $product)


                    {{-- @if($carts) --}}
                    <tr class="align-middle">
                        {{-- <td width="18%">
                            <img src="/assets/images/item_bootcamp.png" height="120" alt="">
                        </td> --}}
                        <td>
                            <p>
                                <strong>Transaksi
                                    {{-- {{ $i++ }} --}}
                                </strong>
                            </p>
                            <p class="mb-2">
                                Total harga pesanan
                            </p>
                            <p>
                                Lihat Pesanan Kamu
                                <!-- get updates / modal trigger -->
                                <a data-bs-toggle="modal" data-bs-target="#reg-modal" href="">Disini</a>

                                <!-- modal itself -->
                                <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Pesanan Kamu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
                                                    @foreach ($product->items as $item)

                                                        <tr>
                                                            <th scope="row">{{$j++}}</th>

                                                            <td><img src="{{Storage::url($item['image'])}}" width="100"></td>
                                                            <td>{{$item['name']}}</td>
                                                            <td>Rp. {{$item['price']}}</td>
                                                            <td>
                                                            {{$item['qty']}}
                                                        </td>
                                                            <td>

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                 {{-- @endforeach --}}
                                                </tbody>
                                        </div>

                                      </table>
                                      <div class="modal-footer">
                                        <span>Total price:Rp. {{$product->totalPrice}} </span>
                                      </div>
                                    </div>
                                    </div>
                                </div>

                            </p>
                        </td>
                        <td class="text-center">

                            @if ($cekStatus->is_paid)
                            <p>
                                <a href="https://wa.me/+6281312406801?text=Hi, saya ingin bertanya tentang Product yang saya Booking" class="btn-sm btn btn-info text-white">
                                    Hubungi Penjual
                                </a>
                            </p>
                            @else
                            <p class="mb-5 "><strong>Bayar Sebelum: {{ $modified }}</strong></p>
                            <p>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('order-destroy',$cekStatus->id)}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm ">Batalkan Pesanan</button>
                                </form>
                                <a href="https://wa.me/+6281312406801?text=Hi, saya ingin bertanya tentang Product yang saya Booking" class="btn-sm btn btn-info text-white">
                                    Hubungi Penjual
                                </a>
                            </p>
                            @endif


                        </td>
                        <td class="text-center">
                            <p><strong>Status Pembayaran</strong></p>
                            <p>

                                    @if ($cekStatus->is_paid)
                                        <strong class="text-success">Sudah Bayar</strong>
                                    @else
                                        <strong class="text-red">Belum Bayar</strong>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Bayar
                                        </button>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reg-modal2" href="">Transfer</a>
                                        <!-- modal itself -->
                                <div class="modal fade" id="reg-modal2" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title2">Pastikan file adalah gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" method="POST" enctype="multipart/form-data">@csrf
                                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror  " id="customFile" name="image">
                                                <label class="custom-file-label  " for="customFile">Choose file</label>
                                            </form>
                                        </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </div>
                                    </div>
                                </div>
                                        </li>
                                        <li><a class="dropdown-item" href="">Bayar ke Tempat</a></li>
                                        </ul>
                                    </div>
                                    @endif
                            </p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <h3>No Data</h3>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
