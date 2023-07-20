<template>
  <div class="form-group row padding-x-15">
    <button
        class="btn mt-2"
        @click.prevent="onClick"
        :disabled="isDisabled"
    >
      <template v-if="isLoading">
        <i class="fa fa-refresh fa-spin"></i>
      </template>
      <template v-else>
        Compare
      </template>
    </button>
  </div>
</template>

<script>
export default {
  name: "CompareButton",
  props: {
    isLoading: {
      type: Boolean,
      required: true
    },
    onClick: {
      type: Function,
      required: true
    },
    isDisabled: {
      type: Boolean,
      required: true
    }
  }
};
</script>
