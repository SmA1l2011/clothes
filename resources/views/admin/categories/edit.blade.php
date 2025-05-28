<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('categoryUpdate', $category->id) }}" method="post">
            @csrf
            @method("patch")
            <div>
                <input type="text" name="title" value="{{ $category->title }}">
                @error("title")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="description" value="{{ $category->description }}">
                @error("description")
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" value="Edit">
        </form>
    </x-slot>
</x-app-layout>