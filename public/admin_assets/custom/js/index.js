$(function () {

    toggleDarkMode();

    toggleMenuCollapsed();

    handleFileUpload();

});//end of document ready

let toggleDarkMode = () => {

    $(document).on('click', '.nav-link-style', function () {

        let html = $('html');

        let navLinkStyle = $('.nav-link-style')

        let mainMenu = $('.main-menu');

        let navbar = $('.header-navbar');

        let switchToLayout = html.hasClass('dark-layout') ? 'light-layout' : 'dark-layout';

        if (switchToLayout === 'dark-layout') {

            html.removeClass('light-layout').addClass('dark-layout');

            mainMenu.removeClass('menu-light').addClass('menu-dark');

            navbar.removeClass('navbar-light').addClass('navbar-dark');

            navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({class: 'ficon'}));

        } else {

            html.removeClass('dark-layout').addClass('light-layout');

            mainMenu.removeClass('menu-dark').addClass('menu-light');

            navbar.removeClass('navbar-dark').addClass('navbar-light');

            navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({class: 'ficon'}));
        }

        let url = $(this).attr('data-toggle-dark-model-url');

        $.ajax({
            url: url,
            //processData: false,
            //contentType: false,
            cache: false,
            success: function () {

            },

        });//end of ajax call

    });
}

let toggleMenuCollapsed = () => {

    $(document).on('click', '.modern-nav-toggle', function () {

        let url = $(this).attr('data-toggle-menu-collapsed-url');

        $.ajax({
            url: url,
            //processData: false,
            //contentType: false,
            cache: false,
            success: function () {

            },

        });//end of ajax call

    });
}

let handleFileUpload = () => {

    const fileInput = $('#file-upload');
    const fileButton = $('#file-button');

    fileButton.on('click', function () {
        fileInput.click();
    });

    $(document).on('change', '.upload-image', function () {

        let that = $(this);

        if (this.files && this.files[0]) {
            let fileName = this.files[0].name;

            that.closest('.form-group').find('.file-label').html(fileName);

            const reader = new FileReader();
            reader.onload = function (e) {
                that.closest('.form-group').find('.uploaded-image').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(this.files[0]);
        } else {

            that.closest('.form-group').find('.file-label').text('Choose file');
            that.closest('.form-group').find('.uploaded-image').attr('src', '').hide();

        }
    });

}//end of handle file upload

