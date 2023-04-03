import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';

Nova.booting((app, store) => {
  app.component('index-nova-field-system-file', IndexField);
  app.component('detail-nova-field-system-file', DetailField);
  app.component('form-nova-field-system-file', FormField);
});
