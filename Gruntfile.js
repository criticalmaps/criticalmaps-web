module.exports = function ( grunt ) {
	'use strict';
	require('load-grunt-tasks')(grunt, {
		pattern: ['grunt-*']
	});
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),
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
				},{
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
				},{
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
			 }
		},
		clean: {
			dev: [
				'assets',
				'*.php',
				'*.txt',
				'*.xml',
				'.htaccess'
			],
			dist: [
				'upload',
				'assets',
				'*.php',
				'*.txt',
				'*.xml',
				'.htaccess'
			]
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
						require('autoprefixer-core')({ browsers: ['last 2 versions'] })
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
						require('autoprefixer-core')({ browsers: ['last 5 versions'] })
					]
				},
				src: 'upload/assets/css/style.css'
			}
		},
		uglify: {
			dev: {
				options: {
					mangle: false
				},
				files: {
					'assets/js/script.js': [
						'src/js/**/*.js'
					],
					'assets/js/libs.js': [
						'<%= config.jsDependencies %>'
					]
				}
			},
			devlight: {
				options: {
					mangle: false
				},
				files: {
					'assets/js/script.js': [
						'src/js/**/*.js'
					]
				}
			},
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
			js: {
				files: [
					'src/js/**/*.js'
				],
				tasks: [
					'uglify:devlight'
				]
			},
			images: {
				files: [
					'src/images/*.*'
				],
				tasks : [
					'copy:dev'
				]
			},
			files: {
				files: [
					'src/**/*.php',
					'src/**/*.txt',
					'src/**/*.xml'
				],
				tasks : [
					'copy:dev'
				]
			}
		},
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
	});
	grunt.registerTask('default', [
		'clean:dev',
		'sass:dev',
		'postcss:dev',
		'cssmin:dev',
		'uglify:dev',
		'copy:dev',
		'watch'
	]);
	grunt.registerTask('build', [
		'clean:dist',
		'sass:dist',
		'postcss:dist',
		'cssmin:dist',
		'uglify:dist',
		'copy:dist',
	    'smushit',
	    'ftp-diff-deployer'
	]);
};