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
                            'bower_components/summernote/dist/summernote.js',
                        ],
                        dest: 'public/src/js/vendor',
                        flatten: true
                    },
                    {
                        expand: true,
                        src: [
                            'bower_components/bootstrap/dist/css/bootstrap.css',
                            'bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
                            'bower_components/summernote/dist/summernote.css',
                        ],
                        dest: 'public/src/css/vendor',
                        flatten: true
                    },
                    {
                        expand: true,
                        cwd: 'bower_components/bootstrap/dist',
                        src: ['fonts/*'],
                        dest: 'public/src/css'
                    }
                ]
            }
        },
        clean: {
            dev: [
                'public/src/js/vendor',
                'public/src/css/vendor',
                'public/src/img/vendor',
            ]
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.registerTask('dev', ['jshint', 'clean:dev', 'copy:dev']);

    grunt.registerTask('default', ['jshint']);

};