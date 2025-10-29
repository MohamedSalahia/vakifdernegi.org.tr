$(function () {


});//end of document ready


window.handleReorderExams = () => {

    $('.exams-wrapper table tbody').each(function () {

        const $tbody = $(this);

        $tbody.sortable({
            items: "> .single-exam",
            cursor: "move",
            tolerance: 'pointer',
            dropOnEmpty: false,
            containment: "parent",
            helper: function (e, tr) {
                const $originals = tr.children();
                const $helper = tr.clone();

                $helper.children().each(function (index) {
                    $(this).width($originals.eq(index).outerWidth());
                });

                return $helper;
            },
            opacity: 0.5,
            revert: 50,
            forceHelperSize: true,

            update: function () {

                const url = $tbody.data('reorder-url');

                const ids = $tbody.find('.single-exam').map(function () {
                    return $(this).attr('data-exam-id');
                }).get();

                const data = {
                    'ids': ids
                };

                if (url) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: data,
                        success: function (data) {
                            new Noty({
                                layout: 'topRight',
                                text: data.message,
                                timeout: 2000,
                                killer: true
                            }).show();
                        },
                    });
                }

            }

        }).disableSelection();

    });

}