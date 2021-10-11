@extends('admin.admin-master')
@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add products to pharmacy</h2>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Add Products
                        </div>
                        <div class="card-body">
                            <form action="{{route('pharmacy.add-products', $pharmacy->id)}}" method="POST">
                                @csrf
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row"><input type="checkbox" name="product[]" data-id="checkbox"class="cb" value="{{$product->id}}" /></th>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->description}}</td>
                                            <td><input type="number" class="form-control" name="prices[]" id="prices"></td>
                                            <td><input type="number" class="form-control" name="quantities[]" id="quantities"></td>
                                        </tr>
                                @endforeach
                            </form>
                            </tbody>
                            </table>
                            {{ $products->links() }}
                            <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
