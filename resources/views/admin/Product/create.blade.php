@extends('admin.admin-master')
@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Product</h2>
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter product title">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                        <a href="{{ route('product.index') }}" class="btn btn-secondary btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
