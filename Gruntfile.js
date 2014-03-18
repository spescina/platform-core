module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            files: ['Gruntfile.js', 'public/src/js/*.js'],
            options: {
                globals: {
                    jQuery: true,
                    console: true,
                    module: true
                }
            }
        },
        copy: {
            dev: {
                files: [
                    {
                        expand: true,
                        src: [
                            'bower_components/jquery/dist/jquery.js',
                            'bower_components/bootstrap/dist/js/bootstrap.js',
                            'bower_components/moment/moment.js',
                            'bower_components/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
                            'bower_components/fancybox/source/jquery.fancybox.js',
                            'bower_components/summernote/dist/summernote.js',
                            'bower_components/handlebars/handlebars.js'
                        ],
                        dest: 'public/src/js/vendor',
                        flatten: true
                    },
                    {
                        expand: true,
                        src: [
                            'bower_components/bootstrap/dist/css/bootstrap.css',
                            'bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
                            'bower_components/fancybox/source/jquery.fancybox.css',
                            'bower_components/font-awesome/css/font-awesome.css',
                            'bower_components/summernote/dist/summernote.css'
                        ],
                        dest: 'public/src/css/vendor',
                        flatten: true
                    },
                    {
                        expand: true,
                        cwd: 'bower_components/bootstrap/dist',
                        src: ['fonts/*'],
                        dest: 'public/src/css'
                    },
                    {
                        expand: true,
                        cwd: 'bower_components/font-awesome',
                        src: ['fonts/*'],
                        dest: 'public/src/css'
                    }
                ]
            }
        },
        watch: {
            publish: {
                files: [
                    'public/src/**/*.*'
                ],
                tasks: ['exec'],
                options: {
                    spawn: false
                }
            }
        },
        clean: {
            dev: [
                'public/src/js/vendor',
                'public/src/css/vendor',
		'public/src/img'
            ]
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('dev', ['jshint', 'clean:dev', 'copy:dev']);

    grunt.registerTask('default', ['jshint', 'watch']);

};