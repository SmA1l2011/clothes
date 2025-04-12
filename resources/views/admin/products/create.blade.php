<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('adminProductStore') }}" method="post">
            @csrf
            <select name="subcategory">
                @foreach ($allSubcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                @endforeach
            </select>
            <input type="text" name="title" placeholder="title">
            <input type="text" name="description" placeholder="description">
            <input type="number" name="price" placeholder="price">
            <input type="number" name="stock" placeholder="stock">
            <input type="submit" name="Create">
        </form>
    </x-slot>
</x-app-layout>