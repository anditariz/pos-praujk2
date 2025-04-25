@extends('layouts.main')
@section('title', 'Data Products')

@section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">@isset($title) {{ $title }} @endisset</h5>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mt-4 mb-3">
                            @if ($privilage[0]['create'])
                                <div align="left" class="mb-3">
                                    <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
                                </div>
                            @endif
                            <table class="table table-bordered table-striped table-hover">
                                <thead align="center" class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @php $no=1; @endphp
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('storage/'. $data->product_photo) }}" alt="" width="200"></td>
                                        <td>{{ $data->category->category_name}}</td>
                                        <td>{{ $data->product_name }}</td>
                                        <td>{{ $data->product_price }}</td>
                                        <td>{{ $data->is_active ? 'publish' : 'Draft' }}</td>
                                        @if ($privilage[0]['update'] || $privilage[0]['delete'])
                                            <td>
                                                @if ($privilage[0]['update'])
                                                    <a href="{{ route('products.edit', $data->id) }}" class="btn btn-sm btn-secondary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endif
                                                @if ($privilage[0]['delete'])
                                                    <form action="{{ route('products.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
