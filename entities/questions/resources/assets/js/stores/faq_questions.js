window.Admin.vue.stores['faq_questions'] = new Vuex.Store({
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
            emptyQuestion.model.id = UUID.generate();

            let resultQuestion = _.merge(emptyQuestion, question);
            resultQuestion.hash = window.hash(resultQuestion.model);

            state.question = resultQuestion;
        },
        setMode (state, mode) {
            state.mode = mode;
        },
    }
});
