@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-chart-bar mr-2"></i>Reports Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        @if($userRole == 'Unit Clerk' || $userRole == 'Unit OC')
        <!-- Unit Clerk / Unit OC Reports -->
        <div class="row">
            <!-- Item Loan Applications Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Item Loan Applications
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View all item loan applications submitted by members
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-3x text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.item-loans') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved/Rejected Loans Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-success shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Approved / Rejected Loans
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View approved and rejected item loan applications
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.approved-rejected') }}" class="btn btn-success btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membership Details Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-info shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Membership Details
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View all member information and details
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-3x text-info"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.membership') }}" class="btn btn-info btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guarantor Details Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-warning shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Guarantor Details
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View all guarantor information and details
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-3x text-warning"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.guarantors') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($userRole == 'Welfare Shop Clerk' || $userRole == 'Welfare Shop OC')
        <!-- Welfare Shop Clerk / Welfare Shop OC Reports -->
        <div class="row">
            <!-- Guarantor Details Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-warning shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Guarantor Details
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View all guarantor information from your welfare shop
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-3x text-warning"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.welfare-guarantors') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membership Details Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-info shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Membership Details
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View member information from your welfare shop
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-3x text-info"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.welfare-membership') }}" class="btn btn-info btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welfare Loan Details Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-success shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Welfare Loan Details
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    Item loans, 1 Lak, 3 Lak, and CIB loans
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-3x text-success"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.welfare-loans') }}" class="btn btn-success btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welfare Item Price List Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Welfare Item Price List
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View all product prices and categories
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags fa-3x text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.welfare-pricelist') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loan Details Regiment Wise Report -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100 border-left-danger shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Loan Details Regiment Wise
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    View loan statistics grouped by regiment
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-pie fa-3x text-danger"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('reports.loans-regiment-wise') }}" class="btn btn-danger btn-block">
                                <i class="fas fa-eye mr-2"></i>View Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}
.border-left-danger {
    border-left: 4px solid #e74a3b !important;
}
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
}
</style>
@endsection
