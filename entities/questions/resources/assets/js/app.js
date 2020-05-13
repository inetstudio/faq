require('./plugins/tinymce/plugins/faq_questions');

require('../../../../../../widgets/entities/widgets/resources/assets/js/mixins/widget');

require('./stores/faq_questions');

Vue.component(
    'FaqWidget',
    require('./components/partials/FaqWidget/FaqWidget.vue').default,
);

Vue.component(
    'QuestionsList',
    require('./components/partials/QuestionsList/QuestionsList.vue').default,
);

Vue.component(
    'QuestionsListItem',
    require('./components/partials/QuestionsList/QuestionsListItem.vue').default,
);

Vue.component(
    'QuestionsListItemForm',
    require('./components/partials/QuestionsList/QuestionsListItemForm.vue').default,
);

window.Switchery = require('switchery');

let questions = require('./package/questions');
questions.init();
