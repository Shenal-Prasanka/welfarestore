@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-tags mr-2"></i>Welfare Item Price List</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('reports.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>All Approved Products with Prices</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Number</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Normal Price</th>
                                <th>Welfare Price</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                @php
                                    $discount = $product->normal_price > 0 ? (($product->normal_price - $product->welfare_price) / $product->normal_price) * 100 : 0;
                                @endphp
                                <tr>
                                    <td>{{ $product->product_number }}</td>
                                    <td>{{ $product->product }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $product->category ? $product->category->category : 'N/A' }}</span>
                                    </td>
                                    <td>Rs. {{ number_format($product->normal_price, 2) }}</td>
                                    <td><strong class="text-success">Rs. {{ number_format($product->welfare_price, 2) }}</strong></td>
                                    <td>
                                        @if($discount > 0)
                                            <span class="badge badge-success">{{ number_format($discount, 1) }}% OFF</span>
                                        @else
                                            <span class="badge badge-secondary">No Discount</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
