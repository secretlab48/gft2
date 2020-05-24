module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        browserify: {
            dist: {
                src: ['./src/jquery.sticky-sidebar.js'],
                dest: './dist/jquery.sticky-sidebar.js',
                options: {
                    transform: [['babelify', { presets: 'env' }]],
                    browserifyOptions: {
                        debug: false
                    }
                }
            }
        },
        uglify: {
            options: {
                compress: {
                    drop_console: true
                }
            },
            dist: {
                files: {
                    './dist/jquery.sticky-sidebar.min.js': ['./dist/jquery.sticky-sidebar.js']
                }
            }
        },
        watch: {
            scripts: {
                files: ['./src/*.js'],
                tasks: ['browserify', 'uglify'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Run the tasks
    grunt.registerTask('default', ['browserify:dist', 'uglify', 'watch']);
};
