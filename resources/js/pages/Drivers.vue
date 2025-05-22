<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Drivers',
        href: '/drivers',
    },
];

interface Props {
    drivers: any;
}

const props = defineProps<Props>();

interface MultiToggle {
    id: number;
    show: boolean;
}

const dropdownOpen = ref(<MultiToggle>{
    id: -1,
    show: false
});

function toggleDropdown(driverid : number) {

        dropdownOpen.value.id = driverid;
        dropdownOpen.value.show = !dropdownOpen.value.show;
        return;

}



</script>



<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Drivers" />
        <div class="px-4 h-full">
            <div class="flex justify-end">
                <div class="my-3 mx-4">
                    <ul class="relative flex flex-wrap px-1.5 py-1.5 list-none " role="list">
                        <li class="z-30 flex-auto text-center rounded-md bg-slate-100 ">
                            <Link class="active z-30 flex items-center justify-center w-full p-2 text-sm mb-0 transition-all ease-in-out border-0 rounded-md cursor-pointer text-slate-600 bg-inherit hover:bg-slate-500 hover:text-white"
                            :href="route('drivers.create')" aria-selected="true">
                            Add new
                            </Link>
                        </li>
                        <li class="z-30 flex-auto text-center rounded-md bg-slate-100 mx-1">
                            <Link class="z-30 flex items-center justify-center w-full p-2 mb-0 text-sm transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-600 bg-inherit hover:bg-slate-500 hover:text-white"
                            :href="route('drivers.index')" aria-selected="false">
                            Lists
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mb-4">
            <div class="flex h-full bg-slate-10 justify-start items-center flex-col rounded-xl p-4">
                <div class="w-full p-5">
                    <table v-if="props.drivers.length > 0" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Mobile</th>
                                <th scope="col" class="px-6 py-3">State</th>
                                <th scope="col" class="px-6 py-3">Country</th>
                                <th scope="col" class="px-6 py-3">Zip code</th>
                                <th scope="col" class="px-6 py-3">Own Vehicle</th>
                                <th scope="col" class="px-6 py-3">Vehicle Number</th>
                                <th scope="col" class="px-6 py-3">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="driver in props.drivers" :key="driver.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ driver.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.mobile }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.state }}
                                </td>
                                <td class="px-6 py-4">
                                    {{  driver.country && driver.country.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.zip }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.is_own_vechile ? 'Yes' : 'No' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ driver.vechile_number }}
                                </td>
                                <td class="px-6 py-4">

                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button" @click="toggleDropdown(driver.id)" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-black rounded-md shadow-sm hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 cursor-pointer" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                Options
                                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </div>

                                        <div v-if="dropdownOpen.id === driver.id && dropdownOpen.show" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="menu_items-{{ driver.id }}">
                                            <div class="py-1" role="none">
                                                <Link :href="route('drivers.edit', driver.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" tabindex="-1" id="menu-item-0">Edit</Link>
                                                <Link :href="route('drivers.destroy', driver.id)" method="delete" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" tabindex="-1" id="menu-item-1">Delete</Link>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <Link :href="route('drivers.edit', driver.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link> -->
                                </td>
                            </tr>

                        </tbody>
                    </table>
                     <div v-else="props.drivers.length === 0" class="mt-6 flex justify-center">No drivers found</div>

                    <div v-if="props.drivers.length > 0" class="mt-4">
                        <Pagination :links="props.drivers.links" />
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
