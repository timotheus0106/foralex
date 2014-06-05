/**
* Gruntfile - v.0.1.0
*
* Do not configure tasks here. Every task should be configured in a
* seperate file in tasks/options.
*
* naming should match the task
* e.g. watch => watch.js
*
*/

module.exports = function(grunt) {

  // Utility to load the different option files
  // based on their names
  function loadConfig(path) {
    var glob = require('glob');
    var object = {};
    var key;

    glob.sync('*', {cwd: path}).forEach(function(option) {
      key = option.replace(/\.js$/,'');
      object[key] = require(path + option);
    });

    return object;
  }

  // Initial config
  var config = {
    pkg: grunt.file.readJSON('package.json')
  };

  // Load tasks from the tasks folder
  grunt.loadTasks('tasks');

  // Load all the tasks options in tasks/options base on the name:
  // watch.js => watch{}
  grunt.util._.extend(config, loadConfig('./tasks/options/'));

  grunt.initConfig(config);

  require('load-grunt-tasks')(grunt);
  grunt.loadNpmTasks('grunt-newer');


  // Tasks
  grunt.registerTask('default', ['watch']);
	grunt.registerTask('require', ['requirejs']);
	grunt.registerTask('build', ['sass:prod', 'autoprefixer', 'cssc:prod', 'requirejs','uglify']);

};
