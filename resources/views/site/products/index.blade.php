<x-app-layout>
    <x-slot name="slot">
        <nav class="filter-sort">
            <form action="{{ route('productIndex') }}" method="get" class="sort-block">
                <p>sort:</p>
                @isset ($_GET['sortBy'])
                    @if ($_GET['sortBy'] == 'default')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="default">
                    @else
                        <input type="submit" name="sortBy" value="default">
                    @endif

                    @if ($_GET['sortBy'] == 'title')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="title">
                    @else
                        <input type="submit" name="sortBy" value="title">
                    @endif

                    @if ($_GET['sortBy'] == 'price down')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="price down">
                    @else
                        <input type="submit" name="sortBy" value="price down">
                    @endif

                    @if ($_GET['sortBy'] == 'price up')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="price up">
                    @else
                        <input type="submit" name="sortBy" value="price up">
                    @endif
                @else
                    <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="default">
                    <input type="submit" name="sortBy" value="title">
                    <input type="submit" name="sortBy" value="price down">
                    <input type="submit" name="sortBy" value="price up">
                @endif

                @foreach ($_GET as $key => $value)
                    @if ($key !== "sortBy" && $key !== "clear")
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
            <form action="{{ route('productIndex') }}" method="get" class="filter-block">
                <p>filters:</p>
                <input type="text" name="title" placeholder="filter by title" value="{{ $_GET['title'] ?? '' }}">
                <input type="number" name="minPrice" placeholder="min price" value="{{ $_GET['minPrice'] ?? '' }}">
                <input type="number" name="maxPrice" placeholder="max price" value="{{ $_GET['maxPrice'] ?? '' }}">
                <select name="subcategory">
                    <option value="all">all</option>
                    @foreach ($allSubcategories as $subcategory)
                        @if (isset($_GET["subcategory"]) && $subcategory->id == $_GET["subcategory"])
                            <option selected value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                        @else
                            <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                        @endif
                    @endforeach
                </select>
                @isset ($_GET["sortBy"]) 
                    <input type="hidden" name="sortBy" value="{{ $_GET['sortBy'] }}">
                @endif
                <input type="submit" value="sand">
            </form>
            <form action="{{ route('productIndex') }}" method="get" class="filter-block">
                <input type="submit" name="clear" value="clear filters">
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