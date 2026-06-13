
// window.allMonths = ['Янв.', 'Фев.', 'Март', 'Апр.', 'Май', 'Июнь', 'Июль', 'Авг.', 'Сент.', 'Окт.', 'Нояб.', 'Декаб.'];
let deleteProps = {};
$(document).ready(function () {
    $('.styled').uniform();

    // $.mask.definitions['c'] = "[1-2]";
    // $('input[name=phone]').mask("+7(999)999-99-99");
    // $('input[name=born]').mask("99-99-9999");

    // File input
    $(".file-styled").uniform({
        wrapperClass: 'bg-blue',
        fileButtonHtml: '<i class="icon-file-plus"></i>'
    });

    // Message modal
    const messageModal = $('#message-modal');
    if (messageModal.find('h4').html()) messageModal.modal('show');

    initClickToDeleteIcon();
    // initCKEditor('html',680);

    // Click YES on delete modal
    $('.delete-yes').click(function () {
        $('#' + deleteProps.delete_modal).modal('hide');

        $.post('/admin/' + deleteProps.delete_function, {
            '_token': window.token,
            'id': deleteProps.delete_id,
        }, function (data) {
            if (data.success) {
                let row = deleteProps.delete_row;
                $('#'+row).remove();
            }
        });
    });

    $('.datatable-basic').on('draw.dt', function () {
        initClickToDeleteIcon();
    });

    // Init avatar
    // setTimeout(() => {
    //
    // }, 500);

    // Single picker
    // $('.daterange-single').daterangepicker({
    //     onSelect: function(dateText) {
    //         console.log(dateText);
    //     },
    //     singleDatePicker: true,
    //     locale: {
    //         format: 'DD/MM/YYYY',
    //         monthNames : ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    //         daysOfWeek : ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    //         week: moment.locale('en', {
    //             week: { dow: 1 }
    //         })
    //     },
    // }).on('apply.daterangepicker', function(e) {
    //     window.emitter.emit('date-change',{name: $(e.target).attr('name'), value: $(e.target).val()});
    //     $(e.target).parents('.date').find('.error').html('');
    // });
});

const initCKEditor = (name, height) => {
    if ($('textarea[name='+ name +']').length) {
        window.editor = CKEDITOR.replace(name,{
            height: height + 'px'
        });
    }
}

const initClickToDeleteIcon = () => {
    $('.del-icon').click(function () {
        deleteItem($(this));
    });
}

const deleteItem = (obj) => {
    let deleteModal = $('#'+obj.attr('modal-data'));
    deleteProps.delete_id = obj.attr('del-data');
    deleteProps.delete_function = deleteModal.find('.modal-body').attr('del-function');
    deleteProps.delete_row = obj.parents('tr').length ? obj.parents('tr').attr('id') : obj.parents('.col-lg-2').attr('id');
    deleteProps.delete_modal = obj.attr('modal-data');

    deleteModal.modal('show');
}