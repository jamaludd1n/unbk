<?php

return [
    /*
    # Baris ini merupakan baris untuk memberikan tambahan css pada 
    # halaman - halaman tertentu seperti home dan halaman lainya
    */
    'css' => [
        'main'  => [
            "css/iconfont/material-icons.css",
            "plugins/bootstrap/css/bootstrap.css", 
            "plugins/mdl/material.min.css",
            "plugins/node-waves/waves.css",
            "plugins/animate-css/animate.css",
            "plugins/material-design-preloader/md-preloader.css",
            "plugins/bootstrap-select/css/bootstrap-select.css",
            "plugins/sweetalert/sweetalert.css",
            "css/style.css",
            "css/themes/all-themes.css"
        ],
        'table' => [
            'plugins/jquery-datatable/skin/material/css/dataTables.material.css'
        ],
        'form' => [
            'plugins/bootstrap-select/css/bootstrap-select.css'
        ],
        'print' => [
            "plugins/bootstrap/css/bootstrap.css"
        ]
    ],


    /*
    # Baris ini merupakan baris untuk memberikan tambahan javascript pada 
    # halaman - halaman tertentu seperti home dan halaman lainya
    */
        
    'js' => [
        'main'  => [
            "plugins/jquery/jquery.min.js",
            "plugins/bootstrap/js/bootstrap.js",
            "plugins/mdl/material.min.js",
            "plugins/bootstrap-select/js/bootstrap-select.js",
            "plugins/jquery-slimscroll/jquery.slimscroll.js",
            "plugins/jquery-validation/jquery.validate.js",
            "plugins/node-waves/waves.js",
            "plugins/bootstrap-notify/bootstrap-notify.js",
            "plugins/sweetalert/sweetalert.min.js",
            "js/admin.js"
        ],
        'table' => [
            'plugins/jquery-datatable/jquery.dataTables.js',
            'plugins/jquery-datatable/skin/material/js/dataTables.material.js',
            'plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'
        ],
        'form' => [
            'plugins/tinymce/tinymce.min.js'
        ],

        'dt_menu' => [
            'js/dt-menu.js'
        ],

        //ini merupakan baris code javascript untuk halaman-halaman yang di request
        'bank_soal' => [
            'js/bank-soal.js',
            'js/isi-soal.js'
        ],

        'dt_ujian' => [
            'js/dt-ujian.js'
        ],

        'r_ujian' => [
            'js/r-ujian.js'
        ],

        'dt_siswa' => [
            'js/dt-siswa.js'
        ],

        'dt_guru' => [
            'js/dt-guru.js'
        ],

        'dt_kelas' => [
            'js/dt-kelas.js'
        ],

        'dt_mapel' => [
            'js/dt-mapel.js'
        ],
        
        'dt_jurusan' => [
            'js/dt-jurusan.js'
        ]
    ],

    
];


?>