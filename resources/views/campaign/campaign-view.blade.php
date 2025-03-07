@extends('layouts.app', ['page' => __('Campaigns'), 'pageSlug' => 'campaign'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Campaigns') }}</h5>
                    <a href="{{ route('campaign.add') }}"
                        class="btn btn-sm btn-primary float-right">{{ __('Add Campaign') }}</a>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">Campaign Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->name }}</td>
                                        <td>
                                            <a href="">{{ $campaign->description }}</a>
                                        </td>
                                        <td>{{ $campaign->created_at->format('F j, Y - g:i A') }}</td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                </div>
                                            </div>
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
