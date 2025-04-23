<x-app-layout>
    <x-slot name="slot">
        <div class="wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>surname</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>password</th>
                        <th>role</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>apply</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allUsers as $user)
                        <form action="{{ route('userEdit') }}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $user->id }}<input type="hidden" name="id" value="{{ $user->id }}"></td>
                                <td><input class="table-input" type="text" name="name" value="{{ $user->name }}"></td>
                                <td><input class="table-input" type="text" name="surname" value="{{ $user->surname }}"></td>
                                <td><input class="table-input" type="email" name="email" value="{{ $user->email }}"></td>
                                <td><input class="table-input" type="phone" name="phone" value="{{ $user->phone }}"></td>
                                <td><input class="table-input" type="password" name="password" placeholder="edit password"></td>
                                <td>
                                    <select class="table-select" name="role">
                                        @if ($user->role == "admin")
                                            <option selected value="admin">admin</option>
                                            <option value="user">user</option>
                                        @else
                                            <option selected value="user">user</option>
                                            <option value="admin">admin</option>
                                        @endif
                                    </select>
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td><input class="table-submit" type="submit" value="apply"></td>
                            </tr> 
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>