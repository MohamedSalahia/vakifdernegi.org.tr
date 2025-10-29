$(function () {

    initEvaluationItems();

});//end of document ready

window.initEvaluationItems = () => {

    fetchEvaluationItems();

}

window.fetchEvaluationItems = (data = {}) => {

    if ($('.evaluation-items-wrapper.active').length) {

        let loading = `
              <div class="absolute-centered ">
                  <div class="loader"></div>
              </div>
        `;

        let url = $('.evaluation-items-wrapper.active').attr('data-evaluation-items-url');

        $('.evaluation-items-wrapper.active').empty().append(loading);

        $.ajax({
            url: url,
            cache: false,
            data: data,
            success: function (response) {

                $('.evaluation-items-wrapper.active').empty().append(response['view']);

                // handleReorderParts();

                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }

            },

        });//end of ajax call

    }//end of if
}

window.handleEvaluationItemsEmptyState = () => {

    let noEvaluationItems = $('meta[name="no-evaluation-items-found"]').attr('content');

    if ($('.evaluation-items-wrapper.active .single-evaluation-item').length == 0) {

        let html = `
            <div class="no-data w-100 d-flex flex-column justify-content-center align-items-center absolute-centered">
                <img alt="" class="img-fluid" src="/admin_assets/app-assets/images/action-failed.svg" style="width: 120px;" alt="">
                <p class="m-2"> ${noEvaluationItems}</p>
            </div><!-- no-data -->
        `;

        $('.evaluation-items-wrapper.active').append(html);

    }//end of if

}

window.handleReorderEvaluationItems = () => {

    $('.evaluation-items-wrapper.active').sortable({
        items: "> .single-evaluation-item",
        cursor: "move",
        tolerance: 'pointer',
        placeholder: "sortable-placeholder", // add a custom placeholder class
        dropOnEmpty: false,
        containment: "parent",
        // helper: 'clone',
        opacity: 0.5,
        revert: 50,
        forceHelperSize: true,

        update: function (event, ui) {

            let url = $(this).data('reorder-url');

            let ids = $(this).find('.single-evaluation-item').map(function () {
                return $(this).attr('data-evaluation-item-id');
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