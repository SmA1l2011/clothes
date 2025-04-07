<x-app-layout>
    <x-slot name="slot">
        <div class="wrapper">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->description }}</p>
            <p><b>{{ $product->price }}$</b></p>
            <p><b>stock: {{ $product->stock }}</b></p>
        </div>
    </x-slot>
</x-app-layout>