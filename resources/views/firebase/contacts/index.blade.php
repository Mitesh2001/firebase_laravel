@extends('firebase.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))

                    <h4 class="alert alert-warning mb-2" >{{ session('status') }}</h4>

                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Contact List - Total : {{ $total }}
                            <a href="{{ route('contacts.create') }}" class="btn btn-sm btn-primary float-end">Add Contact</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Phone</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @forelse ($contacts as $key => $contact)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $contact['first_name'] }}</td>
                                        <td>{{ $contact['last_name'] }}</td>
                                        <td>{{ $contact['email'] }}</td>
                                        <td>{{ $contact['phone'] }}</td>
                                        <td> <a href="{{ route('contacts.edit', $key) }}" class="btn btn-sm btn-success">Edit</a> </td>
                                        <td>
                                            <form action="{{ route('contacts.destroy', $key) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
