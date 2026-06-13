<?php ob_start(); ?>
<div class="modal-body modal-delete" del-function="{{ $function }}" >
    <h3>{{ $head }}</h3>
</div>
<!-- Футер модального окна -->
<div class="modal-footer">
    @include('admin.blocks.button_block', ['type' => 'button', 'buttonText' => __('Yes'), 'addClass' => 'delete-yes'])
    @include('admin.blocks.button_block', ['type' => 'button', 'buttonText' => __('No'), 'dataDismiss' => true])
</div>
@include('admin.blocks.modal_block',['id' => $modalId, 'title' => trans('admin_content.warning'), 'content' => ob_get_clean()])
