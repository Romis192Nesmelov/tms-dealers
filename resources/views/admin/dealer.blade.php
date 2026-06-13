@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($dealer) ? __('Edit dealer').' «'.$dealer->name.'»' : __('Add dealer') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_dealer') }}" method="post">
                @csrf
                @if (isset($dealer))
                    <input type="hidden" name="id" value="{{ $dealer->id }}">
                @endif

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.radio_button_block', [
                                'name' => 'active',
                                'values' => [
                                    ['val' => 1, 'descript' => __('Active')],
                                    ['val' => 0, 'descript' => __('Not active')]
                                ],
                                'activeValue' => isset($dealer) ? $dealer->active : 0
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Title'),
                                    'name' => 'name',
                                    'type' => 'text',
                                    'max' => 191,
                                    'placeholder' => __('Title'),
                                    'value' => isset($dealer) ? $dealer->name : ''
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Contact'),
                                    'name' => 'contact',
                                    'type' => 'text',
                                    'max' => 191,
                                    'placeholder' => __('Contact'),
                                    'value' => isset($dealer) ? $dealer->contact : ''
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Phone'),
                                    'name' => 'phone',
                                    'type' => 'text',
                                    'max' => 191,
                                    'placeholder' => __('Phone'),
                                    'value' => isset($dealer) ? $dealer->phone : ''
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => 'E-mail',
                                    'name' => 'mail',
                                    'type' => 'text',
                                    'max' => 191,
                                    'placeholder' => 'E-mail',
                                    'value' => isset($dealer) ? $dealer->mail : ''
                                ])
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Site'),
                                    'name' => 'site',
                                    'type' => 'text',
                                    'max' => 191,
                                    'placeholder' => __('Site'),
                                    'value' => isset($dealer) ? $dealer->site : ''
                                ])
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div id="map" class="mw-100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.select_block', [
                                'label' => __('City'),
                                'name' => 'city_id',
                                'values' => $cities,
                                'selected' => isset($dealer) ? $dealer->city_id : 0
                            ])
                            @include('admin.blocks.input_block', [
                                'label' => __('Address'),
                                'name' => 'address',
                                'type' => 'text',
                                'max' => 191,
                                'placeholder' => __('Address'),
                                'value' => isset($dealer) ? $dealer->address : ''
                            ])
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Latitude'),
                                    'name' => 'latitude',
                                    'type' => 'number',
                                    'placeholder' => __('Latitude'),
                                    'value' => isset($dealer) ? $dealer->latitude : 0
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('admin.blocks.input_block', [
                                    'label' => __('Longitude'),
                                    'name' => 'longitude',
                                    'type' => 'number',
                                    'placeholder' => __('Longitude'),
                                    'value' => isset($dealer) ? $dealer->longitude : 0
                                ])
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('admin.blocks.button_block', [
                                    'id' => 'define_position',
                                    'buttonType' => 'button',
                                    'icon' => 'icon-map',
                                    'buttonText' => __('Define position'),
                                 ])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin.blocks.button_block', ['buttonType' => 'submit', 'icon' => 'icon-floppy-disk', 'buttonText' => trans('admin_content.save'), 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>

    <script>
        let geo_api_key = "{{ env('YANDEX_GEO_API_KEY') }}",
            myMap,
            latitudeInput,
            longitudeInput;

        $(document).ready(function() {
            latitudeInput = $('input[name=latitude]');
            longitudeInput = $('input[name=longitude]');

            ymaps.ready(() => {
                myMap = window.initMap();

                if (latitudeInput.val() && longitudeInput.val()) {
                    window.definePoint(latitudeInput, longitudeInput);
                }

                $('#define_position').click(() => {
                    let pointAddress = 'г.' + $('select[name=city_id] option:selected').text() + ', ' + $('input[name=address]').val();
                    window.getCoordinatesByAddress(pointAddress, geo_api_key, latitudeInput, longitudeInput, () => {
                        window.definePoint(latitudeInput, longitudeInput);
                    });
                });
            });
        });
    </script>
@endsection
