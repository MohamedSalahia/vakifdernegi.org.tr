$(function () {

    handleFromPage();

    handleToPage();

});//end of document ready

let handleFromPage = () => {

    $(document).on('change', '#book-id', function () {

        let pagesCount = $(this).find(':selected').data('pages-count');

        let availableFromPage = $(this).find(':selected').data('available-from-page');

        let options = '';

        for (let i = availableFromPage; i < pagesCount; i++) {
            options += `<option value="${i}">${i}</option>`;
        }

        $('#available-from-page option').not(':first').remove();

        $('#available-from-page').attr('disabled', false).append(options);

    });

}

let handleToPage = () => {

    $(document).on('change', '#available-from-page', function () {

        let availableFromPage = parseInt($(this).val());

        let pagesCount = parseInt($('#book-id').find(':selected').data('pages-count'));

        let options = '';

        for (let i = availableFromPage + 1; i <= pagesCount; i++) {
            options += `<option value="${i}">${i}</option>`;
        }

        $('#available-to-page option').not(':first').remove();

        $('#available-to-page').attr('disabled', false).append(options);

    });
}