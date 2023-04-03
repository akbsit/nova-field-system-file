const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

require('./nova.mix');

mix.setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  .postCss('resources/css/field.css', 'css', [
    tailwindcss
  ])
  .nova('falbar/nova-field-system-file');
