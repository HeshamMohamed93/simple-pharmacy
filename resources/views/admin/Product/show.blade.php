@extends('admin.admin-master')
@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Display Product
        </h2>
    </x-slot>

    <div class="py-12">
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
                                <p>Title: {{$product->title}}</p>
                                <p>Description: {{$product->description}}</p>
                                <p>Image: </p>
                                <img src="{{ asset($product->image_path)}}">
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="">Details</div>
                        <div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Pharmacy</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pharmacies as $pharmacy)
                                    <tr>
                                        <th scope="row">{{$pharmacy->id}}</th>
                                        <td>{{$pharmacy->name}}</td>
                                        <td>{{$pharmacy->address}}</td>
                                        <td>{{$pharmacy->pivot->product_price}}</td>
                                    </tr>
                                    @endforeach
                                    </form>
                                </tbody>
                            </table>
                            {{ $pharmacies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
