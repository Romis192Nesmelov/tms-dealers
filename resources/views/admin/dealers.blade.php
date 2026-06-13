@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-dealer', 'head' => __('Are you sure you want to delete this dealer?')])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Dealers') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">{{ __('City') }}</th>
                    <th class="text-center">{{ __('Title') }}</th>
                    <th class="text-center">{{ __('Address') }}</th>
                    <th class="text-center">{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Edit').'/'.__('Delete') }}</th>
                </tr>
                @foreach ($dealers as $dealer)
                    <tr role="row" id="{{ 'dealer_'.$dealer->id }}">
                        <td class="text-center">{{ $dealer->id }}</td>
                        <td class="text-center">{{ $dealer->city->name }}</td>
                        <td class="text-center">{{ $dealer->name }}</td>
                        <td class="text-center">{{ $dealer->address }}</td>
                        <td class="text-center">@include('admin.blocks.status_block', ['status' => $dealer->active, 'trueLabel' => __('Active'), 'falseLabel' => __('Not active')])</td>
                        <td class="text-center">
                            <a href="{{ route('admin.dealers', ['id' => $dealer->id]) }}">
                                <span class="glyphicon glyphicon-edit mr-3"></span>
                            </a>
                            <a class="del-icon" del-data="{{ $dealer->id }}" modal-data="delete-modal">
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
