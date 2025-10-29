$(function () {

    fetchLevels();

});//end of document ready

let fetchLevels = () => {

    $(document).on('change', '#project-id', function () {

        if (this.value && this.value != 0) {

            let url = $(this).find(':selected').data('levels-url');

            $.ajax({
                url: url,
                cache: false,
                success: function (html) {

                    $('#level-id option').not(':first').remove();
                    $('#level-id').append(html);
                    $('#level-id').attr('disabled', false);

                },
            });//end of ajax call

        } else {

            $('#level-id').attr('disabled', true);
            $('#level-id').val('').trigger('change');

        } //end of else

    });

}

