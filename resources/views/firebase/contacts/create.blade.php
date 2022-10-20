@extends('firebase.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4> Add Contact
                            <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('contacts.store') }}" method="post">

                            @csrf

                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
