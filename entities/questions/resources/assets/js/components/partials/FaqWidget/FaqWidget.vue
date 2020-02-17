<template>
    <div id="add_faq_widget_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade"
         ref="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                    <h1 class="modal-title">Вопрос эксперту</h1>
                </div>
                <div class="modal-body">
                    <div class="ibox-content" v-bind:class="{ 'sk-loading': options.loading }">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>

                        <base-input-text
                            label = "Заголовок"
                            name = "title"
                            v-bind:value.sync = "model.params.title"
                        />

                        <base-autocomplete
                                label="Эксперт"
                                name="person"
                                v-bind:value="faq.person"
                                v-bind:attributes="{
                                    'data-search': suggestionsUrl,
                                    'placeholder': 'Выберите эксперта',
                                    'autocomplete': 'off'
                                }"
                                v-on:select="suggestionSelect"
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
  export default {
    name: 'FaqWidget',
    data() {
      return {
        model: this.getDefaultModel(),
        faq: {
          person: '',
        },
        options: {
          loading: true,
        },
        events: {
          widgetLoaded: function(component) {
            let url = route('back.persons.show', component.model.params.id).toString();

            component.options.loading = true;

            axios.get(url).then(response => {
              component.faq.person = response.data.name;
              component.options.loading = false;
            });
          },
        },
      };
    },
    computed: {
      suggestionsUrl() {
        return route('back.persons.getSuggestions').toString();
      }
    },
    methods: {
      getDefaultModel() {
        return _.merge(this.getDefaultWidgetModel(), {
          view: 'admin.module.faq.questions::front.partials.content.faq_widget',
          params: {
            id: 0,
            title: ''
          }
        });
      },
      initComponent() {
        let component = this;

        component.model = _.merge(component.model, this.widget.model);
        component.options.loading = false;
      },
      suggestionSelect(payload) {
        let component = this;

        let data = payload.data;

        component.model.params.id = data.id;
        component.faq.person = data.name;
      },
      save() {
        let component = this;

        if (component.model.params.id === 0) {
          $(component.$refs.modal).modal('hide');

          return;
        }

        component.saveWidget(function() {
          $(component.$refs.modal).modal('hide');
        });
      },
    },
    created: function() {
      this.initComponent();
    },
    mounted() {
      let component = this;

      this.$nextTick(function() {
        $(component.$refs.modal).on('hide.bs.modal', function() {
          component.faq.person = '';
          component.model = component.getDefaultModel();
        });
      });
    },
    mixins: [
      window.Admin.vue.mixins['widget'],
    ],
  };
</script>
