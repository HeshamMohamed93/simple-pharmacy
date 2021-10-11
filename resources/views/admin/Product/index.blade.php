@extends('admin.admin-master')
@section('admin')

    <div class="py-12">
        <div class="row float-right">
            <a href="{{ route('product.create') }}" ><button class="btn btn-primary" style="float: right">Add</button></a>
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
                            <div class="card-header bg-primary text-white">All Products</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">ID</th>
                                <th scope="col" width="10%">Title</th>
                                <th scope="col" width="30%">Description</th>
                                <th scope="col" width="15%">Image</th>
                                <th scope="col" width="10%">Created At</th>
                                <th scope="col" width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->description}}</td>
                                    <td><img src="{{ asset($product->image_path)}}" style="width: 100px; height: 50px"></td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{ route('product.show', $product->id) }}"
                                               class="btn btn-success">Show</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
