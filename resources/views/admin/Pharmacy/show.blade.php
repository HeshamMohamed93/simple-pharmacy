@extends('admin.admin-master')
@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Display Pharmacy
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="row float-right">
            <a href="{{ route('pharmacy.list-products', $pharmacy) }}" ><button class="btn btn-primary" style="float: right">Add new products</button></a>
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
                        <div class="card-header" style="">Details</div>
                            <div class="container">
                                <p>Name: {{$pharmacy->name}}</p>
                                <p>Address: {{$pharmacy->address}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">
            <h3>Pharmacy products</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-group">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ownProducts as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->description}}</td>
                                    <td><img src="{{ asset($product->image_path)}}" style="width: 100px; height: 50px"></td>
                                </tr>
                                @endforeach
                                </form>
                            </tbody>
                        </table>
                        {{ $ownProducts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
