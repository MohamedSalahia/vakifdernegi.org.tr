$(function () {

    fetchGovernorates();

    fetchAreas();

});//end of document ready

let fetchGovernorates = () => {

    $(document).on('change', '#country-id', function () {

        if (this.value && this.value != 0) {

            let url = $(this).find(':selected').data('governorates-url');

            let emptyValueText = $('#governorate-id').find(':selected').text();

            $.ajax({
                url: url,
                data: {
                    'empty_value_text': emptyValueText
                },
                cache: false,
                success: function (html) {

                    $('#governorate-id option').not(':first').remove();
                    $('#governorate-id').append(html);
                    $('#governorate-id').attr('disabled', false);

                    $('#area-id option').not(':first').remove();
                    $('#area-id').attr('disabled', true);

                },
            });//end of ajax call

        } else {

            $('#governorate-id').attr('disabled', true);
            $('#governorate-id').val('').trigger('change');

            $('#area-id').attr('disabled', true);
            $('#area-id').val('').trigger('change');

        } //end of else

    });

}

let fetchAreas = () => {

    $(document).on('change', '#governorate-id', function () {

        if (this.value && this.value != 0) {

            let url = $(this).find(':selected').data('areas-url');

            $.ajax({
                url: url,
                cache: false,
                success: function (html) {

                    $('#area-id option').not(':first').remove();
                    $('#area-id').append(html);
                    $('#area-id').attr('disabled', false);

                },
            });//end of ajax call

        } else {

            $('#area-id').attr('disabled', true);
            $('#area-id').val('').trigger('change');

        } //end of else
    });

}
