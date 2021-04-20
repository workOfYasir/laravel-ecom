require('./bootstrap');
const feather = require('feather-icons');
const { functions } = require('lodash');
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
window.select2 = require('select2');
feather.replace();
window.slugify = function(text){
return text.toString().toLowerCase()
.replace(/\s+/g,'-')
.replace(/[^\w\-]+/g,'')
.replace(/\-\-+/g,'-')
.replace(/^-+/,' ')
.replace(/-+$/,' ');
}
