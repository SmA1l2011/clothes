<x-app-layout>
    <x-slot name="slot">
        <a class="backButton" href="{{ route('productIndex') }}">Back</a>
        <div class="wrapper">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->description }}</p>
            <p><b>{{ $product->price }}$</b></p>
            <p><b>stock: {{ $product->stock }}</b></p>
            <p><a href="{{ route('productReviews', $product->id) }}"><b>reviews...</b></a></p>
            <form action="{{ route('productStore') }}" method="post">
                @csrf
                <input type="submit" value="order">
                <input type="hidden" name="order" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
            </form>
        </div>
    </x-slot>
</x-app-layout>