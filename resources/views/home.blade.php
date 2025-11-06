@extends('layouts.app')

@section('content')
<style>
    .product-card {
        transition: all 0.3s ease;
        border-left: 4px solid #007bff;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .product-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .stat-card {
        border-radius: 10px;
        transition: transform 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
    }
    
    .category-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }
    
    .category-filter {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .category-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .category-section {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilters = document.querySelectorAll('.category-filter');
    const categorySections = document.querySelectorAll('.category-section');
    
    // Show only the first category by default
    if (categoryFilters.length > 0 && categorySections.length > 0) {
        const firstCategory = categoryFilters[0].getAttribute('data-category');
        categorySections.forEach(section => {
            const sectionCategory = section.getAttribute('data-category');
            section.style.display = (sectionCategory === firstCategory) ? 'block' : 'none';
        });
    }
    
    // Handle category filter clicks
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            
            // Remove active class from all filters
            categoryFilters.forEach(f => f.classList.remove('active'));
            
            // Add active class to clicked filter
            this.classList.add('active');
            
            // Show only selected category
            categorySections.forEach(section => {
                const sectionCategory = section.getAttribute('data-category');
                section.style.display = (sectionCategory === selectedCategory) ? 'block' : 'none';
            });
        });
    });
});
</script>



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        @if(auth()->user()->hasRole('Welfare Shop Clerk') || auth()->user()->hasRole('Welfare Shop OC'))
            <!-- Category Filter and Products -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title"><i class="fas fa-cubes mr-2"></i>Available Products</h3>
                        </div>
                        <div class="card-body">
                            @if($categories->count() > 0)
                                <!-- Category Filter Buttons -->
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fas fa-filter mr-2"></i>Select Category:</h5>
                                    <div class="btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
                                        @foreach($categories as $index => $category)
                                            <label class="btn btn-outline-primary m-1 category-filter {{ $index === 0 ? 'active' : '' }}" data-category="{{ $category->category }}">
                                                <input type="radio" name="category" {{ $index === 0 ? 'checked' : '' }}> 
                                                <i class="fas fa-tag mr-1"></i>{{ $category->category }} ({{ $category->products_count }})
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <!-- Products Display -->
                                @foreach($categoryStocks as $categoryName => $products)
                                    <div class="category-section" data-category="{{ $categoryName }}">
                                        <h4 class="mb-3 text-primary">
                                            <i class="fas fa-folder-open mr-2"></i>{{ $categoryName }}
                                        </h4>
                                        <div class="row mb-4">
                                            @foreach($products as $product)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                    <div class="card product-card">
                                                        <div class="card-body text-center">
                                                            <div class="product-icon bg-primary text-white mx-auto">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                            <h5 class="card-title font-weight-bold">{{ $product->item_name }}</h5>
                                                            @if($product->item_model)
                                                                <small class="text-muted d-block mb-2">
                                                                    <i class="fas fa-barcode mr-1"></i>{{ $product->item_model }}
                                                                </small>
                                                            @endif
                                                            <span class="badge badge-success category-badge mb-2">
                                                                {{ $product->item_category }}
                                                            </span>
                                                            <div class="mt-3">
                                                                <div class="mb-3">
                                                                    <h2 class="text-primary mb-0">{{ $product->available_count }}</h2>
                                                                    <small class="text-muted">Available in Stock</small>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <strong class="text-success">Welfare Price:</strong>
                                                                    <h5 class="text-success mb-0">Rs. {{ number_format($product->welfare_price, 2) }}</h5>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted">Normal Price: Rs. {{ number_format($product->normal_price, 2) }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No available stock items found in your welfare shop.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Default Dashboard for Other Roles -->
            <div class="row">
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalSuppliers }}</h3>
                            <p>Total Suppliers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $welfares }}</h3>
                            <p>Total WelfareShops</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $products }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $regements }}</h3>
                            <p>Total Regiments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-flag"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $ranks }}</h3>
                            <p>Total Ranks</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $units }}</h3>
                            <p>Total Units</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
