@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-file-alt mr-2"></i>Item Loan Applications Report</h1>
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
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>All Item Loan Applications</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Application ID</th>
                                <th>Member Name</th>
                                <th>NIC</th>
                                <th>Army ID</th>
                                <th>Rank</th>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>Welfare Shop</th>
                                <th>Applied Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($itemLoans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->name }}</td>
                                    <td>{{ $loan->nic }}</td>
                                    <td>{{ $loan->army_id }}</td>
                                    <td>{{ $loan->rank }}</td>
                                    <td>{{ $loan->item_name }}</td>
                                    <td>
                                        @if($loan->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($loan->status == 'clerk_approved')
                                            <span class="badge badge-info">Clerk Approved</span>
                                        @elseif($loan->status == 'shop_coord_oc_approved')
                                            <span class="badge badge-success">Shop Coord OC Approved</span>
                                        @elseif($loan->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($loan->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $loan->welfare ? $loan->welfare->name : 'N/A' }}</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('itemloans.show', $loan->id) }}" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No item loan applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $itemLoans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
