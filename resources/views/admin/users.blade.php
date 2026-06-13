@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-user', 'head' => __('Are you sure you want to delete this user?')])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Users') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">{{ __('Date of creation') }}</th>
                    <th class="text-center">{{ __('Date of change') }}</th>
                    <th class="text-center">{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Edit').'/'.__('Delete') }}</th>
                </tr>
                @foreach ($users as $user)
                    <tr role="row" id="{{ 'user_'.$user->id }}">
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        <td class="text-center">{{ $user->updated_at }}</td>
                        <td class="text-center">@include('admin.blocks.status_block', ['status' => $user->is_admin, 'trueLabel' => __('Admin'), 'falseLabel' => __('User')])</td>
                        <td class="text-center">
                            <a href="{{ route('admin.users', ['id' => $user->id]) }}">
                                <span class="glyphicon glyphicon-edit mr-3"></span>
                            </a>
                            <a class="del-icon" del-data="{{ $user->id }}" modal-data="delete-modal">
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
