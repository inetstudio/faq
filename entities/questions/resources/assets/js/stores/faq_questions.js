import hash from 'object-hash';
import { v4 as uuidv4 } from 'uuid';

window.Admin.vue.stores['faq_questions'] = new window.Vuex.Store({
    state: {
        emptyQuestion: {
            model: {
                title: '',
                answer: '',
            },
            errors: {},
            isModified: false,
            hash: ''
        },
        question: {},
        mode: ''
    },
    mutations: {
        setQuestion (state, question) {
            let emptyQuestion = JSON.parse(JSON.stringify(state.emptyQuestion));
            emptyQuestion.model.id = uuidv4();

            let resultQuestion = _.merge(emptyQuestion, question);
            resultQuestion.hash = hash(resultQuestion.model);

            state.question = resultQuestion;
        },
        setMode (state, mode) {
            state.mode = mode;
        },
    }
});
