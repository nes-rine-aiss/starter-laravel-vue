<script setup>
import { useForm, usePage, Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import { mdiAccount, mdiEmail, mdiFormTextboxPassword, mdiLogin, mdiNotEqual } from '@mdi/js'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import FormValidationErrors from '@/Components/FormValidationErrors.vue'

const form = useForm({
  firstname: '',
  lastname: '',

  login: '',

  email: '',
  password: '',
  password_confirmation: '',
  terms: [],
})

const hasTermsAndPrivacyPolicyFeature = computed(() => usePage().props.value?.jetstream?.hasTermsAndPrivacyPolicyFeature )

const submit = () => {
  form
    .transform(data => ({
      ... data,
      terms: form.terms && form.terms.length
    }))
    .post(route('register'), {
      onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
  <LayoutGuest>
    <Head title="Inscription" />

    <SectionFullScreen
      v-slot="{ cardClass }"
      bg="purplePink"
    >
      <CardBox
        :class="cardClass"
        class="my-24"
        form
        @submit.prevent="submit"
      >
      <div className="mb-4 border-b ">
        <h1 className="text-4xl font-normal pb-2">Créer votre compte</h1>
      </div>
        <FormValidationErrors />
        <div class="grid grid-cols-2 gap-2 w-full" >
        <FormField required
          label="Nom"
          label-for="firstname"
          help="Entrer votre firstname"
        >
          <FormControl
            v-model="form.firstname"
            id="name"
            :icon="mdiAccount"
            autocomplete="firstname"
            type="text"
            required
          />
        </FormField>     
        <FormField required
          label="Prénom"
          label-for="lastname"
          help="Entrer votre lastname"
        >
          <FormControl
            v-model="form.lastname"
            id="lastname"
            :icon="mdiAccount"
            autocomplete="lastname"
            type="text"
            required
          />  
        </FormField></div>
        <FormField required
        label="Login"
        label-for="login"
        help="Veuillez entrer votre login"
        >
        <FormControl
        v-model="form.login"
        id="login"
        :icon="mdiAccount"
        autocomplete="text"
        type="text"
        required
        />
      </FormField>
        <FormField required
        label="Adresse mail"
        label-for="email"
        help="Veuillez entrer votre adresse mail"
        >
        <FormControl
        v-model="form.email"
        id="email"
        :icon="mdiEmail"
        autocomplete="email"
        type="email"
        required
        />
      </FormField>
      
      <div class="grid grid-cols-2 gap-2 w-full" >
        <FormField required
        label="Mot de passe"
          label-for="password"
          help="Veuillez entrer votre mot de passe"
        >
          <FormControl
            v-model="form.password"
            id="password"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>

        <FormField required
        label="Confirmer mot de passe"
          label-for="password"
          help="Veuillez confirmer votre mot de passe"
        >
          <FormControl
            v-model="form.password_confirmation"
            id="password_confirmation"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>
      </div>
        <FormCheckRadioGroup
          v-if="hasTermsAndPrivacyPolicyFeature"
          v-model="form.terms"
          name="remember"
          :options="{ agree: 'I agree to the Terms' }"
        />

        <BaseDivider />

        <BaseButtons>
          <BaseButton
            type="submit"
            color="info"
            label="Inscrire"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          />
          <BaseButton
            :route-name="route('login')"
            color="info"
            outline
            label="S'identifier"
          />
        </BaseButtons>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
