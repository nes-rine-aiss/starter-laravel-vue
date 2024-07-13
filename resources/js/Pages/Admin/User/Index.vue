<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiSquareEditOutline,
  mdiTrashCan,
  mdiAlertBoxOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Sort from "@/Components/Admin/Sort.vue"
import { useDestroy, useStatusChange } from "@/Utils/api"

const props = defineProps({
  users: {
    type: Object,
    default: () => ({}),
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  search: props.filters.search,
})

const formDelete = useForm({})

// function destroy(id) {
//   if (confirm("Are you sure you want to delete?")) {
//     formDelete.delete(route("admin.user.destroy", id))
//   }
// }
const { destroy } = useDestroy();
const { changeStatus } = useStatusChange();

</script>

<template>
  <LayoutAuthenticated>
    <Head title="Utilisateurs" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Liste des utilisateurs"
        main
      >
        <BaseButton
          v-if="can.delete"
          :route-name="route('admin.user.create')"
          :icon="mdiPlus"
          label="Ajouter"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar
        :key="Date.now()"
        v-if="$page.props.flash.message"
        color="success"
        :icon="mdiAlertBoxOutline"
      >
        {{ $page.props.flash.message }}
      </NotificationBar>
      <CardBox class="mb-6" has-table>
        <form @submit.prevent="form.get(route('admin.user.index'))">
          <div class="py-2 flex">
            <div class="flex pl-4">
              <input
                type="search"
                v-model="form.search"
                class="
                  rounded-md
                  shadow-sm
                  border-gray-300
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                "
                placeholder="Rechercher"
              />
              <BaseButton
                label="Rechercher"
                type="submit"
                color="info"
                class="ml-4 inline-flex items-center px-4 py-2"
              />
            </div>
          </div>
        </form>
      </CardBox>
      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="Nom" attribute="firstname" />
              </th>
              <th>
                <Sort label="Prénom" attribute="lastname" />
              </th>
       
              <th>
                <Sort label="Email" attribute="email" />
              </th>
              <th>
                <Sort label="Status" attribute="active" />
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="user in users.data" :key="user.id">
              <td data-label="Nom">
                <Link
                  :href="route('admin.user.show', user.id)"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                >
                  {{ user.firstname }}
                </Link>
              </td>
              <td data-label="Prénom">
                <Link
                  :href="route('admin.user.show', user.id)"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                >
                  {{ user.lastname }}
                </Link>
              </td>
              <td data-label="Email">
                {{ user.email }}
              </td>
              <td data-label="Status">
              
                <span v-if="user.active==1" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Activé</span>
                <span v-if="user.active==0" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Désactivé</span>


              </td>
              <td
                v-if="can.edit || can.delete"
                class="before:hidden lg:w-1 whitespace-nowrap"
              >
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <button
          v-if="can.edit && user.active == 1"
          @click="changeStatus( route('admin.user.change.status', ':id'),user.id,user.firstname)"
          class="flex items-center justify-center  rounded-lg p-2"
        >
          <svg
            class="h-6 w-6 text-gray-800"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 4h2v16H6V4zm10 0h2v16h-2V4z"
            />
          </svg>
        </button>

        <button
          v-if="can.edit && user.active == 0"
          @click="changeStatus( route('admin.user.change.status', ':id'),user.id,user.firstname)"
          class="flex items-center justify-center p-2 rounded-lg focus:outline-none "
        >
          <svg
            class="h-6 w-6 text-green-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M8 5v14l11-7z"
            />
          </svg>
        </button>
                  <BaseButton
                    v-if="can.edit"
                    :route-name="route('admin.user.edit', user.id)"
                    color="info"
                    :icon="mdiSquareEditOutline"
                    small
                  />
                  <BaseButton
                    v-if="can.delete"
                    color="danger"
                    :icon="mdiTrashCan"
                    small
                    
                    @click="
                            destroy(
                                route('admin.user.destroy', ':id'),
                                user.id,
                                user.firstname,
                            )
                        "
                   
                  />
                </BaseButtons>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="users" />
        </div>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
