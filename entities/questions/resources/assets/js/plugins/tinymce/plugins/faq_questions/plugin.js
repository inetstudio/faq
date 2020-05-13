window.tinymce.PluginManager.add('faq', function(editor) {
  let widgetData = {
    'FaqWidget': {
      widget: {
        events: {
          widgetSaved: function(model) {
            editor.execCommand('mceReplaceContent', false, '<img class="content-widget" data-type="faq" data-id="'+model.id+'" alt="Виджет-вопрос" />'
            );
          }
        }
      }
    },
    'QuestionsList': {
      widget: {
        events: {
          widgetSaved: function(model) {
            editor.execCommand('mceReplaceContent', false, '<img class="content-widget" data-type="faq_questions" data-id="'+model.id+'" alt="Виджет вопрос-ответ" />'
            );
          }
        }
      }
    }
  };

  function loadWidget(componentName) {
    let component = window.Admin.vue.helpers.getVueComponent('faq', componentName);

    component.$data.model.id = widgetData[componentName].model.id;
  }

  editor.addButton('add_faq_widget', {
    type: 'menubutton',
    title: 'FAQ',
    icon: 'fa fa-question-circle',
    menu: [
      {
        text: 'Вопрос эксперту',
        onpostrender: function() {
          let _this = this;

          editor.on('nodechange', function(e) {
            let content = e.element.outerHTML,
                isFaq = /<img class="content-widget".+data-type="faq".+>/g.test(content);

            _this.active(isFaq);
          });
        },
        onclick: function() {
          let content = editor.selection.getContent();

          let isFaq = /<img class="content-widget".+data-type="faq".+>/g.test(content);

          if (content === '' || isFaq) {
            widgetData['FaqWidget'].model = {
              id: parseInt($(content).attr('data-id')) || 0,
            };

            window.Admin.vue.helpers.initComponent('faq', 'FaqWidget', widgetData['FaqWidget']);

            window.waitForElement('#add_faq_widget_modal', function() {
              loadWidget('FaqWidget');

              $('#add_faq_widget_modal').modal();
            });
          } else {
            swal({
              title: 'Ошибка',
              text: 'Необходимо выбрать виджет-вопрос',
              type: 'error',
            });

            return false;
          }
        }
      },
      {
        text: 'Вопрос-ответ',
        onpostrender: function() {
          let _this = this;

          editor.on('nodechange', function(e) {
            let content = e.element.outerHTML,
                isQuestions = /<img class="content-widget".+data-type="faq_questions".+>/g.test(content);

            _this.active(isQuestions);
          });
        },
        onclick: function() {
          let content = editor.selection.getContent();

          let isQuestions = /<img class="content-widget".+data-type="faq_questions".+>/g.test(content);

          if (content === '' || isQuestions) {
            widgetData['QuestionsList'].model = {
              id: parseInt($(content).attr('data-id')) || 0,
            };

            window.Admin.vue.helpers.initComponent('faq', 'QuestionsList', widgetData['QuestionsList']);

            window.waitForElement('#add_questions_widget_modal', function() {
              loadWidget('QuestionsList');

              $('#add_questions_widget_modal').modal();
            });
          } else {
            swal({
              title: 'Ошибка',
              text: 'Необходимо выбрать виджет вопрос-ответ',
              type: 'error',
            });

            return false;
          }
        }
      }
    ],
    onpostrender: function() {
      let _this = this;

      editor.on('nodechange', function(e) {
        let content = e.element.outerHTML,
            isFaq = /<img class="content-widget".+data-type="faq".+>/g.test(content),
            isQuestions = /<img class="content-widget".+data-type="faq_questions".+>/g.test(content);

        _this.active(isFaq || isQuestions);
      });
    }
  });
});
