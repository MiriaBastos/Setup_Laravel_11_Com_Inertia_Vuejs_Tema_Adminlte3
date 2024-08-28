<template>
    <Teleport to="body">
      <div class="modal fade" :class="{ 'show': show }" @click="close">
        <div class="modal-dialog" :class="maxWidthClass" @click.stop>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ title }}</h5>
              <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
            </div>
            <div class="modal-body">
              <slot v-if="show" />
            </div>
          </div>
        </div>
      </div>
    </Teleport>
  </template>

  <script setup>
  import { defineProps, defineEmits, computed } from 'vue';

  const props = defineProps({
    show: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      required: true,
    },
    maxWidth: {
      type: String,
      default: 'lg',
    },
  });

  const emit = defineEmits(['close']);

  const close = () => {
    emit('close');
  };

  const maxWidthClass = computed(() => {
    return {
      sm: 'modal-sm',
      md: '', // default AdminLTE size
      lg: 'modal-lg',
      xl: 'modal-xl',
      '2xl': 'modal-xxl',
    }[props.maxWidth];
  });
  </script>

  <style scoped>
  /* CSS específico para a modal AdminLTE 3 */
  .modal {
    display: none !important;
    background: rgba(0, 0, 0, 0.5);
  }

  .modal.show {
    display: block !important;
  }

  .modal-dialog {
    margin: 50px auto;
    animation: modal-slide-up 0.6s ease;
  }

  .modal-content {
    border-radius: 0.25rem;
    animation: fade-in 0.3s ease;
  }

  .modal-header {
    background-color: #3D3D3D;
    color: #fff;
  }

  .modal-title {
    margin-bottom: 0;
  }

  .modal-body {
    padding: 15px;
  }

  @keyframes modal-slide-up {
    from {
      transform: translate3d(0, 100%, 0);
    }
    to {
      transform: translate3d(0, 0, 0);
    }
  }

  @keyframes fade-in {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @media (max-width: 767px) {
    .modal-dialog {
      margin: 30px 10px;
    }
  }
  </style>
