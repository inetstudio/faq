<template>
    <tr class="question-tr">
        <td class="question-title">
            <span>{{ question.model.title }}</span>
        </td>
        <td width="10%">
            <div class="btn-nowrap">
                <a href="#" class="btn btn-xs btn-default edit-question m-r-xs" v-on:click.prevent.stop="edit"><i class="fa fa-pencil-alt"></i></a>
                <a href="#" class="btn btn-xs btn-danger delete-question" v-on:click.prevent.stop="remove"><i class="fa fa-times"></i></a>
            </div>
        </td>
    </tr>
</template>

<script>
  export default {
    name: 'QuestionsListItem',
    props: {
      question: {
        type: Object,
        required: true
      }
    },
    methods: {
      initAdditionalComponents() {
        if (typeof window.Admin.vue.modulesComponents.$refs['faq_QuestionsListItemForm'] == 'undefined') {
          window.Admin.vue.modulesComponents.modules.faq.components = _.union(
              window.Admin.vue.modulesComponents.modules.faq.components,
              [
                {
                  name: 'QuestionsListItemForm',
                  data: {}
                }
              ]
          );
        }
      },
      edit() {
        this.initAdditionalComponents();

        window.Admin.vue.stores['faq_questions'].commit('setMode', 'edit_list_item');

        let question = JSON.parse(JSON.stringify(this.question));
        question.isModified = false;

        window.Admin.vue.stores['faq_questions'].commit('setQuestion', question);

        window.waitForElement('#questions_list_item_form_modal', function() {
          $('#questions_list_item_form_modal').modal();
        });
      },
      remove() {
        this.$emit('remove', {
          id: this.question.model.id,
        });
      },
    },
  };
</script>
