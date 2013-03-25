module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),


    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['javascripts/src/**/*.js'],
        dest: 'javascripts/dist/<%= pkg.name %>.js'
      }
    },



    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
        sourceMap: 'javascripts/dist/<%= pkg.name %>.min.js.map'
      },
      dist: {
        files: {
          'javascripts/dist/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },


    sass: {
      options: {
        style: 'compressed'
      },
      dist: {
        files: {
          'stylesheets/<%= pkg.name %>.min.css': 'stylesheets/main.scss'
        }
      }
    }


  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  
  grunt.registerTask('default', ['concat', 'uglify','sass']);


};