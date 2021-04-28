@php
$days = 7;
@endphp
@if (count($products) > 0)
    @foreach ($products as $product)
        <a href="{{ route('product.details', $product->id) }}" class="d-block mb-2">
            <div class="card text-left">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body p-2">
                    <div class="float-left">
                        <img class="primary-img mr-1"
                            src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}" height="45" width="30">
                        <h4 class="card-title d-inline-block">{{ $product->name }}</h4>
                    </div>
                    <div class="float-right">
                        @if (($product->stock - $product->stock_out) >= 1)
                            <span class="product-availability mr-3 mt-0">In stock</span>
                        @else
                            <span class="text-danger float-left mr-3">
                                <i class="fa fa-close mr-1"></i>Stock out
                            </span>
                        @endif

                        @if ($product->regular_price && $product->sell_price == null)

                            <span class="new-price mr-1">{{ $product->regular_price }}</span>
                        @else
                            <span class="new-price mr-1">{{ $product->sell_price }}</span>

                            <del class="old-price mr-1">{{ $product->regular_price }}</del>
                        @endif

                        @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) <= $days)
                            <div class="badge badge-success"><span>New</span></div>
                        @endif
                        @if ($product->discount != null)
                            <div class="badge badge-danger">
                                <span>{{ $product->discount }}%</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@else
    <h4 class="text-danger">No items found</h4>
@endif
