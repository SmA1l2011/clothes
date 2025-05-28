<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('adminProductUpdate', $product->id) }}" method="post">
            @csrf
            @method("patch")
            <select name="subcategory">
                @foreach ($allSubcategories as $subcategory)
                    @if ($subcategory->id == $product->subcategory_id) 
                        <option selected value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                    @else
                        <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                    @endif
                @endforeach
            </select>
            <div>
                <input type="text" name="title" value="{{ $product->title }}">
                @error("title")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="description" value="{{ $product->description }}">
                @error("description")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="number" name="price" value="{{ $product->price }}">
                @error("price")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="number" name="stock" value="{{ $product->stock }}">
                @error("stock")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" value="Update">
        </form>
    </x-slot>
</x-app-layout>