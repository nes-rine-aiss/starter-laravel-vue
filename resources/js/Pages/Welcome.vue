<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GoodCard from '@/Components/GoodCard.vue'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Bienvenu" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen  dark:bg-gray-900 selection:bg-blue-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold bg-white px-2 text-blue-600 border-blue-600 border p-2 rounded hover:text-white duration-300 transition-all hover:bg-blue-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                >Menu principal</Link
            >

            <div v-else class="flex gap-2 border-b w-full p-4">
                <Link
                    :href="route('login')"
                    class="font-semibold bg-white px-2 text-blue-600 border-blue-600 border p-2 rounded hover:text-white duration-300 transition-all hover:bg-blue-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >S'identifier</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class=" font-semibold bg-gradient-to-r from-[#468ef9] to-[#0c66ee] px-2 text-white p-2 rounded hover:text-blue-600 hover:to-white hover:from-white  transition-all border border-transparent hover:border-blue-600 duration-300 hover:bg-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >S'inscrire</Link
                >
            </div>
        </div>
 



        <div>

          <GoodCard/>
        </div>
      
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>