@extends('layouts.app', ['page' => __('Edit Campaign'), 'pageSlug' => 'campaign'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Campaign') }}</h5>
                    <a href="{{ route('campaign.index') }}" class="btn btn-sm btn-primary float-right">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('campaign.update', $campaign->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Campaign Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter campaign name" value="{{ $campaign->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Write a brief description">{{ $campaign->description }}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">{{ __('Update Campaign') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
