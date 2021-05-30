  @extends('admin.layouts.default')
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet kt-portlet--mobile">
    @if(session()->has('Smsg'))
    <div class="alert alert-success">
      {{session()->get('Smsg')}}
    </div>
    @elseif(session()->has('Fmsg'))
    <div class="alert alert-danger">
      {{session()->get('Fmsg')}}
    </div>
    @endif
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <span class="kt-widget__icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                <path
                  d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                  fill="#000000" opacity="0.3" />
              </g>
            </svg>
          </span>
        </span>
        <h3 class="kt-portlet__head-title">
          Custom Orders
          <!-- <small>Datatable initialized from HTML table</small> -->
        </h3>
      </div>
    </div>
    <div class="table-responsive">
      <!--begin: Datatable -->
      <table class="table table-bordered" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Front</th>
            <th>Back</th>
            <th>Sleeve</th>
            <th>Hemline</th>
            <th>Style</th>
            <th>Address</th>
            <th>Note</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- start -->
          @php ($i = 1)
          @foreach($custom_orders as $order)
          <tr>
            <td>
              {{ $i++ }}
            </td>
            <td>
              {{$order->User->name}}
            </td>
            <td>
              {{$order->front ?? '-'}}
            </td>
            <td>
              {{$order->back ?? '-'}}
            </td>
            <td>
              {{$order->sleeve ?? '-'}}
            </td>
            <td>
              {{$order->hemline ?? '-'}}
            </td>
            <td>
              {{$order->style ?? '-'}}
            </td>
            <td>
              {{$order->ShippingAddress->country.',' .$order->ShippingAddress->Division->name .','.  $order->ShippingAddress->city .','. $order->ShippingAddress->zip .','. $order->ShippingAddress->area .','. $order->ShippingAddress->address}}
            </td>
            <td>
              {{$order->note ?? '-'}}
            </td>
            <td>
              {{$order->price}}
            </td>
            <td>
              <a href="{{ route('order.show',$order->id) }}" class="btn-label-brand btn btn-sm btn-bold">View</a>
              {{-- <form method="post" action="{{ route('order.destroy',$order->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn-sm btn btn-danger">Delete</button>
              </form> --}}
            </td>
          </tr>
          @endforeach

          <!-- End -->
        </tbody>
      </table>
      <!--end: Datatable -->
    </div>
  </div>
</div>
<!-- end:: Content -->
@endsection
@push('script')
  <script>
    //  $(function () {
      function statusChange(id){
          var value = event.target.value;
          var id = id;
      $.ajax({
        url: "{{ route('order.status') }}",
        method: "POST",
        data: {
        "_token": "{{ csrf_token() }}",
        "id": id,
        "value":value
        },
        context: document.body
      }).done(function() {
        $( this ).addClass( "done" );
      })
      }
    // });
  </script>
@endpush
