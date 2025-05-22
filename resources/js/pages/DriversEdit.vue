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
        title: 'Edit Drivers',
        href: '/drivers/edit',
    },
];

interface props {
    countries: any;
    driver: any;
}

const props = defineProps<props>();


const form = useForm({
    name: props.driver.name,
    email:  props.driver.email,
    mobile: props.driver.mobile,
    address: props.driver.address,
    city: props.driver.city,
    state: props.driver.state,
    country_id: props.driver.country_id,
    zip:    props.driver.zip,
    is_own_vechile: props.driver.is_own_vechile,
    vechile_type: props.driver.vechile_type,
    vechile_number: props.driver.vechile_number,
    vechile_color: props.driver.vechile_color,
    vechile_model: props.driver.vechile_model,
    vechile_capacity: props.driver.vechile_capacity,
    status: props.driver.status,
    is_active: props.driver.is_active
});



const update = () => {
    form.patch(route('drivers.update', props.driver.id), {
        onFinish: () => form.reset('name', 'email', 'mobile', 'address', 'city', 'state', 'country_id', 'zip', 'is_own_vechile', 'vechile_type', 'vechile_number', 'vechile_color', 'vechile_model', 'vechile_capacity', 'status', 'is_active'),
    });
};


// interface driver_props {
//     driver: any;
// }

// const driver_props = defineProps<driver_props>();

// const countries = countries();
console.log(props.driver);

</script>



<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Drivers" />
        <div class="md:px-4 sm:px-1 h-full">
            <div class="flex justify-end">
                <div class="my-3 md:mx-4">
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
            <div class="flex h-full bg-slate-10 justify-start items-center flex-col rounded-xl md:p-4 sm:p-1">
                <div class="w-full p-5">
                    <form @submit.prevent="update" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                <div class="grid gap-2">
                                    <Label for="name">Name</Label>
                                    <Input id="name" type="text" autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="is_active">IS ACTIVE</Label>
                                    <select id="is_active" type="text" :tabindex="2" autocomplete="is_active" v-model="form.is_active" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive">
                                        <option :value="1" selected >Active</option>
                                        <option :value="0" >In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                <div class="grid gap-2">
                                    <Label for="email">Email address</Label>
                                    <Input id="email" type="email" :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                                    <InputError :message="form.errors.email" />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="mobile">Mobile number</Label>
                                    <Input id="mobile" type="text" :tabindex="2" autocomplete="mobile" v-model="form.mobile" placeholder="00000000000"  />
                                    <InputError :message="form.errors.mobile" />
                                </div>
                            </div>

                            <div class="grid gap-2">
                                <Label for="address">Address</Label>
                                <Input id="address" type="text" :tabindex="2" autocomplete="address" v-model="form.address" placeholder="Address"  />
                                <InputError :message="form.errors.address" />
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                 <div class="grid gap-2">
                                    <Label for="city">City</Label>
                                    <Input id="city" type="text" :tabindex="2" autocomplete="city" v-model="form.city" placeholder="city"  />
                                    <InputError :message="form.errors.city" />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="state">State</Label>
                                    <Input id="state" type="text" :tabindex="2" autocomplete="state" v-model="form.state" placeholder="state"  />
                                    <InputError :message="form.errors.state" />
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                <div class="grid gap-2">
                                    <Label for="country_id">Country</Label>
                                    <select id="country_id" type="text" :tabindex="2" autocomplete="country_id" v-model="form.country_id" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive" >
                                        <option value="">Select Country</option>
                                        <option v-for="country in countries" :key="country.id" :value="country.id" >{{ country.name }}</option>

                                    </select>

                                </div>
                                <div class="grid gap-2">
                                    <Label for="zip">Zip Code</Label>
                                    <Input id="zip" type="text" :tabindex="2" autocomplete="zip" v-model="form.zip" placeholder="zip"  />
                                    <InputError :message="form.errors.zip" />
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 sm:grid-cols-1">
                                <div class="grid gap-2">
                                    <Label for="is_own_vechile">Is Own Cab</Label>
                                    <select id="is_own_vechile" type="text" :tabindex="2" autocomplete="is_own_vechile" v-model="form.is_own_vechile" placeholder="is_own_vechile" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive">
                                        <option :value="1" selected>Own</option>
                                        <option :value="0">Other</option>
                                    </select>


                                </div>

                                <div class="grid gap-2">
                                    <Label for="vechile_type">Cab Type</Label>
                                    <Input id="vechile_type" type="text" :tabindex="2" autocomplete="vechile_type" v-model="form.vechile_type" placeholder="vechile_type"  />
                                    <InputError :message="form.errors.vechile_type" />
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-1 gap-4 md:grid-cols-4">
                                 <div class="grid gap-2 w-sm-full">
                                    <Label for="vechile_number">Cab Number</Label>
                                    <Input id="vechile_number" type="text" :tabindex="2" autocomplete="vechile_number" v-model="form.vechile_number" placeholder="vechile_number"  />
                                    <InputError :message="form.errors.vechile_number" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="vechile_color">Cab Color</Label>
                                    <Input id="vechile_color" type="text" :tabindex="2" autocomplete="vechile_color" v-model="form.vechile_color" placeholder="vechile_color"  />
                                    <InputError :message="form.errors.vechile_color" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="vechile_model">Cab model</Label>
                                    <Input id="vechile_model" type="text" :tabindex="2" autocomplete="vechile_model" v-model="form.vechile_model" placeholder="vechile_model"  />
                                    <InputError :message="form.errors.vechile_model" />
                                </div>
                                <div class="grid gap-4 w-sm-full">
                                    <Label for="vechile_capacity">Cab capacity</Label>
                                    <Input id="vechile_capacity" type="number" :tabindex="2" autocomplete="vechile_capacity" v-model="form.vechile_capacity" placeholder="vechile_capacity"  />
                                    <InputError :message="form.errors.vechile_capacity" />
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
