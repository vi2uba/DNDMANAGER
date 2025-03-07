@extends('layouts.app', ['page' => __('Create Campaign'), 'pageSlug' => 'campaign'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Campaign') }}</h5>
                    <a href="{{ route('campaign.index') }}" class="btn btn-sm btn-primary float-right">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('campaign.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Campaign Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter campaign name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Write a brief description"></textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">{{ __('Create Campaign') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
