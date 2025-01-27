<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('product.details', $product->id) }}" class="option1">
                                    {{ $product->title }}
                                </a>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_name" value="{{ $product->title }}">
                                    <input type="hidden" name="price" value="{{ $product->discount_price ?? $product->price }}">
                                    <input type="hidden" name="image" value="{{ $product->image }}">
                                    <button type="submit" class="btn btn-primary option2">Add to Cart</button>
                                </form>

                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            <h6>
                                @if ($product->discount_price)
                                    <span style="text-decoration: line-through; color: #888;">
                                        EGP. {{ number_format($product->price, 2) }}
                                    </span>
                                    <span style="color: #e63946; font-weight: bold;">
                                        EGP. {{ number_format($product->discount_price, 2) }}
                                    </span>
                                @else
                                    <span style="color: #000; font-weight: bold;">
                                        EGP. {{ number_format($product->price, 2) }}
                                    </span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-box">
            <a href="#">
                View All products
            </a>
        </div>
    </div>
</section>
