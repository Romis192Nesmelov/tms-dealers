@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($city) ? __('Edit city').' «'.$city->name.'»' : __('Add city') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_city') }}" method="post">
                @csrf
                @if (isset($city))
                    <input type="hidden" name="id" value="{{ $city->id }}">
                @endif

                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('admin.blocks.input_block', [
                            'label' => __('Title'),
                            'name' => 'name',
                            'type' => 'text',
                            'max' => 191,
                            'placeholder' => __('Title'),
                            'value' => isset($city) ? $city->name : ''
                        ])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks.button_block', ['buttonType' => 'submit', 'icon' => ' icon-floppy-disk', 'buttonText' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection
