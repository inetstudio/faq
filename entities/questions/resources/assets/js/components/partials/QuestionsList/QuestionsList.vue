<template>
    <div id="add_questions_widget_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade"
         ref="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                    <h1 class="modal-title">Вопрос-ответ</h1>
                </div>
                <div class="modal-body">
                    <div class="ibox-content" v-bind:class="{ 'sk-loading': options.loading }">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>

                        <template v-if="options.ready">
                            <base-dropdown
                                label="Оформление"
                                v-bind:attributes="{
                                    label: 'text',
                                    placeholder: 'Выберите тип оформления',
                                    clearable: false,
                                    reduce: option => option.value
                                }"
                                v-bind:options="options.listStyles"
                                v-bind:selected.sync="model.params.style"
                            />
                        </template>

                        <a href="#" class="btn btn-xs btn-primary m-b-lg add_question" v-on:click.prevent="add">Добавить</a>

                        <table class="table table-hover questions-list">
                            <tbody>
                                <template v-if="options.ready">
                                    <questions-list-item
                                        v-for="question in model.params.questions"
                                        :key="question.model.id"
                                        v-bind:question="question"
                                        v-on:remove="remove"
                                    />
                                </template>

                            </tbody>
                        </table>
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
  export default {
    name: 'QuestionsList',
    data() {
      return {
        model: this.getDefaultModel(),
        options: {
          loading: true,
          ready: false,
          listStyles: []
        },
        events: {
          widgetLoaded: function(component) {
            $('#questions_list_style').val(component.model.params.style).trigger('change');
          }
        }
      };
    },
    computed: {
      mode() {
        return window.Admin.vue.stores['faq_questions'].state.mode;
      }
    },
    watch: {
      mode: function(newMode) {
        if (newMode === 'save_list_item') {
          this.saveItem();
        }
      }
    },
    methods: {
      getDefaultModel() {
        return _.merge(this.getDefaultWidgetModel(), {
          view: 'admin.module.faq.questions::front.partials.content.questions_widget',
          params: {
            questions: [],
            style: ''
          }
        });
      },
      getDefaultStyle() {
        return _.get(_.head(this.options.listStyles), 'value', '');
      },
      initComponent() {
        let component = this;

        component.model = _.merge(component.model, this.widget.model);

        let url = route('back.admin-panel.config.get', 'faq_questions.list_styles');

        axios.post(url).then(response => {
          component.options.listStyles = response.data;
          component.model.params.style = this.getDefaultStyle();

          component.options.loading = false;
          component.options.ready = true;
        });
      },
      add() {
        window.Admin.vue.helpers.initComponent('faq', 'QuestionsListItemForm', {});

        window.Admin.vue.stores['faq_questions'].commit('setMode', 'add_list_item');
        window.Admin.vue.stores['faq_questions'].commit('setQuestion', {});

        window.waitForElement('#questions_list_item_form_modal', function() {
          $('#questions_list_item_form_modal').modal();
        });
      },
      remove(payload) {
        swal({
          title: 'Вы уверены?',
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: 'Отмена',
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Да, удалить'
        }).then((result) => {
          if (result.value) {
            this.model.params.questions = _.remove(this.model.params.questions, function(question) {
              return question.model.id !== payload.id;
            });
          }
        });
      },
      saveItem() {
        let storeQuestion = JSON.parse(JSON.stringify(window.Admin.vue.stores['faq_questions'].state.question));
        storeQuestion.hash = window.hash(storeQuestion.model);

        let index = this.getQuestionIndex(storeQuestion.model.id);

        if (index > -1) {
          this.$set(this.model.params.questions, index, storeQuestion);
        } else {
          this.model.params.questions.push(storeQuestion);
        }
      },
      save() {
        let component = this;

        if (component.model.params.questions.length === 0) {
          $(component.$refs.modal).modal('hide');

          return;
        }

        component.saveWidget(function() {
          $(component.$refs.modal).modal('hide');
        });
      },
      getQuestionIndex(id) {
        return _.findIndex(this.model.params.questions, function(question) {
          return question.model.id === id;
        });
      }
    },
    created: function() {
      this.initComponent();
    },
    mounted() {
      let component = this;

      this.$nextTick(function() {
        $(component.$refs.modal).on('hide.bs.modal', function() {
          component.model.params.questions = [];
          component.model = component.getDefaultModel();

          $('#questions_list_style').val(component.getDefaultStyle()).trigger('change');
        });
      });
    },
    mixins: [
      window.Admin.vue.mixins['widget'],
    ]
  };
</script>

<style scoped>

</style>
