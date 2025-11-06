@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-users mr-2"></i>Membership Details Report</h1>
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
            <div class="card-header bg-info text-white">
                <h3 class="card-title"><i class="fas fa-id-card mr-2"></i>All Members</h3>
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
                            @forelse($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->nic }}</td>
                                    <td>{{ $member->army_id }}</td>
                                    <td>{{ $member->enlisted_no }}</td>
                                    <td>{{ $member->regiment_no }}</td>
                                    <td>{{ $member->rank }}</td>
                                    <td>{{ $member->office_address }}</td>
                                    <td>{{ $member->previous_unit ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No member details found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
