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
  user: {
    type: Object,
    default: () => ({}),
  },
  roles: {
    type: Object,
    default: () => ({}),
  },
  userHasRoles: {
    type: Object,
    default: () => ({}),
  }
})

const form = useForm({
  _method: 'put',
  firstname:props.user.firstname,
  lastname: props.user.lastname,
  login: props.user.login,

  email: props.user.email,
  // password: '',
  // password_confirmation: '',
  roles: props.userHasRoles
})
const formUpdatePassword = useForm({
  _method: 'put',
 
  password: '',
  password_confirmation: '',

})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Modifier un utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Modifier un utilisateur"
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
        @submit.prevent="form.post(route('admin.user.update', props.user.id))"
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
          label="Enter Email"
          :class="{ 'text-red-400': form.errors.email }"
        >
          <FormControl
            v-model="form.email"
            type="text"
            placeholder="Email"
            :error="form.errors.email"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.email">
              {{ form.errors.email }}
            </div>
          </FormControl>
        </FormField>

        <!-- <FormField
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
        </FormField> -->

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
       <CardBox
      title="Réinitialiser le mot de passe"
          :icon="mdiLock"
          :bg_headder="'bg-[#ff9100]/10  rounded-lg text-[#ff9100]'"
        form
        @submit.prevent="formUpdatePassword.post(route('change.password', props.user.id))"
      >
     
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 ">
        <FormField required
          :label="'Mot de passe'"
          :class="{ 'text-red-400': formUpdatePassword.errors.password }"
        >

          <FormControl
          :showPass="showPass"
 :show="show"
 :type="show ? 'text' : 'text'"  
 :password="true" 
            v-model="formUpdatePassword.password"
            type="password"
            :placeholder="'Tapez un mot de passe'"
            :error="formUpdatePassword.errors.password"
          >
            <div class="text-[#ff0000] text-sm" v-if="formUpdatePassword.errors.password">
              {{ formUpdatePassword.errors.password }}
            </div>
          </FormControl>
        </FormField>

        <FormField required
     
          :label="'Confirmation du mot de passe'"
          :class="{ 'text-[#ff0000]': form.errors.password_confirmation }"
        >
          <FormControl
   
            v-model="formUpdatePassword.password_confirmation"
            :placeholder="'Veullez confirmer votre mote de passe'"
            :type="show ? 'text' : 'text'"    
            :icon="mdiAsterisk"
            :error="formUpdatePassword.errors.password_confirmation"
            :showPass="showPass"
           :show="show"
          >
            <div class="text-[#ff0000] text-sm" v-if="formUpdatePassword.errors.password_confirmation">
              {{ formUpdatePassword.errors.password_confirmation }}
            </div>
          </FormControl>
        </FormField>
      </div>
     
        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="main_btn"
                            :label="'Enregistrer'"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
