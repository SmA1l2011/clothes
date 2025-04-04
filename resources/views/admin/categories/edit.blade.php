<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('categoryUpdate', $category->id) }}" method="post">
            @csrf
            @method("patch")
            <input type="text" name="title" value="{{ $category->title }}">
            <input type="text" name="description" value="{{ $category->description }}">
            <input type="submit" value="Update">
        </form>
    </x-slot>
</x-app-layout>