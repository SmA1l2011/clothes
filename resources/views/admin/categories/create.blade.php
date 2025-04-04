<x-app-layout>
    <x-slot name="slot">
        @isset($error) 
            <p>{{ $error }}</p>
        @endif
        <form action="{{ route('categoryStore') }}" method="post">
            @csrf
            <input type="text" name="title" placeholder="title">
            <input type="text" name="description" placeholder="description">
            <input type="submit" name="Create">
        </form>
    </x-slot>
</x-app-layout>