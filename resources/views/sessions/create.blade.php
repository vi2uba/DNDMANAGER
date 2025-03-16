@extends('layouts.app', ['page' => __('Create Session'), 'pageSlug' => 'session'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Schedule New Session for ') . $campaign->name }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sessions.store', $campaign->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Session Date</label>
                        <input type="datetime-local" name="session_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Invite Players</label>
                        <select name="attendees[]" class="form-control" multiple required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Schedule Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
