module.exports = function ( grunt ) {

  require( 'load-grunt-tasks' )( grunt );

  grunt.initConfig( {

    pkg: grunt.file.readJSON( 'package.json' ),

    copy: {
      main: {
       src: ['**/*'],
        expand: true,
        dot: true,
        dest: 'upload'
      }
    },

    concat: {
      js: {
        src: 'js/vendor/*.js',
        dest: 'js/vendor.js'
      }
    },

    uglify: {
      my_target: {
        files: {
          'js/vendor.js': ['js/vendor.js']
        }
      }
    },

    clean: [
      "upload/img/psd",
      "upload/.git/",
      "upload/node_modules/",
      "upload/.travis.yml"
    ],

    smushit: {
      group1: {
        src: 'upload/'
      }
    },

    'ftp-diff-deployer': {
      options: {},
      www: {
        options: {
          host: 'criticalmaps.net',
          auth: {
            username: process.env.FTP_USER,
            password: process.env.FTP_PASSWORD
          },
          src: 'upload/',
          dest: '/'
        }
      }
    }
  } ); 

  grunt.registerTask( 'default', [
    'copy',
    'concat',
    'uglify',
    'clean',
    'smushit',
    'ftp-diff-deployer'
  ] );
};