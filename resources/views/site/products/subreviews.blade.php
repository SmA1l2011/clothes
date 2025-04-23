<x-app-layout>
    <x-slot name="slot">
        <a class="backButton" href="{{ route('productReviews', request('product_id')) }}">Back</a>
        <div class="wrapper">
            @foreach ($allSubreviews as $subreview)
                <div class="review-block">
                    <div class="review__user-rating">
                        <span class="review__user-img"></span>
                        <p>{{ $subreview->name }}</p>
                        <div class="review__stars">
                            <?php $count = $subreview->rating ?>
                            @for ($i = 0; $i < 5; $i++)
                                @if ($count > 0)
                                    <span class="star active"></span>
                                @else
                                    <span class="star"></span>
                                @endif
                                <?php $count-- ?>
                            @endfor
                        </div>
                    </div>
                    <p class="review__comment">{{ $subreview->comment }}</p>
                </div>
            @endforeach
        </div>
        <form action="{{ route('subreviewStore') }}" method="post" class="createReviewsForm">
            @csrf
            <div class="range-star">
                <input type="range" name="rating" id="rating" min="1" max="5" value="5">
                <span class="star" id="star"></span>
                <span class="star" id="star"></span>
                <span class="star" id="star"></span>
                <span class="star" id="star"></span>
                <span class="star" id="star"></span>
            </div>
            <textarea name="comment" cols="90" rows="1.5"></textarea>
            <input type="hidden" name="id" value="{{ request('id') }}">
            <input type="hidden" name="product_id" value="{{ request('product_id') }}">
            <input type="submit" name="send" value="">
        </form>
    </x-slot>
</x-app-layout>