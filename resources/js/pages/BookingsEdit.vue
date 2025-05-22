<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Bookings Edit',
        href: '/bookings',
    },
];

interface props {
    drivers: any
    booking: any
}

const props = defineProps<props>();

const form = useForm({
    name: props.booking.name,
    email: props.booking.email,
    mobile: props.booking.mobile,
    driver_id: props.booking.driver_id,
    booking_from: props.booking.booking_from,
    booking_to: props.booking.booking_to,
    booking_date: props.booking.booking_date,
    booking_time: props.booking.booking_time,
    booking_charge: props.booking.booking_charge,

});

const update = () => {
    form.patch(route('bookings.update'), {
        onFinish: () => form.reset('name', 'email', 'mobile', 'driver_id', 'booking_from', 'booking_to', 'booking_date', 'booking_time', 'booking_charge'),
    });
};

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
            <div class="flex h-full bg-slate-10 justify-start items-center flex-col rounded-xl md:p-4 sm:p-1">
                <div class="w-full p-5">
                    <form @submit.prevent="update" class="flex flex-col gap-6">
                        <div class="grid gap-6">

                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">

                                <div class="grid gap-2">
                                    <Label for="name">Name</Label>
                                    <Input id="name" type="text" autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" :value="form.name" />
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="mobile">Mobile number</Label>
                                    <Input id="mobile" type="text" :tabindex="2" autocomplete="mobile" v-model="form.mobile" placeholder="00000000000" />
                                    <InputError :message="form.errors.mobile" />
                                </div>
                            </div>


                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                <div class="grid gap-2">
                                    <Label for="driver_id">driver_id</Label>
                                    <select id="driver_id" type="text" :tabindex="2" autocomplete="driver_id" v-model="form.driver_id" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive" >
                                        <option value="">Select Driver</option>
                                        <option v-for="driver in props.drivers" :key="driver.id" :value="driver.id">{{ driver.name }}</option>

                                    </select>

                                    <InputError :message="form.errors.driver_id" />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="email">Email address</Label>
                                    <Input id="email" type="email" :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                                    <InputError :message="form.errors.email" />
                                </div>

                            </div>

                            <div class="grid sm:grid-cols-1 gap-4 md:grid-cols-4">
                                 <div class="grid gap-2 w-sm-full">
                                    <Label for="booking_from">Booking From</Label>
                                    <Input id="booking_from" type="text" :tabindex="2" autocomplete="booking_from" v-model="form.booking_from" placeholder="booking_from" />
                                    <InputError :message="form.errors.booking_from" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="booking_to">Booking To</Label>
                                    <Input id="booking_to" type="text" :tabindex="2" autocomplete="booking_to" v-model="form.booking_to" placeholder="booking_to" />
                                    <InputError :message="form.errors.booking_to" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="booking_date">Booking date</Label>
                                    <Input id="booking_date" type="date" :tabindex="2" autocomplete="booking_date" v-model="form.booking_date" placeholder="booking_date" />
                                    <InputError :message="form.errors.booking_date" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="booking_time">Booking time</Label>
                                    <Input id="booking_time" type="time" :tabindex="2" autocomplete="booking_time" v-model="form.booking_time" placeholder="booking_time" />
                                    <InputError :message="form.errors.booking_time" />
                                </div>
                            </div>




                            <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Save driver
                            </Button>
                        </div>


                    </form>
                </div>

            </div>
        </div>

    </AppLayout>
</template>
