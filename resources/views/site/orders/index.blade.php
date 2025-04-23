<x-app-layout>
    <x-slot name="slot">
        <form action="{{ route('orderStore') }}" method="post">
            @csrf
            <input type="submit" name="order" value="order">
        </form>
        <div class="wrapper">
            <table class="table orderTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>price</th>
                        <th>sum price</th>
                        <th>count</th>
                        <th>delete</th>
                        <th>apply</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderProduct as $product)
                        <form action="{{ route('orderStore') }}" method="post">
                            @csrf
                            <tr>
                                <td>
                                    {{ $product->id }}
                                    <input type="hidden" name="id" value="{{ $count }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->price * Session::get('orders')[$count][1] }}</td>
                                <td><input type="number" name="count" value="{{ Session::get('orders')[$count][1] }}"></td>
                                <td><input type="submit" name="delete" value="delete"></td>
                                <td><input type="submit" value="apply"></td>
                            </tr>
                        </form>
                        <?php $count++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>