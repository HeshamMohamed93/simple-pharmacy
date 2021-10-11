@extends('admin.admin-master')
@section('admin')

    <div class="py-12">
        <div class="row float-right">
            <a href="{{ route('pharmacy.create') }}" ><button class="btn btn-primary" style="float: right">Add</button></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            <div class="card-header bg-primary text-white">All Pharmacies</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">ID</th>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="30%">Address</th>
                                <th scope="col" width="15%">Created At</th>
                                <th scope="col" width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pharmacies as $pharmacy)
                                <tr>
                                    <th scope="row">{{$pharmacy->id}}</th>
                                    <td>{{$pharmacy->name}}</td>
                                    <td>{{$pharmacy->address}}</td>
                                    <td>{{$pharmacy->created_at}}</td>
                                    <td>
                                        <form action="{{ route('pharmacy.destroy',$pharmacy->id) }}" method="POST">
                                            <a href="{{ route('pharmacy.edit', $pharmacy->id) }}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{ route('pharmacy.show', $pharmacy->id) }}"
                                               class="btn btn-success">Show</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want delete this pharmacy?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $pharmacies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
