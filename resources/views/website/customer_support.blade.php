@extends('website.layouts.website')
@section('content')
  <div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li class="active">Customer Support</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="content-wraper">

    <div class="container">
      <div class="row">

        <div id="left-column" class="col-xs-12 col-sm-3">

          <div class="contact-rich">
            <h3 class="mb-4">information</h3>
            @if(companyInfo()->location)
            <div class="block d-flex align-items-center">
              <div class="icon pr-4 text-black-50"><i class="ion-ios-location" style="font-size: 26px"></i></div>
              <div class="data">{{ companyInfo()->location }}</div>
            </div>
            <hr>
            @endif
            @if(companyInfo()->mobile1)
            <div class="block d-flex align-items-center">
              <div class="icon pr-4 text-black-50"><i class="ion-android-call" style="font-size: 26px"></i></div>
              <div class="data">
                Call us:<br>
                <a href="tel: +88 12 345 6789"> {{companyInfo()->mobile1}}</a>
              </div>
            </div>
            <hr>
            @endif
            @if(companyInfo()->email)
            <div class="block d-flex align-items-center">
              <div class="icon pr-4 text-black-50"><i class="ion-email" style="font-size: 26px"></i></div>
              <div class="data email">
                Email us:<br>
                <a href="mailto:demo@posthemes.com">{{ companyInfo()->email }}</a>
              </div>
            </div>
            @endif
          </div>
        </div>

        <div class="left-column col-xs-12 col-sm-8 col-md-9 mb-4">
          <div id="main">
            <section id="content" class="page-content card card-block">
              <section class="contact-form p-4">
                <form action="{{ route('support.create') }}" method="post">
                  @csrf
                  <section class="form-fields ">
                    <div class="form-group row">
                      <div class="col-md-9 col-md-offset-3">
                        <h3>Customer Support</h3>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label text-right" for="service">Subject</label>
                      <div class="col-md-6">
                        <select name="service" id="service" class="custom-select">
                          <option value="0">Customer service</option>
                        </select>
                        @error('service')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label text-right" for="name">Name</label>
                      <div class="col-md-6">
                        <input class="form-control" name="name" type="text" id="name" value="{{ old('name') }}" placeholder="Jon">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label text-right" for="email">Email address</label>
                      <div class="col-md-6">
                        <input class="form-control" name="email" id="email" type="email" value="{{ old('email') }}" placeholder="your@email.com">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label text-right">Message</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="message" placeholder="How can we help?" rows="3"> {{ old('message') }}</textarea>
                        @error('message')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </section>
                  <div class="form-group">
                    <div class="text-right">
                      <button class="btn btn-dark" type="submit">Send</button>
                    </div>
                  </div>
                </form>
              </section>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
@endsection

<!-- Body Wraper Area End Here -->
<!-- JS
============================================ -->
<!-- jQuery JS -->


@push('scripts')
  <script>
    $(document).on('keyup', '.code', function () {
      //var total = $('#coupon').val();
      var code = $(this).val();
      var pid = $(this).attr('data-id');

      $.ajax({
        method: "POST",
        url: "{{route('cart.get_coupon')}}",
        data: {code: code, _token: "{{csrf_token()}}"},

        success: (function (res) {
          $('#coupon_result').html(res);
        })
      });
    })
  </script>
@endpush
