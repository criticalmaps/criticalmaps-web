module.exports = function(grunt) {
  'use strict';
  require('load-grunt-tasks')(grunt, {
    pattern: ['grunt-*']
  });
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    config: {
      'jsDependencies': [
        'bower_components/modernizer/modernizr.js',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/history.js/scripts/bundled/html4+html5/jquery.history.js',
        'bower_components/leaflet/dist/leaflet.js',
        'bower_components/leaflet-hash/leaflet-hash.js',
        'bower_components/lazyloadxt/dist/jquery.lazyloadxt.extra.min.js'
      ],
      'cssDependencies': [
        'bower_components/normalize-css/normalize.css',
        'bower_components/leaflet/dist/leaflet.css'
      ]
    },
    copy: {
      dev: {
        files: [{
          dest: 'assets/images/',
          src: [
            '*.png',
            '*.jpg',
            '*.svg'
          ],
          cwd: 'src/images/',
          expand: true
        }, {
          dest: 'assets/font/',
          src: [
            '*.eot',
            '*.svg',
            '*.ttf',
            '*.woff'
          ],
          cwd: 'src/font/',
          expand: true
        }, {
          dest: '',
          src: [
            '*.php',
            '*.txt',
            '*.xml',
            '.htaccess'
          ],
          cwd: 'src/',
          expand: true,
          dot: true
        }]
      },
      dist: {
        files: [{
          dest: 'upload/assets/images/',
          src: [
            '*.png',
            '*.jpg',
            '*.svg'
          ],
          cwd: 'src/images/',
          expand: true
        }, {
          dest: 'upload/assets/font/',
          src: [
            '*.eot',
            '*.svg',
            '*.ttf',
            '*.woff'
          ],
          cwd: 'src/font/',
          expand: true
        }, {
          dest: 'upload/',
          src: [
            '*.php',
            '*.txt',
            '*.xml',
            '.htaccess'
          ],
          cwd: 'src/',
          expand: true,
          dot: true
        }]
      },
      docker: {
        expand: true,
        cwd: 'upload',
        src: '**',
        dest: '/var/www/html/',
        dot: true
      },
    },
    sass: {
      dev: {
        options: {
          includePaths: ['src/css'],
          sourceMaps: true
        },
        files: {
          'assets/css/style.css': 'src/css/style.scss'
        }
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'upload/assets/css/style.css': 'src/css/style.scss'
        }
      }
    },
    cssmin: {
      dev: {
        options: {
          shorthandCompacting: false,
          roundingPrecision: -1,
          sourceMap: false
        },
        files: {
          'assets/css/style.css': [
            'assets/css/style.css'
          ],
          'assets/css/libs.css': [
            '<%= config.cssDependencies %>'
          ]
        }
      },
      dist: {
        options: {
          shorthandCompacting: false,
          roundingPrecision: -1,
          sourceMap: false
        },
        files: {
          'upload/assets/css/style.css': [
            'upload/assets/css/style.css'
          ],
          'upload/assets/css/libs.css': [
            '<%= config.cssDependencies %>'
          ]
        }
      }
    },
    postcss: {
      dev: {
        options: {
          map: true,
          processors: [
            require('autoprefixer-core')({
              browsers: ['last 2 versions']
            })
          ]
        },
        src: [
          'assets/css/style.css'
        ]
      },
      dist: {
        options: {
          map: false,
          processors: [
            require('autoprefixer-core')({
              browsers: ['last 5 versions']
            })
          ]
        },
        src: 'upload/assets/css/style.css'
      }
    },
    uglify: {
      dist: {
        options: {
          mangle: false
        },
        files: {
          'upload/assets/js/script.js': [
            'src/js/**/*.js'
          ],
          'upload/assets/js/libs.js': [
            '<%= config.jsDependencies %>'
          ]
        }
      }
    },
    watch: {
      css: {
        files: [
          'src/css/**/*.scss'
        ],
        tasks: [
          'sass:dev',
          'copy:dev',
          'cssmin:dev',
          'postcss:dev'
        ]
      },
      images: {
        files: [
          'src/images/*.*'
        ],
        tasks: [
          'copy:dev'
        ]
      },
      files: {
        files: [
          'src/**/*.php',
          'src/**/*.txt',
          'src/**/*.xml'
        ],
        tasks: [
          'copy:dev'
        ]
      }
    },
    smushit: {
      group1: {
        src: 'upload/'
      }
    },
    sasslint: {
      options: {
        configFile: '.sass-lint.yml'
      },
      target: ['src/css/*.scss']
    }
  });
  grunt.registerTask('default', [
    'sass:dev',
    'postcss:dev',
    'cssmin:dev',
    'copy:dev',
    'watch'
  ]);
  grunt.registerTask('build', [
    'uglify:dist',
    'sass:dist',
    'postcss:dist',
    'cssmin:dist',
    'copy:dist',
    'smushit',
    'copy:docker'
  ]);
  grunt.registerTask('lint', ['sasslint']);
};
