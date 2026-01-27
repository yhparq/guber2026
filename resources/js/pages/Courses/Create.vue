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
    description: '',
});

const submit = () => {
    form.post('/courses');
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cursos',
        href: '/courses',
    },
    {
        title: 'Nuevo Curso',
        href: '/courses/create',
    },
];
</script>

<template>
    <Head title="Nuevo Curso" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Crear Nuevo Curso</h1>
            
            <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                
                <div class="space-y-2">
                    <Label for="title">Título del Curso</Label>
                    <Input id="title" v-model="form.title" required />
                    <InputError :message="form.errors.title" />
                </div>

                <div class="space-y-2">
                    <Label for="description">Descripción</Label>
                    <textarea id="description" v-model="form.description" class="flex min-h-[80px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm dark:border-sidebar-border dark:text-white" rows="4"></textarea>
                    <InputError :message="form.errors.description" />
                </div>

                <div class="flex justify-end">
                    <Button type="submit" :disabled="form.processing">
                        Guardar Curso
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
