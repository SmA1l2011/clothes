<x-app-layout>
    <x-slot name="slot">
        <nav class="filter-sort">
            <form action="{{ route('adminSubreviewIndex', request('id')) }}" method="get" class="sort-block">
                <p>sort:</p>
                @isset ($_GET['sortBy'])
                    @if ($_GET['sortBy'] == 'id')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="id">
                    @else
                        <input type="submit" name="sortBy" value="id">
                    @endif

                    @if ($_GET['sortBy'] == 'product_id')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="product_id">
                    @else
                        <input type="submit" name="sortBy" value="product_id">
                    @endif

                    @if ($_GET['sortBy'] == 'rating')
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="rating">
                    @else
                        <input type="submit" name="sortBy" value="rating">
                    @endif
                @else
                    <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="sortBy" value="id">
                    <input type="submit" name="sortBy" value="product_id">
                    <input type="submit" name="sortBy" value="rating">
                @endif

                @foreach ($_GET as $key => $value)
                    @if ($key !== "sortBy" && $key !== "clear")
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
            <form action="{{ route('adminSubreviewIndex', request('id')) }}" method="get" class="filter-block">
                <p>is_active:</p>
                @isset ($_GET["is_active"])
                    @if ($_GET["is_active"] == "all")
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="is_active" value="all">
                    @else
                        <input type="submit" name="is_active" value="all">
                    @endif
                    @if ($_GET["is_active"] == "yes")
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="is_active" value="yes">
                    @else
                        <input type="submit" name="is_active" value="yes">
                    @endif
                    @if ($_GET["is_active"] == "no")
                        <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="is_active" value="no">
                    @else
                        <input type="submit" name="is_active" value="no">
                    @endif
                @else
                    <input style="color: #fff; border-color: #fff; background: transparent;" type="submit" name="is_active" value="all">
                    <input type="submit" name="is_active" value="yes">
                    <input type="submit" name="is_active" value="no">
                @endif
                @isset ($_GET["sortBy"]) 
                    <input type="hidden" name="sortBy" value="{{ $_GET['sortBy'] }}">
                @endif
            </form>
            <form action="{{ route('adminSubreviewIndex', request('id')) }}" method="get" class="filter-block">
                <input type="submit" name="clear" value="clear filters">
            </form>
        </nav>
        <div class="wrapper">
            <table class="table reviews__table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>rating</th>
                        <th>comment</th>
                        <th>is_active</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allSubreviews as $subreview)
                        <tr>
                            <td>{{ $subreview->id }}</td>
                            <td>{{ $subreview->user->name }}</td>
                            <td>{{ $subreview->rating }}</td>
                            <td>{{ $subreview->comment }}</td>
                            <td>{{ $subreview->is_active ? "yes" : "no" }}</td>
                            <td>
                                <form class="review__form" action="{{ route('adminSubreviewStore') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ request('id') }}">
                                    <input type="hidden" name="id" value="{{ $subreview->id }}">
                                    <input type="submit" name="is_active" value="{{ $subreview->is_active ? 'not approve' : 'approve' }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>