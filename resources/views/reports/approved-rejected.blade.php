@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-check-circle mr-2"></i>Approved / Rejected Loans Report</h1>
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
        <!-- Approved Loans -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h3 class="card-title"><i class="fas fa-check mr-2"></i>Approved Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Member Name</th>
                                <th>NIC</th>
                                <th>Army ID</th>
                                <th>Loan Type</th>
                                <th>Total Amount</th>
                                <th>Monthly Amount</th>
                                <th>Deduct Period</th>
                                <th>Approved Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($approvedLoans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_nic }}</td>
                                    <td>{{ $loan->member_army_id }}</td>
                                    <td>
                                        @if($loan->loan_method == 'Item')
                                            <span class="badge badge-info">Item Loan</span>
                                        @else
                                            <span class="badge badge-primary">Cash Loan</span>
                                        @endif
                                    </td>
                                    <td>Rs. {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>Rs. {{ number_format($loan->monthly_amount, 2) }}</td>
                                    <td>{{ $loan->deduct_time_period }} months</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No approved loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $approvedLoans->links() }}
                </div>
            </div>
        </div>

        <!-- Rejected Loans -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title"><i class="fas fa-times mr-2"></i>Rejected Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Member Name</th>
                                <th>NIC</th>
                                <th>Loan Type</th>
                                <th>Product Name</th>
                                <th>Rejection Reason</th>
                                <th>Rejected Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rejectedLoans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_nic }}</td>
                                    <td>
                                        @if($loan->loan_method == 'Item')
                                            <span class="badge badge-info">Item Loan</span>
                                        @else
                                            <span class="badge badge-primary">Cash Loan</span>
                                        @endif
                                    </td>
                                    <td>{{ $loan->product_name ?? 'N/A' }}</td>
                                    <td>{{ $loan->rejection_reason }}</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No rejected loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $rejectedLoans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
