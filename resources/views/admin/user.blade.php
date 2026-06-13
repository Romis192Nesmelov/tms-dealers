@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($user) ? __('Edit user').' «'.$user->email.'»' : __('Add user') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_user') }}" method="post">
                @csrf
                @if (isset($user))
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @endif

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.radio_button_block', [
                                'name' => 'is_admin',
                                'values' => [
                                    ['val' => 1, 'descript' => __('Administrator')],
                                    ['val' => 0, 'descript' => __('User')]
                                ],
                                'activeValue' => isset($user) ? $user->is_admin : 0
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.input_block', [
                                'label' => __('Login'),
                                'name' => 'email',
                                'type' => 'email',
                                'max' => 100,
                                'placeholder' => __('Login'),
                                'value' => isset($user) ? $user->email : ''
                            ])

                            <div class="panel panel-flat">
                                @if (isset($user))
                                    <div class="panel-heading">
                                        <h4 class="text-grey-300">{{ __('If you do not want to change your password, then leave these fields blank') }}</h4>
                                    </div>
                                @endif
                                <div class="panel-body">
                                    @include('admin.blocks.input_block', [
                                        'label' => __('Password'),
                                        'name' => 'password',
                                        'type' => 'password',
                                        'max' => 50,
                                        'placeholder' => __('Password'),
                                        'value' => ''
                                    ])

                                    @include('admin.blocks.input_block', [
                                        'label' => __('Password confirmation'),
                                        'name' => 'password_confirmation',
                                        'type' => 'password',
                                        'max' => 50,
                                        'placeholder' => __('Password confirmation'),
                                        'value' => ''
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks.button_block', ['buttonType' => 'submit', 'icon' => ' icon-floppy-disk', 'buttonText' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection
