@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-chart-pie mr-2"></i>Loan Details Regiment Wise</h1>
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
            <div class="card-header bg-danger text-white">
                <h3 class="card-title"><i class="fas fa-flag mr-2"></i>Loan Statistics by Regiment</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Regiment No</th>
                                <th>Loan Type</th>
                                <th>Total Loans</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loansByRegiment as $regimentNo => $loans)
                                @foreach($loans as $loan)
                                    <tr>
                                        <td><strong>{{ $regimentNo }}</strong></td>
                                        <td>
                                            @if($loan->loan_method == 'Item')
                                                <span class="badge badge-primary">Item Loan</span>
                                            @else
                                                <span class="badge badge-success">Cash Loan</span>
                                            @endif
                                        </td>
                                        <td>{{ $loan->total_loans }}</td>
                                        <td><strong class="text-success">Rs. {{ number_format($loan->total_amount, 2) }}</strong></td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No loan data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Regiments</h5>
                        <h2>{{ $loansByRegiment->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Loans</h5>
                        <h2>{{ $loansByRegiment->flatten()->sum('total_loans') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Total Amount</h5>
                        <h2>Rs. {{ number_format($loansByRegiment->flatten()->sum('total_amount'), 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
