module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          outputStyle: 'expanded'
        },
        files: {
          'css/app.css': 'scss/app.scss', 
          'css/login.css': 'scss/login.scss',
          'css/solicitante.css': 'scss/solicitante.scss',
          'css/prestador.css': 'scss/prestador.scss',
          'css/minha-conta.css': 'scss/minha-conta.scss'
        }
      }
    },
    watch: {
      grunt: { files: ['Gruntfile.js'] },
      spi: { 
        files: 'img/sprites/*.png',
        tasks: ['sprite']
      },
      sass: { 
        files: [
          'scss/app.scss',
          'scss/login.scss',
          'scss/solicitante.scss',
          'scss/minha-conta.scss',
          'scss/prestador.scss',
          'scss/plugins/bootstrap.scss',
          'scss/plugins/mixins.scss',
          'scss/plugins/plugins.scss',
          'scss/structure/variables.scss',
          'scss/structure/bootstrap-overwrite.scss',
          'scss/structure/client/sections/header.scss',
          'scss/structure/client/sections/home.scss',
          'scss/structure/client/sections/footer.scss',
          'scss/structure/client/mobile/header.scss',
          'scss/structure/client/mobile/home.scss',
          'scss/structure/client/mobile/footer.scss',
          'scss/structure/client/sections/cadastro.scss',
          'scss/structure/client/mobile/cadastro.scss',
          'scss/structure/solicitante/sections/perfil.scss',
          'scss/structure/solicitante/mobile/perfil.scss',
          'scss/structure/prestador/sections/perfil.scss',
          'scss/structure/prestador/mobile/perfil.scss',
          'scss/structure/client/mobile/minha-conta.scss',
          'scss/structure/client/sections/minha-conta.scss',
        ],
        tasks: ['sass']
      }
    }
  });
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['build','watch']);
}