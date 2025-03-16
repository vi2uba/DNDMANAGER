@extends('layouts.app',['page' => __('Character'), 'pageSlug' => 'character'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Characters') }}</h5>
                    <a href="{{ route('character.create') }}"
                        class="btn btn-sm btn-primary float-right">{{ __('Add Character') }}</a>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Campaign</th>
                                    <th>Character Name</th>
                                    <th>Race</th>
                                    <th>Class</th>
                                    <th>HP</th>
                                    <th>AC</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($characters as $character)
                                    <tr>
                                        <td>{{ $character->campaign->name }}</td>
                                        <td>{{ $character->name }}</td>
                                        <td>{{ $character->race }}</td>
                                        <td>{{ $character->class }}</td>
                                        <td>{{ $character->current_hit_points }}</td>
                                        <td>{{ $character->armor_class }}</td>
                                        <td>
                                            <a href="{{ route('character.edit', $character->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
