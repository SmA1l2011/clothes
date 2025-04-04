<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('subcategoryUpdate', $subcategory->id) }}" method="post">
            @csrf
            @method("patch")
            <select name="category_id">
                @foreach ($allCategories as $category)
                    @if ($category->id == request('category_id'))
                        <option selected value="{{ $category->id }}">{{ $category->title }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endif
                @endforeach
            </select>
            <input type="text" name="title" value="{{ $subcategory->title }}">
            <input type="text" name="description" value="{{ $subcategory->description }}">
            <input type="hidden" name="oldCategory_id" value="{{ request('category_id') }}">
            <input type="submit" value="Update">
        </form>
    </x-slot>
</x-app-layout>