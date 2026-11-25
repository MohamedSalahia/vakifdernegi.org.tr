<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    if ($("#validatable-form").length > 0) {
        $("#validatable-form").validate({
            errorElement: 'div', //default input error message container
            focusInvalid: false, // do not focus the last invalid input
            ignore: '.ckeditor_container *',  // validate all fields including form hidden input
            rules: {
                'ar[name]': {
                    required: true,
                },
                'en[name]': {
                    required: true,
                },
                'tr[name]': {
                    required: true,
                },
                /*'ar[description]': {
                    required: true,
                },
                'en[description]': {
                    required: true,
                },
                'tr[description]': {
                    required: true,
                },*/
                'ar[content]': {
                    required: true,
                },
                'en[content]': {
                    required: true,
                },
                'tr[content]': {
                    required: true,
                },
                'ar[job]': {
                    required: true,
                },
                'en[job]': {
                    required: true,
                },
                'tr[job]': {
                    required: true,
                },
                'ar[comment]': {
                    required: true,
                },
                'en[comment]': {
                    required: true,
                },
                'tr[comment]': {
                    required: true,
                },
                'ar[meta_title]': {
                    required: true,
                },
                'en[meta_title]': {
                    required: true,
                },
                'tr[meta_title]': {
                    required: true,
                },
                'ar[meta_description]': {
                    required: true,
                },
                'en[meta_description]': {
                    required: true,
                },
                'tr[meta_description]': {
                    required: true,
                },
                'ar[keywords]': {
                    required: true,
                },
                'en[keywords]': {
                    required: true,
                },
                'tr[keywords]': {
                    required: true,
                },
                'ar[image_alt]': {
                    required: true,
                },
                'en[image_alt]': {
                    required: true,
                },
                'tr[image_alt]': {
                    required: true,
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                type: {
                    required: true,
                },
                password: {
                    minlength: 8,
                    required: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo : "#password"
                }
            },
            messages: {
                'ar[name]': {
                    required: "@lang('site.error_req')",
                },
                'en[name]': {
                    required: "@lang('site.error_req')",
                },
                'tr[name]': {
                    required: "@lang('site.error_req')",
                },
                /*'ar[description]': {
                    required: "@lang('site.error_req')",
                },
                'en[description]': {
                    required: "@lang('site.error_req')",
                },
                'tr[description]': {
                    required: "@lang('site.error_req')",
                },*/
                'ar[content]': {
                    required: "@lang('site.error_req')",
                },
                'en[content]': {
                    required: "@lang('site.error_req')",
                },
                'tr[content]': {
                    required: "@lang('site.error_req')",
                },
                'ar[job]': {
                    required: "@lang('site.error_req')",
                },
                'en[job]': {
                    required: "@lang('site.error_req')",
                },
                'tr[job]': {
                    required: "@lang('site.error_req')",
                },
                'ar[comment]': {
                    required: "@lang('site.error_req')",
                },
                'en[comment]': {
                    required: "@lang('site.error_req')",
                },
                'tr[comment]': {
                    required: "@lang('site.error_req')",
                },
                'ar[meta_title]': {
                    required: "@lang('site.error_req')",
                },
                'en[meta_title]': {
                    required: "@lang('site.error_req')",
                },
                'tr[meta_title]': {
                    required: "@lang('site.error_req')",
                },
                'ar[meta_description]': {
                    required: "@lang('site.error_req')",
                },
                'en[meta_description]': {
                    required: "@lang('site.error_req')",
                },
                'tr[meta_description]': {
                    required: "@lang('site.error_req')",
                },
                'ar[keywords]': {
                    required: "@lang('site.error_req')",
                },
                'en[keywords]': {
                    required: "@lang('site.error_req')",
                },
                'tr[keywords]': {
                    required: "@lang('site.error_req')",
                },
                'ar[image_alt]': {
                    required: "@lang('site.error_req')",
                },
                'en[image_alt]': {
                    required: "@lang('site.error_req')",
                },
                'tr[image_alt]': {
                    required: "@lang('site.error_req')",
                },
                name: {
                    required: "@lang('site.error_req')",
                },
                type: {
                    required: "@lang('site.error_req')",
                },
                email: {
                    required: "@lang('site.error_req')",
                    email: "@lang('site.email_error_req')",
                },
                password: {
                    required: "@lang('site.error_req')",
                    minlength: "@lang('site.error_min_8')",
                },
                password_confirmation: {
                    required: "@lang('site.error_req')",
                    equalTo: "@lang('site.error_equal')",
                }
            },
            errorPlacement: function(error, element) { // render error placement for each input type
                element = $(element);

                var group = $(element).closest('.form-group-sub,.form-group,.bootstrap-select,.select2-container');

                var guide = group.find('.form-text');

                if (! group.find('.valid-feedback, .invalid-feedback').length) {
                    error.addClass('invalid-feedback');
                    if (guide.length > 0) {
                        guide.before(error);
                    } else {
                        if (element.closest('.bootstrap-select').length > 0) {     //Bootstrap select
                            element.closest('.bootstrap-select').find('.bs-placeholder').after(error);
                        } else if (element.closest('.input-group').length > 0) {   //Bootstrap group
                            element.after(error);
                        } else {                                                   //Checkbox & radios
                            if (element.is(':checkbox')) {
                                element.closest('.kt-checkbox').find('> span').after(error);
                            } else {
                                element.after(error);
                            }
                        }
                    }
                }
            },
            highlight: function(element) { // hightlight error inputs
                var group = $(element).closest('.form-group-sub,.form-group,.bootstrap-select,.select2-container');
                group.addClass('validate');
                group.addClass('is-invalid');
                $(element).removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element) { // revert the change done by hightlight
                var group = $(element).closest('.form-group-sub,.form-group,.bootstrap-select,.select2-container');
                group.removeClass('validate');
                group.removeClass('is-invalid');
                $(element).removeClass('is-invalid');
            },
            success: function(label, element) {
                var group = $(element).closest('.form-group-sub,.form-group,.bootstrap-select,.select2-container');
                group.removeClass('validate');
                group.find('.invalid-feedback').remove();
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            invalidHandler: function(form, validator) {
                // Scroll to invalid item
                if (!validator.numberOfInvalids())
                    return;
                var target=validator.errorList[0].element;
                if($(target).parents('.lang-tab-pane').length)  // Mutli-langual input
                {
                    var targeted_locale=$(target).parents('.lang-tab-pane').data('locale');
                    $('.lang-nav-link[data-locale='+targeted_locale+']').trigger('click');
                }
                $('html, body').animate({
                    scrollTop: $(target).offset().top - ($('html, body').height()/2)
                }, 700);

                //please_check_inputs
                //notify(__('asdasd'),__('asdasd'),'warning',8000);

                new Noty({
                    text: "<h2>@lang('site.alert')</h2><p>@lang('site.alert_des')</p>",
                    type: "warning",
                    layout: 'bottomLeft',
                    closeWith: ['click', 'button'],
                    killer: false,
                    modal: false,
                    timeout: 1000,
                }).show();

            }
        })
    }
</script>
