$(function () {

    handleLivewireHooks();

    initAjaxHeader();

    ajaxData();

    initCkeditor();

    initSelect2();

    initDatePicker();

    initJsTree();

    initGalleryImages();

    ajaxModal();

    ajaxForm();

    disabledLinks();

    dataTableRecordSelect();

    showImageUnderFileExplorer()

    // checkFieldLanguage();

    toggleActive();

});//end of document ready

let handleLivewireHooks = () => {

    $(document).on('livewire:navigating', function (event) {

        window.destroySelect2();

        window.destroyDataTable();

    });

    $(document).on('livewire:navigated', (event) => {

        window.initSidebar();

        feather.replace();

        window.initSelect2();

        window.initDatePicker();

        window.initJsTree();

        window.initCkeditor();

        $('input[autofocus]').focus();

        callLivewireNavigatedMethods();

    })

}

let callLivewireNavigatedMethods = () => {

    window.fetchModels();

    window.initEcho();
}

let initAjaxHeader = () => {

    let loginUrl = $('meta[name="login-url"]').attr('content')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr, status, error) {

            if (xhr.status == 500) {

                window.handleErrorModal(xhr);

            } else if (xhr.status == 401 || xhr.status == 415 || xhr.status == 419) {

                window.location.href = loginUrl;

            }
        },
        statusCode: {}
    });

}

let ajaxData = () => {

    $(document).on('click', '.ajax-data', function () {

        let loadingHtml = `
              <div style="height: 50vh;" class="d-flex justify-content-center align-items-center">
                  <div class="loader"></div>
              </div>
        `;

        $('.ajax-data').removeClass('active');

        $(this).addClass('active');

        $('#ajax-data-wrapper').empty().append(loadingHtml);

        let url = $(this).data('url');

        $.ajax({
            url: url,
            cache: false,
            success: function (html) {
                $('#ajax-data-wrapper').empty().append(html);

                window.initJsTree();

                window.initSelect2();

                window.fetchModels();

                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            },

        });//end of ajax call

    });//end of on click

}

window.fetchModels = () => {

    window.initEvaluationItems();

}

window.initSelect2 = (parent = 'body') => {

    let select2TemplateResult = (data) => {

        if (data.loading) {
            return data.text;
        }

        // Here you can format how the results are displayed in the dropdown
        // var $container = $("<div class='select2-result-repository clearfix'>" +
        //     "<div class='select2-result-repository__title'></div></div>");
        //
        // $container.find(".select2-result-repository__title").text(data.text);
        //
        // return $container;

        let markup;

        // if (data.image == null) {

        markup = `
            <div class='select2-result-product clearfix'>           
                <div class='select2-result-product__meta'>
                    <div class='select2-result-product__title'> ${data.text}</div>
                </div>
            </div>
        `;

        // } else {

        //     markup = `
        //     <div class='select2-result-product d-flex'>
        //         <div class='select2-result-product__avatar mr-2'><img src='${data.image}'/></div>
        //         <div class='select2-result-product__meta'>
        //             <div class='select2-result-product__title'> ${data.text}</div>
        //         </div>
        //     </div>
        // `;
        // }


        return markup;
    }

    let select2TemplateSelection = (data) => {
        return data.text || data.id;
    }

    $(`${parent} .select2`).each(function () {

        let placeholder = $(this).find('option:first').text();

        if ($(this).attr('placeholder')) {

            placeholder = $(this).attr('placeholder');

        }//end of if

        $(this).select2({
            'width': '100%',
            'placeholder': placeholder,
            'language': {
                noResults: function () {
                    return $('meta[name="no-results-found"]').attr('content'); // This is German for "No results found".
                }
            }
        })

    })

    $('.select2-ajax').each(function () {

        let searchUrl = $(this).attr('data-search-url');
        let placeholder = $(this).attr('placeholder');
        let loadingText = $(this).attr('data-loading-text');

        let select2 = $(this).select2({
            placeholder: placeholder,
            ajax: {
                url: searchUrl,
                delay: 250,
                dataType: 'json',
                data: function (params) {
                    return {
                        'search': params.term,
                    };
                },
                processResults: function (data, params) {

                    return {
                        results: data.results,
                    };
                },
                cache: true
            },
            minimumInputLength: 0,
            templateResult: select2TemplateResult,
            templateSelection: select2TemplateSelection,
            escapeMarkup: function (markup) {
                return markup; // let our custom formatter work
            },
            language: {
                inputTooShort: function (args) {
                    return $('meta[name="type-at-least-one-character"]').attr('content');
                },
                searching: function () {
                    return $('meta[name="loading"]').attr('content');
                }
            },
        });

    })

}

window.initCkeditor = () => {

    window.editors = {};

    document.querySelectorAll('.ckeditor').forEach((node, index) => {
        ClassicEditor
            .create(node, {
                language: 'ar',
                mediaEmbed: {
                    previewsInData: true,
                },
                // simpleUpload: {
                //     uploadUrl: $('meta[name="ckeditor-upload-url"]').attr('content'),
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                //     }
                // },
                fontSize: {
                    options: [
                        9,
                        11,
                        13,
                        16,
                        17,
                        19,
                        21
                    ]
                },

            })
            .then(newEditor => {
                window.editors[index] = newEditor
            });
    });

}

let ajaxModal = () => {

    $(document).on('hide.bs.modal', '#ajax-modal', function (e) {

        $('#ajax-modal .modal-body').empty();

        window.destroySelect2();

        window.initSelect2();

    });

    $(document).on('click', '.ajax-modal', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let header = $(this).closest('.card-header');

        let target = header.attr('data-target');

        $(target).collapse('show');

        let loading = `
            <div class="loading-container absolute-centered">
                <div class="loader sm"></div>
            </div>
        `;

        let url = $(this).data('url');
        let modalTitle = $(this).data('modal-title');
        let modalBodyClass = $(this).data('modal-body-class')
        let modalSizeClass = $(this).data('modal-size-class') ?? 'modal-lg'

        $('#ajax-modal').modal('show');

        $('#ajax-modal .modal-body').remove();

        $('#ajax-modal .modal-content').append('<div class="modal-body relative"></div>')

        $('#ajax-modal .modal-body').addClass(modalBodyClass);

        $('#ajax-modal .modal-body').empty().append(loading);

        $('#ajax-modal .modal-title').text(modalTitle);

        $('#ajax-modal .modal-dialog').removeAttr('class').attr('class', 'modal-dialog modal-dialog-centered ' + modalSizeClass);

        $.ajax({
            url: url,
            //processData: false,
            //contentType: false,
            cache: false,
            success: function (response) {

                $('#ajax-modal .modal-body').empty().append(response['view']);

                $('#ajax-modal .select2').select2({
                    'width': '100%',
                })

                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            },

        });//end of ajax call

    });

}

let ajaxForm = () => {

    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();

        let that = $(this);

        let loading = $('meta[name="loading"]').attr('content');

        let submitButton = that.find('button[type="submit"]');

        let submitButtonHtml = submitButton.html();

        submitButton.attr('disabled', true);

        that.find('button[type="submit"]').html(loading);

        that.removeClass('active');

        that.addClass('active');

        that.find('.invalid-feedback').remove();

        let url = $(this).attr('action');
        let data = new FormData(this);

        $('.ajax-form.active .invalid-feedback').hide();

        $.ajax({
            url: url,
            data: data,
            method: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {

                hideModals();

                window.initJsTree();

                handleAjaxRefreshDataTable();

                handleAjaxResponse(response, submitButtonHtml);

                handleAjaxRemoveElements(response);

                if (that.hasClass('empty-form')) {

                    that.find('input:not([type=hidden]), textarea, select').val('');

                }//end of if

                window.handleEvaluationItemsEmptyState();

            },
            error: function (xhr, exception) {

                let loginUrl = $('meta[name="login-url"]').attr('content')

                if (xhr.status == 500) {

                    window.handleErrorModal(xhr);

                } else if (xhr.status == 401 || xhr.status == 415 || xhr.status == 419) {

                    window.location.href = loginUrl;

                } else {

                    handleAjaxErrors(xhr, submitButtonHtml);

                }//end of if

            },
            complete: function () {

                submitButton.attr('disabled', false);

                submitButton.html(submitButtonHtml);
            }
        });//end of ajax call

    })

}

window.hideModals = () => {
    $(".modal").each(function () {
        $(this).modal("hide");
    });
}

window.handleErrorModal = (xhr) => {

    $('#error-modal').modal('show');

    let html = '';

    if (xhr.responseJSON) {

        let error = xhr.responseJSON;

        html += `
            <h3> ${error.message}</h3>
            <p><strong>Exception: </strong>${error.exception}</p>
            <p><strong>file: </strong>${error.file}</p>
            <p><strong>line: </strong>${error.line}</p>
        `

        if (error.trace) {

            html += `<h5>Trace</h5>`;

        }//end of if

        error.trace.forEach((item, index) => {

            html += `
                <div style="margin-bottom: 10px">
                    <p class="mb-0"><strong>class: </strong> ${item.class}</p>
                    <p class="mb-0"><strong>file: </strong>${item.file}</p>
                    <p class="mb-0"><strong>function: </strong>${item.function}</p>
                    <p class="mb-0"><strong>line: </strong>${item.line}</p>
                </div>
            `;
        })

    } else {

        html += xhr.responseText;

    }

    $('#error-modal .modal-body').empty().append(html);

}

let handleAjaxErrors = (xhr, submitButtonHtml) => {

    let errors = xhr['responseJSON']['errors'];

    for (const field in xhr['responseJSON']['errors']) {

        $(`.ajax-form.active input[name="${field}"], .ajax-form.active select[name="${field}"], .ajax-form.active textarea[name="${field}"]`)
            .closest('.form-group')
            .append(`<span class="invalid-feedback d-block">${errors[field][0]}</span>`)

        $(`.ajax-form.active input[data-error-name="${field}"], .ajax-form.active select[data-error-name="${field}"], .ajax-form.active textarea[data-error-name="${field}"]`)
            .closest('.form-group')
            .append(`<span class="invalid-feedback d-block">${errors[field][0]}</span>`);

    }

    $('html, body, .page-data').animate({
        scrollTop: $('.invalid-feedback.d-block').offset().top - 300
    }, 200);

    $('.ajax-form input[type="password"]').val("");

    $('.ajax-form input.empty').val("");

}

let handleAjaxResponse = (response, submitButtonHtml) => {

    if (response['success_message'] && response['redirect_to']) {

        new Noty({
            layout: 'topRight',
            text: response['success_message'],
            timeout: 2000,
            killer: true
        }).show();

        setTimeout(function () {

            // window.location.href = response['redirect_to'];
            Livewire.navigate(response['redirect_to']);

        }, 100);

    } else if (
        response['redirect_to'] ||
        response['success_message'] ||
        response['replace'] ||
        response['enable_element'] ||
        response['modal_view'] ||
        response['hide'] ||
        response['show']
    ) {

        if (response['empty']) {

            $(response['empty']).empty();
        }

        if (response['redirect_to']) {

            Livewire.navigate(response['redirect_to']);
        }

        if (response['success_message']) {

            new Noty({
                layout: 'topRight',
                text: response['success_message'],
                timeout: 2000,
                killer: true
            }).show();

        }

        if (response['replace']) {

            $(response['replace']).replaceWith(response['replace_with']);

        }//end of if

        if (response['modal_view']) {

            if (response['modal-size-class']) {

                $('#ajax-modal .modal-dialog').removeAttr('class').attr('class', 'modal-dialog modal-dialog-centered ' + response['modal-size-class']);

            } //end of if

            $('#ajax-modal .modal-title').text(response['modal_title']);

            $('#ajax-modal .modal-body').empty().append(response['modal_view']);

            $('#ajax-modal').modal('show');

            $('.ajax-form.active button[type="submit"]').html(submitButtonHtml);

            $('.ajax-form.active button[type="submit"]').attr('disabled', false)

        }//end of if

        if (response['enable_element'] && $(response['enable_element']).length) {

            $(response['enable_element']).attr('disabled', false).removeClass('disabled');

        }

        if (response['append'] && response['append_to']) {

            $(response['append_to']).append(response['append']);

        }//end of if

        if (response['hide']) {

            $(response['hide']).addClass('hide-important');

        }//end of if

        if (response['show']) {

            $(response['show']).removeClass('hide-important');

        }

        feather.replace();

    } else {

        $('.ajax-form.active button[type="submit"]').html(submitButtonHtml);

        $('.ajax-form.active button[type="submit"]').attr('disabled', false)

    }

}

let handleAjaxRefreshDataTable = () => {

    if ($('.datatable').length) {
        $('.datatable').DataTable().ajax.reload();
    }//end of if

}

let handleAjaxRemoveElements = (response) => {

    if (response['remove']) {$(response['remove']).remove();}//end of if

}

let disabledLinks = () => {

    $(document).on('click', 'a.disabled, .disabled a, span[disabled]', function (e) {
        e.preventDefault();

        return
    })

}

window.destroySelect2 = () => {

    $('select').each(function () {

        if ($(this).data('select2') != undefined) {

            $(this).select2('destroy');
        }
    });

}

window.destroyDataTable = () => {

    $('.datatable').DataTable().destroy();

}

window.initDatePicker = () => {

    $('.date-picker').flatpickr({
        dateFormat: 'Y-m-d',
        disableMobile: "true",
        locale: "ar",
        position: 'top right',
        // onChange: function (selectedDates, dateStr, instance) {
        //
        //     alert('wel');
        //
        // },
    });

    $('.date-range-picker').each(function () {

        let defaultFromDate = $(this).data('default-from-date');
        let defaultToDate = $(this).data('default-to-date');

        $(this).flatpickr({
            mode: "range",
            locale: "ar",
            "dateFormat": "Y/m/d",
            defaultDate: [defaultFromDate ?? '', defaultToDate ?? ''],
            onClose: function (selectedDates, dateStr, instance) {

                const fromDate = [selectedDates[0].getFullYear(), selectedDates[0].getMonth() + 1, selectedDates[0].getDate()].join('/');
                const toDate = [selectedDates[1].getFullYear(), selectedDates[1].getMonth() + 1, selectedDates[1].getDate()].join('/');

                $('#from-date').val(fromDate).trigger('change');
                $('#to-date').val(toDate).trigger('change');

                // $('.datatable').DataTable().ajax.reload();

            },
        });

    })

    $('.time-picker').each(function () {

        $(this).flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: false,
            locale: "ar",
            position: 'top right',
        });

    })

    $('.date-time-picker').each(function () {

        $(this).flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i K",
            locale: "ar",
            position: 'top right',
        });

    })

    // $(".hijri-date-picker").hijriDatePicker({
    //     locale: "ar-sa",
    //     format: "YYYY-MM-DD",
    //     hijriFormat: "iYYYY-iMM-iDD",
    //     dayViewHeaderFormat: "MMMM YYYY",
    //     hijriDayViewHeaderFormat: "iMMMM iYYYY",
    //     showSwitcher: true,
    //     allowInputToggle: true,
    //     useCurrent: true,
    //     isRTL: true,
    //     viewMode: 'days',
    //     keepOpen: true,
    //     hijri: false,
    //     debug: true,
    //     // showClear: true,
    //     showTodayButton: true,
    //     minDate: new Date(),
    //     // showClose: true,
    //
    // });

}

let initGalleryImages = () => {

    $('.gallery-images').each(function () { // the containers for all your galleries

        $(this).magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
        });

    });

}

let dataTableRecordSelect = () => {

    //select all functionality
    $(document).on('change', '.record__select', function () {

        getSelectedRecords();
    });

    // used to select all records
    $(document).on('change', '#record__select-all', function () {

        $('.record__select').prop('checked', this.checked);
        getSelectedRecords();
    });

    let getSelectedRecords = () => {
        var recordIds = [];
        $.each($(".record__select:checked"), function () {
            recordIds.push($(this).val());
        });

        $('#record-ids').val(JSON.stringify(recordIds));

        recordIds.length > 0
            ? $('#bulk-delete').attr('disabled', false)
            : $('#bulk-delete').attr('disabled', true)

    }
}

let showImageUnderFileExplorer = () => {

    $(document).on('change', '.load-image', function (e) {

        var that = $(this);

        let reader = new FileReader();
        reader.onload = function () {
            that.parent().find('.loaded-image').attr('src', reader.result);
            that.parent().find('.loaded-image').css('display', 'block');
        }
        reader.readAsDataURL(e.target.files[0]);

    });

}

let toggleActive = () => {

    $(document).on('change', '.toggle-active', function () {

        let url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'PUT',
            cache: false,
            success: function (data) {

                new Noty({
                    layout: 'topRight',
                    text: data.message,
                    timeout: 2000,
                    killer: true
                }).show();

            },
        });//end of ajax call

    });

}

window.initJsTree = (parent = 'body') => {

    $(`${parent} .jstree`).each(function () {

        let that = $(this);

        that.jstree("destroy").empty();

        let url = that.data('url');

        let reorderUrl = that.data('reorder-url');

        let plugins = ['types', 'wholerow'];

        if (that.hasClass('checkbox')) { plugins.push('checkbox'); }//end of if

        if (that.hasClass('dnd')) { plugins.push('dnd'); }//end of if

        that.jstree({
            checkbox: {
                "keep_selected_style": false,
                "three_state": false, // to avoid that selecting a node also select its children
                "tie_selection": false // for independent check and selection handling
            },
            core: {
                'check_callback': function (operation, node, parent, position, more) {

                    if (that.hasClass('dnd') && that.hasClass('dnd-root')) {

                        if (operation === "move_node") {

                            return parent.id === "#";
                        }

                    }//end of if
                    return true; // Allow other operations
                },
                'data': {
                    'url': function (node) {
                        return node.id === '#'
                            ? url
                            : urlHasQueryParameter(url) ? `${url}&parent_id=${node.id}` : `${url}?parent_id=${node.id}`;
                    },
                    'data': function (node) {
                        return {
                            'id': node.id,
                        };
                    }
                }
            },
            types: {
                "default": {
                    "icon": "far fa-folder text-primary" // default icon
                },
                "file": {
                    "icon": "far fa-file text-primary" // icon for file type
                },
            },
            plugins: plugins,
            dnd: {
                "copy": false, // false to move, true to copy
                "inside_pos": "last", // position to insert inside
                "is_draggable": function (nodes) {
                    return true; // set condition if needed
                },
                "check_while_dragging": true, // allows checking for validity while dragging
                "always_copy": false // false to move, true to copy
            },
        });

        that.on('uncheck_node.jstree', function (e, data) {
            let inputToFill = $(`${parent} .jstree`).attr('data-input-to-fill');
            $(inputToFill).val('');
        });

        that.on('check_node.jstree select_node.jstree', function (e, data) {

            let allSelectedNodes = $(`${parent} .jstree`).jstree('get_checked', true);
            let inputToFill = $(`${parent} .jstree`).attr('data-input-to-fill');

            // $.each(allSelectedNodes, function (index, value) {
            //     if (data.node.id !== value.id) {
            //         $(`${parent} .jstree`).jstree('uncheck_node', value.id);
            //     }
            // });


            if (that.hasClass('select-ancestors')) {
                // Select all parent nodes
                let currentNode = data.node;
                while (currentNode.parent !== '#') {
                    currentNode = that.jstree(true).get_node(currentNode.parent);
                    that.jstree('check_node', currentNode);
                }
            } else {
                // Original behavior: uncheck other nodes
                $.each(allSelectedNodes, function (index, value) {
                    if (data.node.id !== value.id) {
                        $(`${parent} .jstree`).jstree('uncheck_node', value.id);
                    }
                });
            }

            // Update the input field with all checked node IDs
            let checkedNodes = that.jstree('get_checked', true);
            let checkedIds = checkedNodes.map(node => node.id);

            checkedNodes.length > 1
                ? $(inputToFill).val(JSON.stringify(checkedIds))
                : $(inputToFill).val(checkedIds[0]);


            if ($('#data-table-search').length) {

                $('#data-table-search').val((data.node.text).trim()).trigger('keyup');
            }
        });

        that.on('ready.jstree', function (e, data) {
            let inputToFill = that.attr('data-input-to-fill');
            let nodeIdsToCheck = $(inputToFill).val();

            if (nodeIdsToCheck) {
                let nodeIds = [];

                // Try parsing as JSON, if it fails, treat as a single value
                try {
                    nodeIds = JSON.parse(nodeIdsToCheck);
                    if (!Array.isArray(nodeIds)) {
                        nodeIds = [nodeIds];
                    }
                } catch (error) {
                    nodeIds = [nodeIdsToCheck];
                }

                // Check each node and open its parents
                nodeIds.forEach(nodeId => {
                    that.jstree('check_node', nodeId);

                    let parentNode = that.jstree('get_parent', nodeId);
                    while (parentNode && parentNode !== '#') {
                        that.jstree('open_node', parentNode);
                        parentNode = that.jstree('get_parent', parentNode);
                    }
                });
            }
        });

        that.on('move_node.jstree', function (e, data) {

            // Function to get the order of all nodes
            let getOrderOfAllNodes = function (tree) {

                let order = [];

                let counter = 1;

                let getNodeOrder = function (node, parentId) {

                    if (node.id !== '#') {
                        order.push({id: node.id, parent_id: parentId == '#' ? null : parentId, order: counter++});
                    }

                    let children = tree.get_node(node.id).children;

                    for (let i = 0; i < children.length; i++) {
                        getNodeOrder(tree.get_node(children[i]), node.id);
                    }
                };

                getNodeOrder(tree.get_node('#'), null); // Start from the root node

                return order;
            };

            let nodes = getOrderOfAllNodes($(`${parent} .jstree`).jstree(true));

            let ajaxData = {
                'nodes': nodes,
            }

            $.ajax({
                url: reorderUrl,
                method: 'POST',
                data: ajaxData,
                success: function (response) {

                    new Noty({
                        layout: 'topRight',
                        text: response['success_message'],
                        timeout: 2000,
                        killer: true
                    }).show();

                    if ($('#data-table-search').length) {
                        $('.datatable').DataTable().ajax.reload();
                    }//end of if

                },
                error: function (error) {

                }
            });
        });


    });

}

window.urlHasQueryParameter = (url) => {
    return url.indexOf('?') > -1;
}
