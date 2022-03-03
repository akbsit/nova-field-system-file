import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';

Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-field-system-file', IndexField);
  Vue.component('detail-nova-field-system-file', DetailField);
  Vue.component('form-nova-field-system-file', FormField);
});
