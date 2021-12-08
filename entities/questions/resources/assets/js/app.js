import {questions} from './package/questions';

require('./plugins/tinymce/plugins/faq_questions');

require('../../../../../../widgets/entities/widgets/resources/assets/js/mixins/widget');

require('./stores/faq_questions');

window.Vue.component(
    'FaqWidget',
    () => import('./components/partials/FaqWidget/FaqWidget.vue'),
);

window.Vue.component(
    'QuestionsList',
    () => import('./components/partials/QuestionsList/QuestionsList.vue'),
);

window.Vue.component(
    'QuestionsListItem',
    () => import('./components/partials/QuestionsList/QuestionsListItem.vue'),
);

window.Vue.component(
    'QuestionsListItemForm',
    () => import('./components/partials/QuestionsList/QuestionsListItemForm.vue'),
);

questions.init();
