@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-city', 'head' => __('Are you sure you want to delete this city?')])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Cities') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">{{ __('Title') }}</th>
                    <th class="text-center">{{ __('Date of creation') }}</th>
                    <th class="text-center">{{ __('Date of change') }}</th>
                    <th class="text-center">{{ __('Edit') }}</th>
                    <th class="text-center">{{ __('Delete') }}</th>
                </tr>
                @foreach ($cities as $city)
                    <tr role="row" id="{{ 'city_'.$city->id }}">
                        <td class="text-center">{{ $city->id }}</td>
                        <td class="text-center">{{ $city->name }}</td>
                        <td class="text-center">{{ $city->created_at }}</td>
                        <td class="text-center">{{ $city->updated_at }}</td>

                        <td class="text-center">
                            <a href="{{ route('admin.cities', ['id' => $city->id]) }}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="del-icon" del-data="{{ $city->id }}" modal-data="delete-modal">
                                <span  class="glyphicon glyphicon-remove-circle"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        @include('admin.blocks.add_button_block')
    </div>
@endsection
