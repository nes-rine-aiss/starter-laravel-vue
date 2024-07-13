<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  roles: {
    type: Object,
    default: () => ({}),
  }
})

const form = useForm({
  firstname: '',
  lastname: '',
  login: '',
  email: '',
  password: '',
  password_confirmation: '',
  roles: []
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Ajouter un utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Ajouter un utilisateur"
        main
      >
        <BaseButton
          :route-name="route('admin.user.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Retour"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('admin.user.store'))"
      >
      <FormField
          label="Nom"
          :class="{ 'text-red-400': form.errors.firstname }"
        >
          <FormControl
            v-model="form.firstname"
            type="text"
            placeholder="Entrer votre nom"
            :error="form.errors.firstname"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.firstname">
              {{ form.errors.firstname }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Prénom"
          :class="{ 'text-red-400': form.errors.lastname }"
        >
          <FormControl
            v-model="form.lastname"
            type="text"
            placeholder="Entrer votre prénom"
            :error="form.errors.lastname"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.lastname">
              {{ form.errors.lastname }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Nom d'utilisateur"
          :class="{ 'text-red-400': form.errors.login }"
        >
          <FormControl
            v-model="form.login"
            type="text"
            placeholder="Entrer votre nom d'utilisateur"
            :error="form.errors.login"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.login">
              {{ form.errors.login }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Email"
          :class="{ 'text-red-400': form.errors.email }"
        >
          <FormControl
            v-model="form.email"
            type="text"
            placeholder="Enter Email"
            :error="form.errors.email"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.email">
              {{ form.errors.email }}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="Password"
          :class="{ 'text-red-400': form.errors.password }"
        >
          <FormControl
            v-model="form.password"
            type="password"
            placeholder="Enter Password"
            :error="form.errors.password"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.password">
              {{ form.errors.password }}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="Password Confirmation"
          :class="{ 'text-red-400': form.errors.password }"
        >
          <FormControl
            v-model="form.password_confirmation"
            type="password"
            placeholder="Enter Password Confirmation"
            :error="form.errors.password"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.password">
              {{ form.errors.password }}
            </div>
          </FormControl>
        </FormField>

        <BaseDivider />

        <FormField
          label="Roles"
          wrap-body
        >
          <FormCheckRadioGroup
            v-model="form.roles"
            name="roles"
            is-column
            :options="props.roles"
          />
        </FormField>

        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Enregistrer"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
