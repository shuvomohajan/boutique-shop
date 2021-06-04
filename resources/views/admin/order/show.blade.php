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
          Order Details
          <!-- <small>Datatable initialized from HTML table</small> -->
        </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      <!--begin: Search Form -->
      <div class="kt-form kt-form--label-right">
        <div class="row align-items-center">
          <div class="col-xl-8 order-2 order-xl-1">
            <!-- <div class="row align-items-center">
                              <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                              </div>
                          </div> -->
          </div>
          <div class="col-xl-4 order-1 order-xl-2 kt-align-left">
            <div class="kt-input-icon kt-input-icon--left">
              <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
              <span class="kt-input-icon__icon kt-input-icon__icon--left">
                <span><i class="la la-search"></i></span>
              </span>
            </div>
            <div class="p-2 mt-3">
                <div class="badge ">
                  Country  : {{ $order->ShippingAddress->country }}
                </div>
                <div class="badge ">
                  Division  : {{ $order->ShippingAddress->Division->name  }}
                </div>
                <div class="badge ">
                  City  : {{ $order->ShippingAddress->city }}
                </div>
                <div class="badge ">
                  Zip  : {{ $order->ShippingAddress->zip  }}
                </div>
                <div class="badge ">
                  Area  : {{ $order->ShippingAddress->area  }}
                </div>
                <div class="badge ">
                  Shipping Address  : {{ $order->ShippingAddress->address  }}
                </div>
                <div class="badge ">
                  Phone : {{ $order->ShippingAddress->contact ?? $order->ShippingAddress->User->phone }}
                </div>
                <div class="badge ">
                  Email : {{ $order->ShippingAddress->User->email  }}
                </div>
            </div>
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
          </div>
        </div>
      </div>
      <!--end: Search Form -->
    </div>
    <div class="kt-portlet__body kt-portlet__body--fit" style="margin-top: -20px;">
      <!--begin: Datatable -->
      <table class="kt-datatable text-center" id="html_table" width="100%" id="reload">
        <thead>
          <tr>
            <th>#</th>
            <th>name</th>
            <th>qty</th>
            <th>
              Is Return
            </th>
            <th>
              Return status
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- start -->
          @foreach($orderProducts as $key=> $orderProduct)
          <tr>
            <td>
              {{ ++$key }}
            </td>
            <td>
              {{$orderProduct->Product->name}}
            </td>
            <td>{{ $orderProduct->qty }}</td>
            <td>
                <div class="badge badge-{{ $orderProduct->is_return ? "primary": "secondary" }}">{{ $orderProduct->is_return ? "active": "Deactive" }}</div>
            </td>
            <td>
              <div class="input-group" >
                <select class="custom-select " id="inputGroupSelect04" onchange="statusChange({{ $orderProduct->id}},{{ $orderProduct->qty }})"
                  @cannot ('order.edit')
                    disabled
                  @endcannot
                  >
                  <option value="0" {{$orderProduct->return_status == 0 ? 'selected': '' }} {{ $orderProduct->return_status == (1||2) ? 'disabled':'' }}>Start Returnig</option>
                  <option value="1" {{$orderProduct->return_status == 1 ? 'selected': '' }} {{ $orderProduct->return_status == 2 ? 'disabled':'' }}>Processing</option>
                  <option value="2" {{$orderProduct->return_status == 2 ? 'selected': '' }}>Returned</option>
                </select>
              </div>
            </td>
            <td></td>
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
      function statusChange(id,qty){
          var value = event.target.value;
          var id = id;
          var qty = qty;

      $.ajax({
        url: "{{ route('order.return') }}",
        method: "POST",
        data: {
        "_token": "{{ csrf_token() }}",
        "id": id,
        "order_id": "{{ $order->id }}",
        "product_id": "{{ $orderProduct->Product->id }}",
        "qty": qty,
        "value":value
        },
        context: document.body
      }).done(function() {
        // $( this ).addClass( "done" );
        location.reload();
        // $( "#reload" ).load(window.location.href + " #reload" );
      })
      }
    // });
  </script>
@endpush
