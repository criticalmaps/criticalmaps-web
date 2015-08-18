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

    clean: [
      "upload/img/psd",
      "upload/.git/",
      "upload/node_modules/",
      "upload/.travis.yml",
      "upload/css/.sass-cache",
      "upload/css/lib",
      "upload/css/sass",
      "upload/.sass-cache",
      "upload/.gitignore",
      "upload/Gruntfile.js",
      "upload/README.md"
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
    'concat',
    'copy',
    'clean',
    'smushit',
    'ftp-diff-deployer'
  ] );
};