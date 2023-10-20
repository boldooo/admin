var m_editor = '';

CKEDITOR.plugins.add('file-upload', {
    init: function (editor) {
        editor.addCommand('FileUpload', {
            exec: function (editor) {
                m_editor = editor;
                $.ajax({
                    url: '/admin/media_show',
                    type: 'GET',
                    data: {editor: 1},
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
        });
        editor.ui.addButton('FileUpload', {
            label: 'Слайдер оруулах',
            command: 'FileUpload',
            toolbar: 'insert',
            icon: CKEDITOR.plugins.getPath('file-upload') + 'icons/gallery.png'
        });

        editor.addCommand('ImageUpload', {
            exec: function (editor) {
                m_editor = editor;
                $.ajax({
                    url: '/admin/media_show',
                    type: 'GET',
                    data: {editor: 0},
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
        });
        editor.ui.addButton('ImageUpload', {
            label: 'Зураг оруулах',
            command: 'ImageUpload',
            toolbar: 'insert',
            icon: CKEDITOR.plugins.getPath('file-upload') + 'icons/icon.png'
        });
    }
});