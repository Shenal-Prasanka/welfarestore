@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-user-shield mr-2"></i>Guarantor Details Report</h1>
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
            <div class="card-header bg-warning text-white">
                <h3 class="card-title"><i class="fas fa-shield-alt mr-2"></i>All Guarantors</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Army ID</th>
                                <th>Enlisted No</th>
                                <th>Regiment No</th>
                                <th>Rank</th>
                                <th>Office Address</th>
                                <th>Previous Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guarantors as $guarantor)
                                <tr>
                                    <td>{{ $guarantor->name }}</td>
                                    <td>{{ $guarantor->nic }}</td>
                                    <td>{{ $guarantor->army_id }}</td>
                                    <td>{{ $guarantor->enlisted_no }}</td>
                                    <td>{{ $guarantor->regiment_no }}</td>
                                    <td>{{ $guarantor->rank }}</td>
                                    <td>{{ $guarantor->office_address }}</td>
                                    <td>{{ $guarantor->previous_unit ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No guarantor details found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $guarantors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
