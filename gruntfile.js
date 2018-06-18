module.exports = function (grunt) {
    require('jit-grunt')(grunt);
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');


    var pkgConfig = grunt.file.readJSON('package.json');

    grunt.initConfig({

        pkg: pkgConfig,

        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1,
                sourceMap:true
            },
            target: {
                files: {
                    'css/style.min.css': ["css/style.css"]
                }
            }
        },
        uglify: {
            options: {
                sourceMap:true
            },
            build: {
                src: 'js/main.js',
                dest: 'js/main.min.js'
            }
        },
        less: {
            development: {
                options: {
                    paths: ["css"]
                },
                files: {"css/style.css": "less/**/*.less"}
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                // the files to concatenate
                src: ['scripts/**/*.js'],
                // the location of the resulting JS file
                dest: 'js/main.js'
            }
        },
        watch: {
            scripts: {
                files: 'scripts/**/*.js',
                tasks: ['concat', 'uglify:build'],
                options: {
                    atBegin: true,
                    livereload: true
                }
            },
            styles: {
                files: ['less/**/*.less'], // which files to watch
                tasks: ['less', 'cssmin'],
                options: {
                    nospawn: true,
                    livereload: true
                }
            },
            templates: {
                files: ['templates/**/*.ss'], // which files to watch
                options: {
                    nospawn: true,
                    livereload: true
                }
            }
        }
    });

    grunt.registerTask('salad slider', ['less', 'concat', 'uglify', 'cssmin', 'watch']);
};