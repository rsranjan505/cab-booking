<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Bookings',
        href: '/bookings',
    },
];


interface Props {
    bookings: any;
}

const props = defineProps<Props>();


console.log(props.bookings);

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
        <Head title="Bookings" />
        <div class="px-4 h-full">
            <div class="flex justify-end">
                <div class="my-3">
                    <ul class="relative flex flex-wrap px-1.5 py-1.5 list-none " data-tabs="tabs" role="list">
                        <li class="z-30 flex-auto text-center rounded-md bg-slate-100 ">
                            <Link
                            :href="route('bookings.create')" class="active z-30 flex items-center justify-center w-full p-2 text-sm mb-0 transition-all ease-in-out border-0 rounded-md cursor-pointer text-slate-600 bg-inherit hover:bg-slate-500 hover:text-white">
                            Add new
                            </Link>
                        </li>
                        <li class="z-30 flex-auto text-center rounded-md bg-slate-100 mx-1">
                            <Link class="z-30 flex items-center justify-center w-full p-2 mb-0 text-sm transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-600 bg-inherit hover:bg-slate-500 hover:text-white"
                            :href="route('bookings.index')" >
                            Lists
                            </Link>
                        </li>

                    </ul>
                </div>
            </div>
            <hr class="mb-4">
            <div class="flex h-full bg-slate-10 justify-start items-center flex-col rounded-xl p-4">
                <div class="w-full p-5">
                    <table v-if="props.bookings.length > 0" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Customer Name</th>
                                <th scope="col" class="px-6 py-3">Mobile</th>
                                <th scope="col" class="px-6 py-3">Driver Name</th>
                                <th scope="col" class="px-6 py-3">Booking From</th>
                                <th scope="col" class="px-6 py-3">Booking To</th>

                                <th scope="col" class="px-6 py-3">Booking Date</th>
                                <th scope="col" class="px-6 py-3">Booking Time</th>
                                <th scope="col" class="px-6 py-3">Vehicle Number</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="booking in props.bookings" :key="booking.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ booking.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.mobile }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.driver && booking.driver.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.booking_from }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.booking_to }}
                                </td>
                                <td class="px-6 py-4">
                                    {{  booking.booking_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.booking_time }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.vechile_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ booking.email }}
                                </td>
                                <td class="px-6 py-4">

                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button" @click="toggleDropdown(booking.id)" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-black rounded-md shadow-sm hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 cursor-pointer" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                Options
                                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </div>

                                        <div v-if="dropdownOpen.id === booking.id && dropdownOpen.show" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="menu_items-{{ booking.id }}">
                                            <div class="py-1" role="none">
                                                <Link :href="route('bookings.edit', booking.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" tabindex="-1" id="menu-item-0">Edit</Link>
                                                <Link :href="route('bookings.destroy', booking.id)" method="delete" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" tabindex="-1" id="menu-item-1">Delete</Link>
                                            </div>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else="!props.bookings.data.length" class="mt-6 flex justify-center">No bookings found</div>

                    <div class="flex justify-center mt-4">
                        <Pagination :links="props.bookings.links" />
                    </div>
                </div>

            </div>
        </div>

    </AppLayout>
</template>
