<x-app-layout>
    <x-slot name="slot">
        <nav class="filter-sort">
            <div class="sort-block">
                <p>sort:</p>
                @if (request('sortBy') == 'id')
                    <a style="color: #fff; border-color: #fff;" href="{{ route('productIndex', 'id') }}">default</a>
                @else
                    <a href="{{ route('productIndex', 'id') }}">default</a>
                @endif

                @if (request('sortBy') == 'title')
                    <a style="color: #fff; border-color: #fff;" href="{{ route('productIndex', 'title') }}">title</a>
                @else
                    <a href="{{ route('productIndex', 'title') }}">title</a>
                @endif

                @if (request('sortBy') == 'priceD')
                    <a style="color: #fff; border-color: #fff;" href="{{ route('productIndex', 'priceD') }}">prise down</a>
                @else
                    <a href="{{ route('productIndex', 'priceD') }}">prise down</a>
                @endif

                @if (request('sortBy') == 'priceU')
                    <a style="color: #fff; border-color: #fff;" href="{{ route('productIndex', 'priceU') }}">price up</a>
                @else
                    <a href="{{ route('productIndex', 'priceU') }}">price up</a>
                @endif
            </div>
            <form action="{{ route('productIndex', request('sortBy')) }}" method="get" class="filter-block">
                <p>filters:</p>
                <input type="text" name="title" placeholder="filter by title">
                <input type="number" name="minPrice" placeholder="min price">
                <input type="number" name="maxPrice" placeholder="max price">
                <select name="subcategory">
                    <option value="all">all</option>
                    @foreach ($allSubcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                    @endforeach
                </select>
                <input type="submit" value="sand">
                <input type="hidden" value="{{ request('sortBy') }}" name="sortBy">
            </form>
        </nav>
        <div class="wrapper flex">
            @foreach ($allProducts as $product)
                <a href="{{ route('product', $product->id) }}" class="product">
                    <div class="text-info">
                        @if($product->isScroll === true)
                            <h2 style="overflow-x: scroll;" >{{ $product->title }}</h2>
                        @else
                            <h2>{{ $product->title }}</h2>
                        @endif
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="num-info">
                        <b>{{ $product->price }}$</b>
                        <b>stock: {{ $product->stock }}</b>
                    </div>
                </a>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>