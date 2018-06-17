let questions = {};

questions.init = function () {
    $('.faq-questions-package .dataTable').each(function () {
        $(this).on('draw.dt', function () {
            $('input.switchery').each(function () {

                let row = $(this).closest('tr');

                new Switchery($(this).get(0), {
                    size: 'small'
                });

                let url = ($(this).attr('data-target'));

                if (url) {
                    $(this).on('change', function () {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                if (data.success === true) {
                                    swal({
                                        title: "Запись изменена",
                                        type: "success"
                                    });

                                    row.find('.read-icon').removeClass('message-unread').addClass('message-read');
                                } else {
                                    swal({
                                        title: "Ошибка",
                                        text: "Произошла ошибка",
                                        type: "error"
                                    });
                                }
                            }
                        });
                    });
                }
            });
        });
    });
};

module.exports = questions;
