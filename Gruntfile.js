module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        modx: grunt.file.readJSON('_build/config.json'),
        banner: '/*!\n' +
            ' * <%= modx.name %> - <%= modx.description %>\n' +
            ' * Version: <%= modx.version %>\n' +
            ' * Build date: <%= grunt.template.today("yyyy-mm-dd") %>\n' +
            ' */\n',
        usebanner: {
            css: {
                options: {
                    position: 'bottom',
                    banner: '<%= banner %>'
                },
                files: {
                    src: [
                        'assets/components/timerangetv/css/mgr/timerangetv.min.css'
                    ]
                }
            },
            js: {
                options: {
                    position: 'top',
                    banner: '<%= banner %>'
                },
                files: {
                    src: [
                        'assets/components/timerangetv/js/mgr/timerangetv.min.js'
                    ]
                }
            }
        },
        uglify: {
            mgr: {
                src: [
                    'source/js/mgr/timerangetv.js',
                    'source/js/mgr/timerangetv.templatevar.js',
                    'source/js/mgr/timerangetv.renderer.js'
                ],
                dest: 'assets/components/timerangetv/js/mgr/timerangetv.min.js'
            }
        },
        sass: {
            options: {
                implementation: require('node-sass'),
                outputStyle: 'expanded',
                sourcemap: false
            },
            mgr: {
                files: {
                    'source/css/mgr/timerangetv.css': 'source/sass/mgr/timerangetv.scss'
                }
            }
        },
        postcss: {
            options: {
                processors: [
                    require('pixrem')(),
                    require('autoprefixer')()
                ]
            },
            mgr: {
                src: [
                    'source/css/mgr/timerangetv.css'
                ]
            }
        },
        cssmin: {
            mgr: {
                src: [
                    'source/css/mgr/timerangetv.css'
                ],
                dest: 'assets/components/timerangetv/css/mgr/timerangetv.min.css'
            }
        },
        imagemin: {
            png: {
                options: {
                    optimizationLevel: 7
                },
                files: [
                    {
                        expand: true,
                        cwd: 'source/img/',
                        src: ['**/*.png'],
                        dest: 'assets/components/timerangetv/img/',
                        ext: '.png'
                    }
                ]
            }
        },
        watch: {
            js: {
                files: [
                    'source/**/*.js'
                ],
                tasks: ['uglify', 'usebanner:js']
            },
            config: {
                files: [
                    '_build/config.json'
                ],
                tasks: ['default']
            }
        },
        bump: {
            copyright: {
                files: [{
                    src: 'core/components/timerangetv/model/timerangetv/timerangetv.class.php',
                    dest: 'core/components/timerangetv/model/timerangetv/timerangetv.class.php'
                }],
                options: {
                    replacements: [{
                        pattern: /Copyright 2019(-\d{4})? by/g,
                        replacement: 'Copyright ' + (new Date().getFullYear() > 2019 ? '2019-' : '') + new Date().getFullYear() + ' by'
                    }]
                }
            },
            version: {
                files: [{
                    src: 'core/components/timerangetv/model/timerangetv/timerangetv.class.php',
                    dest: 'core/components/timerangetv/model/timerangetv/timerangetv.class.php'
                }],
                options: {
                    replacements: [{
                        pattern: /version = '\d+.\d+.\d+[-a-z0-9]*'/ig,
                        replacement: 'version = \'' + '<%= modx.version %>' + '\''
                    }]
                }
            },
            inputoptions: {
                files: [{
                    src: 'core/components/timerangetv/elements/tv/input/tpl/timerange.options.tpl',
                    dest: 'core/components/timerangetv/elements/tv/input/tpl/timerange.options.tpl'
                }],
                options: {
                    replacements: [{
                        pattern: /© 2019(-\d{4})?/g,
                        replacement: '© ' + (new Date().getFullYear() > 2019 ? '2019-' : '') + new Date().getFullYear()
                    }]
                }
            }
        }
    });

    //load the packages
    grunt.loadNpmTasks('grunt-banner');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-string-replace');
    grunt.renameTask('string-replace', 'bump');

    //register the task
    grunt.registerTask('default', ['bump', 'uglify', 'sass', 'postcss', 'cssmin', 'usebanner']);
};
