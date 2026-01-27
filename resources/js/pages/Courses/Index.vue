<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';

defineProps<{
    courses: Array<{ id: number, title: string, description: string }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cursos',
        href: '/courses',
    },
];
</script>

<template>
    <Head title="Cursos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Lista de Cursos</h1>
                <Button as-child>
                    <Link href="/courses/create">Nuevo Curso</Link>
                </Button>
            </div>
            
            <div class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                <ul>
                    <li v-for="course in courses" :key="course.id" class="border-b border-sidebar-border/70 py-2 last:border-0 dark:border-sidebar-border">
                        <div class="font-medium">{{ course.title }}</div>
                        <div class="text-sm text-gray-500">{{ course.description }}</div>
                    </li>
                    <li v-if="courses.length === 0" class="text-gray-500">No hay cursos.</li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
