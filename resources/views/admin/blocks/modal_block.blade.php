<div id="{{ $id }}" class="modal fade {{ isset($addClass) && $addClass ? $addClass : '' }}">
    <div class="modal-dialog">
        @include('admin.blocks.modal_content_block')
    </div>
</div>