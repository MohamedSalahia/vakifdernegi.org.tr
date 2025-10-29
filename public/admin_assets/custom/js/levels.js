$(function () {


});//end of document ready


window.handleReorderLevels = () => {

    $('.levels-wrapper table tbody').sortable({
        items: "> .single-level",
        cursor: "move",
        tolerance: 'pointer',
        // placeholder: "sortable-placeholder", // add a custom placeholder class
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

        update: function (event, ui) {

            let url = $(this).data('reorder-url');

            let ids = $(this).find('.single-level').map(function () {
                return $(this).attr('data-level-id');
            }).get();

            let data = {
                'ids': ids
            }

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

            }//end of if
        }

    }).disableSelection();

}