window.tinymce.PluginManager.add('faq', function(editor) {
  let widgetData = {
    widget: {
      events: {
        widgetSaved: function(model) {
          editor.execCommand('mceReplaceContent', false,
              '<img class="content-widget" data-type="faq" data-id="' +
              model.id + '" alt="Виджет-вопрос" />',
          );
        },
      },
    },
  };

  function initFaqComponents() {
    if (typeof window.Admin.vue.modulesComponents.$refs['faq_FaqWidget'] ==
        'undefined') {
      window.Admin.vue.modulesComponents.modules.faq.components = _.union(
          window.Admin.vue.modulesComponents.modules.faq.components, [
            {
              name: 'FaqWidget',
              data: widgetData,
            },
          ]);
    } else {
      let component = window.Admin.vue.modulesComponents.$refs['faq_FaqWidget'][0];

      component.$data.model.id = widgetData.model.id;
    }
  }

  editor.addButton('add_faq_widget', {
    title: 'Вопрос эксперту',
    icon: 'fa fa-question-circle',
    onclick: function() {
      let content = editor.selection.getContent();

      let isFaq = /<img class="content-widget".+data-type="faq".+>/g.test(
          content);

      if (content === '' || isFaq) {
        widgetData.model = {
          id: parseInt($(content).attr('data-id')) || 0,
        };

        initFaqComponents();

        window.waitForElement('#add_faq_widget_modal', function() {
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
    },
  });
});
