<x-app-layout>
    <x-slot name="slot">
        <div class="wrapper">
            <a class="backButton" href="{{ route('adminProductIndex') }}">Back</a>
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->description }}</p>
            <p><b>{{ $product->price }}$</b></p>
            <p><b>stock: {{ $product->stock }}</b></p>
            <a href="{{ route('adminProductEdit', $product->id) }}"><b>edit</b></a>
            <form action="{{ route('adminProductDelete', $product->id) }}" method="post">
                @csrf
                @method("delete")
                <input type="submit" value="delete">
            </form>
        </div>
    </x-slot>
</x-app-layout>