const mix = require('laravel-mix');

/********** admin **********/
mix.styles([
    // 'resources/plugins/bootstrap-4-6-1/css/bootstrap.css',
    'resources/font/inter/inter.min.css',
    'resources/font/play/play.css',
    'resources/plugins/material-design-icons-iconfont/material-design-icons.min.css',
    'resources/plugins/fontawesome-free/css/all.min.css',
    'resources/plugins/simplebar/simplebar.min.css',
    'resources/plugins/summernote/summernote-bs4.css',
    'resources/plugins/select2/css/select2.min.css',
    'resources/plugins/flatpickr/flatpickr.min.css',
    'resources/plugins/noty/noty.css',
    'resources/plugins/noty/themes/relax.css',
    'resources/plugins/fancybox/fancybox.css',
    'resources/admin/css/style.css',
    'resources/admin/css/sidebar-dark.min.css',
    'resources/plugins/sweetalert2/sweetalert2.min.css',
], 'public/admin/css/main.css');
mix.scripts([
    'resources/plugins/jquery-3-6-0/jquery.min.js',
    'resources/admin/js/bootstrap.bundle.min.js',
    'resources/plugins/simplebar/simplebar.min.js',
    'resources/plugins/feather-icons/feather.min.js',
    'resources/plugins/summernote/summernote-bs4.min.js',
    'resources/plugins/select2/js/select2.full.js',
    'resources/plugins/select2/js/i18n/ru.js',
    'resources/plugins/flatpickr/flatpickr.js',
    'resources/plugins/flatpickr/l10n/ru.js',
    'resources/plugins/noty/noty.js',
    'resources/plugins/inputmask/jquery.inputmask.js',
    'resources/plugins/fancybox/fancybox.umd.js',
    'resources/plugins/sweetalert2/sweetalert2.all.min.js',
    'resources/plugins/sortablejs/Sortable.min.js',
    'resources/admin/js/script.min.js',
    'resources/plugins/date-format/date-format.js',
], 'public/admin/js/main.js');
mix.copy('resources/admin/img', 'public/img');
mix.copy([
    'resources/plugins/material-design-icons-iconfont/fonts',
    'resources/plugins/summernote/font'
], 'public/admin/css/fonts');
mix.copy('resources/plugins/fontawesome-free/webfonts', 'public/admin/webfonts');
mix.copy('resources/font/montserrat/font', 'public/font');
mix.copy('resources/font/play/font', 'public/font');



