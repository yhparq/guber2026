<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { type BreadcrumbItem } from '@/types';

const form = useForm({
    title: '',
    path: '',
});

const submit = () => {
    form.post('/photos');
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Fotos',
        href: '/photos',
    },
    {
        title: 'Nueva Foto',
        href: '/photos/create',
    },
];
</script>

<template>
    <Head title="Nueva Foto" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Subir Nueva Foto</h1>
            
            <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                
                <div class="space-y-2">
                    <Label for="title">Título</Label>
                    <Input id="title" v-model="form.title" required />
                    <InputError :message="form.errors.title" />
                </div>

                <div class="space-y-2">
                    <Label for="path">Ruta / URL de la Imagen</Label>
                    <Input id="path" v-model="form.path" required placeholder="https://..." />
                    <InputError :message="form.errors.path" />
                </div>

                <div class="flex justify-end">
                    <Button type="submit" :disabled="form.processing">
                        Guardar Foto
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
