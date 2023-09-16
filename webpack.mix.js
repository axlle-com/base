const mix = require('laravel-mix');

/********** admin **********/
mix.styles([
    'resources/plugins/vuexy/fonts/feather/iconfont.css',
    'resources/plugins/vuexy/fonts/font-awesome/css/font-awesome.css',
    'resources/plugins/vuexy/vendors/css/vendors.min.css',
    'resources/plugins/vuexy/vendors/css/tables/datatable/dataTables.bootstrap5.min.css',
    'resources/plugins/vuexy/vendors/css/tables/datatable/responsive.bootstrap5.min.css',
    'resources/plugins/vuexy/vendors/css/pickers/flatpickr/flatpickr.min.css',
    'resources/plugins/vuexy/css/bootstrap.css',
    'resources/plugins/vuexy/css/bootstrap-extended.css',
    'resources/plugins/vuexy/css/colors.css',
    'resources/plugins/vuexy/css/components.css',
    'resources/plugins/vuexy/css/themes/bordered-layout.css',
    'resources/plugins/vuexy/css/core/menu/menu-types/vertical-menu.css',
    'resources/plugins/vuexy/css/plugins/forms/pickers/form-flat-pickr.css',
    'resources/plugins/vuexy/css/pages/authentication.css',

], 'public/admin/css/main.css');
mix.scripts([
    'resources/plugins/vuexy/vendors/js/vendors.min.js',
    'resources/plugins/vuexy/vendors/js/tables/datatable/jquery.dataTables.min.js',
    'resources/plugins/vuexy/vendors/js/tables/datatable/dataTables.bootstrap5.min.js',
    'resources/plugins/vuexy/vendors/js/tables/datatable/dataTables.responsive.min.js',
    'resources/plugins/vuexy/vendors/js/tables/datatable/responsive.bootstrap5.js',
    'resources/plugins/vuexy/vendors/js/pickers/flatpickr/flatpickr.min.js',
    'resources/plugins/vuexy/js/core/app-menu.js',
    'resources/plugins/vuexy/js/core/app.js',
    'resources/plugins/vuexy/js/scripts/tables/table-datatables-advanced.js',

    'public/main/js/glob.js',
], 'public/admin/js/main.js');

mix.copy('resources/plugins/vuexy/fonts/font-awesome/webfonts', 'public/webfonts');
mix.copy('resources/plugins/vuexy/fonts/feather/fonts', 'public/fonts');
// mix.copy('resources/admin/img', 'public/img');
// mix.copy([
//     'resources/plugins/material-design-icons-iconfont/fonts',
//     'resources/plugins/summernote/font'
// ], 'public/admin/css/fonts');
// mix.copy('resources/plugins/fontawesome-free/webfonts', 'public/admin/webfonts');
// mix.copy('resources/font/montserrat/font', 'public/font');
// mix.copy('resources/font/play/font', 'public/font');



