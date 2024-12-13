@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .dashboard-card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
    }
    .property-count {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .category-card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }
    .category-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .welcome-message {
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard</h2>
    <p class="welcome-message mb-4">Welcome, {{ $user->name }}!</p>
    
    <!-- Property Status Counts -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card dashboard-card bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    {{-- <i class="fas fa-home fa-2x mr-2"></i> --}}
                    <div>
                        <h5 class="card-title">Available Product</h5>
                        <p class="card-text property-count">{{ $availableCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card dashboard-card bg-danger text-white">
                <div class="card-body d-flex align-items-center">
                    {{-- <i class="fas fa-tags fa-2x mr-2"></i> --}}
                    <div>
                        <h5 class="card-title">Sold Product</h5>
                        <p class="card-text property-count">{{ $soldCount }}</p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
    <!-- Categories List -->
    <h3 class="mb-4">Categories</h3>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card category-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->title }}</h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-building mr-2"></i>
                            Products: {{ $category->products_count }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection