@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-hand-holding-usd mr-2"></i>Welfare Loan Details Report</h1>
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
        <!-- Item Loans -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="fas fa-box mr-2"></i>Item Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Loan ID</th>
                                <th>Member Name</th>
                                <th>Army ID</th>
                                <th>Total Amount</th>
                                <th>Monthly Amount</th>
                                <th>Deduct Period</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($itemLoans as $loan)
                                <tr>
                                    <td>{{ $loan->loan_id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_army_id }}</td>
                                    <td>Rs. {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>Rs. {{ number_format($loan->monthly_amount, 2) }}</td>
                                    <td>{{ $loan->deduct_time_period }} months</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No item loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 1 Lak Loans -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h3 class="card-title"><i class="fas fa-money-bill mr-2"></i>1 Lak Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Loan ID</th>
                                <th>Member Name</th>
                                <th>Army ID</th>
                                <th>Total Amount</th>
                                <th>Monthly Amount</th>
                                <th>Deduct Period</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lak1Loans as $loan)
                                <tr>
                                    <td>{{ $loan->loan_id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_army_id }}</td>
                                    <td>Rs. {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>Rs. {{ number_format($loan->monthly_amount, 2) }}</td>
                                    <td>{{ $loan->deduct_time_period }} months</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No 1 Lak loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 3 Lak Loans -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title"><i class="fas fa-money-bill-wave mr-2"></i>3 Lak Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Loan ID</th>
                                <th>Member Name</th>
                                <th>Army ID</th>
                                <th>Total Amount</th>
                                <th>Monthly Amount</th>
                                <th>Deduct Period</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lak3Loans as $loan)
                                <tr>
                                    <td>{{ $loan->loan_id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_army_id }}</td>
                                    <td>Rs. {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>Rs. {{ number_format($loan->monthly_amount, 2) }}</td>
                                    <td>{{ $loan->deduct_time_period }} months</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No 3 Lak loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- CIB Loans -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title"><i class="fas fa-university mr-2"></i>CIB Loans</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Loan ID</th>
                                <th>Member Name</th>
                                <th>Army ID</th>
                                <th>Total Amount</th>
                                <th>Monthly Amount</th>
                                <th>Deduct Period</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cibLoans as $loan)
                                <tr>
                                    <td>{{ $loan->loan_id }}</td>
                                    <td>{{ $loan->member_name }}</td>
                                    <td>{{ $loan->member_army_id }}</td>
                                    <td>Rs. {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>Rs. {{ number_format($loan->monthly_amount, 2) }}</td>
                                    <td>{{ $loan->deduct_time_period }} months</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No CIB loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
