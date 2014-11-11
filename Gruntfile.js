module.exports = function(grunt) {

  //Initializing the configuration object
    grunt.initConfig({

      // Task configuration
    bowercopy: {
		  options: {
		    srcPrefix: 'bower_components'
		  },
		  scripts: {
		    options: {
		      destPrefix: 'public_html/assets'
		    },
		    files: {
		      'fonts/WeatherIcons-Regular.otf': 'weather-icons/fonts/WeatherIcons-Regular.otf',
		      'fonts/weathericons-regular-webfont.eot' : 'weather-icons/fonts/weathericons-regular-webfont.eot',
		      'fonts/weathericons-regular-webfont.svg' : 'weather-icons/fonts/weathericons-regular-webfont.svg',
		      'fonts/weathericons-regular-webfont.ttf' : 'weather-icons/fonts/weathericons-regular-webfont.ttf' ,
		      'fonts/weathericons-regular-webfont.woff' : 'weather-icons/fonts/weathericons-regular-webfont.woff' 
		    }
		  }
	},
    less: {
        development: {
            options: {
              compress: true,  //minifying the result
            },
            files: {
              //compiling frontend.less into frontend.css
              "./public_html/assets/css/style.css": ["./assets/css/main.less", "./bower_components/fullpage.js/jquery.fullPage.css"],
            }
        }
    },
    concat: {
      options: {
        separator: ';',
      },
      js_frontend: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/jquery-easing-original/jquery.easing.1.3.min.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './assets/js/scripts.js'
        ],
        dest: './public_html/assets/js/scripts.js',
      },
    },
    uglify: {
      options: {
        mangle: false  // Use if you want the names of your functions and variables unchanged
      },
      frontend: {
        files: {
          './public_html/assets/js/scripts.js': './public_html/assets/js/scripts.js',
        }
      },
    },
    watch: {
        js_frontend: {
          files: [
            //watched files
            './bower_components/jquery/jquery.js',
            './bower_components/bootstrap/dist/js/bootstrap.js',
            './assets/js/scripts.js'
            ],   
          tasks: ['concat:js_frontend','uglify:frontend'],     //tasks to run
          options: {
            livereload: true                        //reloads the browser
          }
        },
        less: {
          files: ['./assets/css/*.less'],  //watched files
          tasks: ['less'],                          //tasks to run
          options: {
            livereload: true                        //reloads the browser
          }
        },
        tests: {
          files: ['app/controllers/*.php','app/models/*.php'],  //the task will run only when you save files in this location
          tasks: ['phpunit']
        }
      }
    });

  // Plugin loading
  grunt.loadNpmTasks('grunt-bowercopy');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Task definition
  grunt.registerTask('default', ['watch']);

};
