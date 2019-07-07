require('./plugins/tinymce/plugins/faq_questions');
require('../../../../../../widgets/resources/assets/js/mixins/widget');

Vue.component(
    'FaqWidget',
    require('./components/partials/FaqWidget/FaqWidget.vue').default,
);

window.Switchery = require('switchery');

let questions = require('./package/questions');
questions.init();
