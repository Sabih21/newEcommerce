<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">

<!-- resources/views/users/index.blade.php -->


    <div class="container">
        <h2>User List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        @if($user->status == 'pending')
                            <form action="{{ route('users.approve', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>

                            <form action="{{ route('users.reject', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>







        </div>
        @include('admin.footer')
    </div>
    @include('admin.scripts')
</body>
</html>
