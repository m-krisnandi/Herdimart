@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Booking</li>
              <li class="breadcrumb-item active" aria-current="page">Booking Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All User Booking</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($bookings)>0)
                      @foreach($bookings as $key=> $booking)
                      <tr>

                        <td><a href="#">{{$key+1}}</a></td>
                        <td>{{$booking->user->name}}</td>
                        <td>{{$booking->user->email}}</td>
                        <td>{{date('d-M-y', strtotime($booking->created_at))}}</td>
                        <td>
                          <a href="{{ route('view.user.orders', [$booking->user_id, $booking->id]) }}" class="btn btn-primary">View</a>
                          {{-- <a href="{{route('admin.booking.edit',$booking->id)}}" class="btn btn-warning">Edit</a>
                          <form action="{{route('admin.booking.destroy',$booking->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                        </td>

                      </tr>
                      @endforeach

                      @else
                      <td>No any booking to show!</td>
                      @endif



                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>

  @endsection
