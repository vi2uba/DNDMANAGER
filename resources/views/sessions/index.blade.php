@extends('layouts.app', ['page' => __('Sessions'), 'pageSlug' => 'sessions'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Game Sessions') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Campaign</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Players</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->campaign->name }}</td>
                                <td>{{ $session->session_date }}</td>
                                <td>
                                    @if($session->session_date < now())
                                        <span class="badge badge-secondary">Past</span>
                                    @else
                                        <span class="badge badge-primary">Upcoming</span>
                                    @endif
                                </td>
                                <td>{{ $session->attendees->count() }} players</td>
                                <td>
                                    <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
