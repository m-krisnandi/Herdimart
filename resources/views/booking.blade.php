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
                    @forelse ($carts as $product)


                    {{-- @if($carts) --}}
                    <tr class="align-middle">
                        {{-- <td width="18%">
                            <img src="/assets/images/item_bootcamp.png" height="120" alt="">
                        </td> --}}
                        <td>
                            <p>
                                <strong>Transaksi {{ $i++ }}</strong>
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




                                              {{-- @foreach($carts as $product) --}}
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
                            <p class="mb-5 "><strong>Bayar Sebelum: 32 Mei pukul 23:59</strong></p>
                            <p class="mt-">
                                <button class="btn btn-danger btn-sm ">Batalkan Pesanan</button>
                                <button class="btn btn-info text-white btn-sm ">Hubungi Penjual</button>
                            </p>


                        </td>
                        <td class="text-center">
                            <p><strong>Status Pembayaran</strong></p>
                            <p>



                                    @if ($product->is_paid)
                                        <strong class="text-success">Sudah Bayar</strong>
                                    @else
                                        <strong class="text-red">Belum Bayar</strong>
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Bayar
                                        </button>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Transfer</a></li>
                                        <li><a class="dropdown-item" href="#">Bayar ke Tempat</a></li>
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
