@extends('layouts.app', ['page' => __('Session Details'), 'pageSlug' => 'sessions'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Session Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Campaign</h6>
                        <p>{{ $session->campaign->name }}</p>
                        
                        <h6>Date & Time</h6>
                        <p>{{ $session->session_date }}</p>

                        <h6>Notes</h6>
                        <p>{{ $session->notes ?? 'No notes available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Attendees</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach($session->attendees as $attendee)
                    <li class="mb-2">
                        {{ $attendee->name }}
                        <span class="float-right badge badge-{{ $attendee->pivot->status == 'accepted' ? 'success' : ($attendee->pivot->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($attendee->pivot->status) }}
                        </span>
                    </li>
                    @endforeach
                </ul>

                @if($session->session_date > now() && auth()->user()->id != $session->campaign->dungeon_master_id)
                    <form action="{{ route('sessions.respond', $session->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('PUT')
                        <div class="btn-group w-100">
                            <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button>
                            <button type="submit" name="status" value="declined" class="btn btn-danger">Decline</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
