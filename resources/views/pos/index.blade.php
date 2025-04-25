@extends('layouts.main')
@section('title', 'Orders')

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
                                    <a class="btn btn-primary" href="{{ route('pos.create') }}">Add Pos</a>
                                </div>
                            @endif
                            <table class="table table-bordered table-striped table-hover">
                                <thead align="center" class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Order code</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @php $no=1; @endphp
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->order_code}}</td>
                                        <td>{{ $data->order_date }}</td>
                                        <td>{{ $data->order_amount }}</td>
                                        <td>{{ $data->order_status ? 'Paid' : 'Unpaid' }}</td>
                                        @if ($privilage[0]['update'] || $privilage[0]['view'])
                                            <td>
                                                @if ($privilage[0]['view'])
                                                    <a href="{{ route('pos.show', $data->id) }}" class="btn btn-sm btn-secondary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @endif
                                                @if ($privilage[0]['update'])
                                                    <a href="{{ route('pos.edit', $data->id) }}" class="btn btn-sm btn-success">
                                                        <i class="bi bi-printer"></i>
                                                    </a>
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
