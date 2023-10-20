var UINestable = function () {

    return {

        init: function () {

            $('#nestable_list_1').nestable({
                group: 0
            });

            $('#nestable_list_menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

        }

    };

}();

$(document).ready(function () {
    UINestable.init();
    $('.dd').nestable('collapseAll');
    $('#datepicker').datepicker({
        autoclose: true,
        isRTL: false,
        format: 'yyyy-mm-dd',
        language: 'mn'
    });

    //iCheck for checkbox and radio inputs
    // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //     checkboxClass: 'icheckbox_minimal-blue',
    //     radioClass: 'iradio_minimal-blue'
    // });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
})

$(document).ajaxStart(function () {
    Pace.restart()
});

function show_modal(key_name, params) {

    if (params != '') {

        params = '?' + params;

    }

    $.ajax({
        url: '/admin/' + key_name + '/create' + params,
        success: function (html) {
            $('.category-modal .modal .modal-content').html(html);
            $('.category-modal .modal').modal('show');
        }, complete: function () {
            if (key_name == 'menu_item') {
                from_category();
                from_posts();
            }
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('textarea.ckeditor').ckeditor();
        }
    });
}

function custom_submit(key_name) {

    var form = $('form#' + key_name);

    var url = form.attr('action');

    var method = form.attr('method');

    // if (form.find('[name="_method"]').val() != '') {
    //
    //     method = form.find('[name="_method"]').val();
    //
    // }

    var datas = form.serialize();

    $.ajax({

        url: url,
        type: method,
        data: datas,
        dataType: 'json',
        success: function (html) {

            if (html.boolean == true) {

                $('.category-modal .modal').modal('hide');

                $('#nestable_list_1 > ol.dd-list').prepend(html.view);

                $('#' + html.last).text(html.title);

            } else {

                $('#' + key_name).find('.form-group').removeClass('has-error');

                $('#' + key_name).find('.help-block').html('');

                $.each(html.errors, function (index, value) {

                    obtain = $('#' + key_name).find('[name="' + index + '"]');

                    obtain.parent().addClass('has-error');

                    obtain.next('.help-block').html(value);

                })

            }
        }
    })
}

function realtime_edit(id, key_name) {

    $.ajax({

        url: '/admin/' + key_name + '/' + id + '/edit',
        type: 'get',
        success: function (html) {

            $('.category-modal .modal .modal-content').html(html);
            $('.category-modal .modal').modal('show');

            if (key_name == 'menu_item') {
                from_category();
                from_posts();
            }

        }, complete: function () {
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('textarea.ckeditor').ckeditor();
        }

    })

}

function realtime_remove(sel, id, key_name) {

    var c = confirm("Та устгахдаа итгэлтэй байна уу?");

    if (c) {

        $.ajax({

            url: '/admin/' + key_name + '/' + id + '?_method=delete',
            type: 'post',
            success: function (html) {

                if (html == 'success') {

                    $(sel).parent().remove();

                    $('#nestable_list_1').find('');

                }

                alert('Амжилттай боллоо');

            }

        })

    }

}

function save_level(key_name, parent_id) {

    var list = $('#nestable_list_1').data('output', $('#nestable_list_1_output'));

    var list = list.length ? list : $(list.target),
        output = list.data('output');

    if (window.JSON) {

        var j = window.JSON.stringify(list.nestable('serialize'));

        //output.val(); //, null, 2));
        $.ajax({

            url: '/admin/' + key_name,
            type: 'POST',
            data: {data: j, parent_id: parent_id},
            beforeSend: function () {

                $('.loading').css('visibility', 'visible');

            },

            success: function (html) {

                $('.loading').css('visibility', 'hidden');

                alert('Амжилттай боллоо');

            }

        });

    }

}

function writeFiles(editor) {
    var inputs = $('table tbody.files tr td').find('input[type="checkbox"]:checked');
    var src = '';
    var alt = '';
    var finded = '';

    if (editor == 1) {
        m_editor.insertHtml('<div class="fotorama" data-width="100%" data-ratio="800/600" data-navposition="right" data-nav="thumbs" data-allowfullscreen="true">');
    }

    inputs.each(function () {
        finded = $(this).parent().next().find('a');
        src = finded.attr('href');
        alt = finded.attr('title');
        if (editor == 1) {
            m_editor.insertHtml('<img src="' + src + '" data-caption="' + alt + '" alt="' + alt + '">');
        } else if (editor == 0) {
            m_editor.insertHtml('<img src="' + src + '" data-caption="' + alt + '" alt="' + alt + '">');
        } else {
            $('img.' + editor).attr('src', src);
            $('img.' + editor).attr('alt', alt);
        }
    });

    if (editor == 1) {
        m_editor.insertHtml('</div>');
    } else {
        $('input#' + editor).val(alt);
    }

    $('.picture-modal .modal').modal('hide');
}

function upload_images(key_pic) {
    $.ajax({
        url: '/admin/media_show',
        type: 'GET',
        data: {editor: key_pic},
        success: function (html) {
            $('.picture-modal .modal .modal-dialog .modal-content').html('');
            $('.picture-modal .modal').modal('show');
            $('.picture-modal .modal .modal-dialog .modal-content').html(html);
        },
        complete: function () {
            FormFileUpload.init();
        }
    });
}

function get_child(id) {
    var sel = $('#' + id);
    var child = sel.children('span').children('i');
    if (child.hasClass('fa-plus-circle')) {
        child.removeClass('fa-plus-circle');
        child.addClass('fa-minus-circle');
        var v = $('.have').find('input').serialize();
        $.ajax({
            url: '/admin/get_child',
            type: 'POST',
            data: v + '&parent_id=' + id,
            success: function (data) {
                sel.append(data);
            },
            complete: function () {
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            }
        });
    }
    else {
        child.removeClass('fa-minus-circle');
        child.addClass('fa-plus-circle');
        sel.children('ul').remove();
    }
}

function soft_drop(id, url) {

    var c = confirm("Та устгахдаа итгэлтэй байна уу?");

    if (c) {

        $.ajax({
            url: '/admin/' + url + '/' + id + '?_method=delete',
            type: 'POST',
            success: function (html) {
                if (html == 'success') {
                    location.reload();
                }
            }
        })

    }

}

function from_category() {

    $('.from-category').select2({
        ajax: {
            url: '/admin/category/search',
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    name: params.term,
                    parent_id: $(this).attr('data-parent')
                }
            },
            processResults: function (data, params) {
                return {
                    results: data.data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 0,
        templateResult: function (repo) {
            return repo.text || repo.title || 'Хайж байна';
        },
        templateSelection: function (repo) {
            return repo.text || repo.title || '---';
        }
    });

}

function category_event_checker(sel, parent_id) {

    $.ajax({
        url: '/admin/category_for_menu',
        type: 'GET',
        data: {parent_id: $(sel).val()},
        success: function (html) {
            $(sel).parent().nextAll('.category-item').remove();
            $(sel).parent().parent().append(html);
        }, complete: function () {
            from_category();
            $('code').text($('#url').val() + '/list?category_id=' + $(sel).val());
            $('#link').val('/list?category_id=' + $(sel).val());
        }
    })

}

function post_event_checker(sel) {

    $('code').text($('#url').val() + '/' + $(sel).val() + '.html');

    $('#link').val('/' + $(sel).val() + '.html');

}


function from_posts() {

    $('.from-posts').select2({
        ajax: {
            url: '/admin/posts/search',
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    name: params.term
                }
            },
            processResults: function (data, params) {
                return {
                    results: data.data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 0,
        templateResult: function (repo) {
            return repo.text || repo.title || 'Хайж байна';
        },
        templateSelection: function (repo) {
            return repo.text || repo.title || '---';
        }
    });

}

function clear_pic(key_pic) {
    $('img.' + key_pic).attr('src', '/backend/img/no-image.jpg');
    $('img.' + key_pic).attr('alt', 'Зураггүй');

    $('input#' + key_pic).val('');
}

function _status(id, sel) {

    $.ajax({

        url: '/admin/discussion/' + id,
        type: 'get',
        success: function (html) {

            if (html == '1') {

                $(sel).removeClass('label-danger');
                $(sel).addClass('label-success');
                $(sel).html('Баталгаажсан');

            } else {

                $(sel).removeClass('label-success');
                $(sel).addClass('label-danger');
                $(sel).html('Баталгаажаагүй');

            }

        }

    })

}

function _category_children(sel) {

    var id = $(sel).val();

    $('#category_id').val(id);

    if (id != '')

        $.ajax({

            url: '/admin/category_children',
            data: {parent_id: $(sel).val()},
            dataType: 'json',
            success: function (json) {

                var html = '<select class="form-control" onchange="_category_children(this)"><option value="">---</option>';
                var count = 0;

                $.each(json, function (index, value) {

                    html += '<option value="' + value.id + '">' + value.title + '</option>';

                    count = index;

                })

                html += '</select>';

                if (count > 0) {

                    $(sel).nextAll('select').remove();
                    $(sel).after(html);

                }

            }

        })

    else

        $(sel).nextAll('select').remove();

}