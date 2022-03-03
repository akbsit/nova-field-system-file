Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-field-system-file', require('./components/IndexField'));
  Vue.component('detail-nova-field-system-file', require('./components/DetailField'));
  Vue.component('form-nova-field-system-file', require('./components/FormField'));
});
