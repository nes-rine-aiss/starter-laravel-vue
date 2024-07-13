<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3'
import { mdiEmail, mdiFormTextboxPassword } from '@mdi/js'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import FormValidationErrors from '@/Components/FormValidationErrors.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  email: {
    type: String,
    default: null
  },
  token: {
    type: String,
    default: null
  }
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form
    .post(route('password.store'), {
      onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
  <LayoutGuest>
    <Head title="Reset Password" />

    <SectionFullScreen
      v-slot="{ cardClass }"
      bg="purplePink"
      class="h-screen"
    >
      <CardBox
        :class="cardClass"
        form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <FormField
          label="Email"
          label-for="email"
          help="Entrer votre email"
        >
          <FormControl
            v-model="form.email"
            :icon="mdiEmail"
            autocomplete="email"
            type="email"
            id="email"
            required
          />
        </FormField>

        <FormField
          label="Mot de passe"
          label-for="password"
          help="Entrer votre nouveau mot de passe"
        >
          <FormControl
            v-model="form.password"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            id="password"
            required
          />
        </FormField>

        <FormField
          label="Confirmer votre mot de passe"
          label-for="password_confirmation"
          help="Confirmer votre nouveau mot de passe"
        >
          <FormControl
            v-model="form.password_confirmation"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            id="password_confirmation"
            required
          />
        </FormField>

        <BaseDivider />

      <BaseButtons>
        <BaseButton
          type="submit"
          color="info"
          label="Rénitialiser mot de passe"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        />
      </BaseButtons>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
