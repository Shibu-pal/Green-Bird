<div class="row">
    @foreach($items as $item)
    <div class=" col-md-3  col-6 mb-4 my-2">
        <div class="product-card">

            <!-- Main Image -->
            <div class="main-image-container ">
                <img id="mainImage"
                    src="{{ asset('/storage/' . ($item->item_pics && $item->item_pics->count() > 0 ? $item->item_pics->first()->image : 'default.png')) }}"
                    alt="{{ $item->title }}" class="main-image">
            </div>

            <!-- Thumbnails -->
            <div class="thumbnail-container">
                @foreach ($item->item_pics as $pics)
                <img src="{{ asset('/storage/' . ($pics->image ?? 'default.png')) }}" alt="Front view"
                    class="thumbnail active" onclick="changeImage(this)">
                @endforeach
            </div>

            <div class="product-info">
                <h3 class="product-title mb-2 text-truncate">{{ $item->title }}</h3>
                <p class="product-description mb-2" style="word-break: break-word; white-space: normal;">
                    Quick/Comfy/Accurate/Plug&nbsp;and&nbsp;Play
                </p>

                <div class="price-section d-flex flex-wrap align-items-baseline gap-2 mb-2">
                    <span class="current-price fw-bold">Price: {{ $item->points_required }} Coin</span>
                </div>

                <div class="seller-info small text-muted">
                    <a class="text-decoration-none text-info fst-italic fw-bold" href="#"><img src="@if ($item->user->profile_image != NULL)
                                {{ asset('/storage/'.$item->user->profile_image); }}
                            @else
                                {{ asset('/images/GreenBird.png'); }}
                            @endif" alt="Profile" class="rounded-circle me-1" width="24"
                        height="24">Sold by: {{ $item->user->name }}</a>

                </div>
                <a class="btn btn-info text-center text-decoration-none text-light"
                    href="{{ route('product',$item->id) }}">Watch more</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
