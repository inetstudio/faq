<template>
    <div id="questions_list_item_form_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade" ref="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                    <h1 class="modal-title">Вопрос</h1>
                </div>
                <div class="modal-body">
                    <div class="ibox-content" v-bind:class="{ 'sk-loading': options.loading }">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>

                        <base-wysiwyg
                            label="Вопрос"
                            name="question_title"
                            v-bind:value.sync="question.model.title"
                            v-bind:simple=true
                            v-bind:attributes="{
                                'id': 'question_title',
                                'cols': '50',
                                'rows': '10',
                            }"
                        />

                        <base-wysiwyg
                            label="Ответ"
                            name="question_answer"
                            v-bind:value.sync="question.model.answer"
                            v-bind:attributes="{
                                'id': 'question_answer',
                                'cols': '50',
                                'rows': '10',
                            }"
                        />

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    <a href="#" class="btn btn-primary" v-on:click.prevent="save">Сохранить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import hash from 'object-hash';

  export default {
    name: 'QuestionsListItemForm',
    data() {
      return {
        question: {},
        options: {
          loading: true,
        },
      };
    },
    watch: {
      'question.model': {
        handler: function(newValue, oldValue) {
          this.question.isModified = !(!newValue || this.question.hash === hash(newValue));
        },
        deep: true,
      }
    },
    methods: {
      initComponent: function() {
        let component = this;

        component.question = JSON.parse(JSON.stringify(window.Admin.vue.stores['faq_questions'].state.emptyQuestion));
      },
      save() {
        let component = this;

        if (component.question.isModified && component.question.model.title.trim() !== '' && component.question.model.answer.trim() !== '') {
          component.options.loading = true;

          window.Admin.vue.stores['faq_questions'].commit('setQuestion', JSON.parse(JSON.stringify(component.question)));
          window.Admin.vue.stores['faq_questions'].commit('setMode', 'save_list_item');

          component.options.loading = false;
        }

        $(component.$refs.modal).modal('hide');
      }
    },
    created: function() {
      this.initComponent();
    },
    mounted() {
      let component = this;

      this.$nextTick(function() {
        $(component.$refs.modal).on('show.bs.modal', function() {
          component.question = JSON.parse(JSON.stringify(window.Admin.vue.stores['faq_questions'].state.question));

          window.tinymce.get('question_title').setContent(component.question.model.title);
          window.tinymce.get('question_answer').setContent(component.question.model.answer);

          component.options.loading = false;
        });

        $(component.$refs.modal).on('hide.bs.modal', function() {
          component.question = JSON.parse(JSON.stringify(window.Admin.vue.stores['faq_questions'].state.emptyQuestion));

          window.tinymce.get('question_title').setContent('');
          window.tinymce.get('question_answer').setContent('');
        });
      });
    }
  };
</script>

<style scoped>

</style>
