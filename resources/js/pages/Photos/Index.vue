<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';

defineProps<{
    photos: Array<{ id: number, title: string, path: string }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Fotos',
        href: '/photos',
    },
];
</script>

<template>
    <Head title="Fotos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Galería de Fotos</h1>
                <Button as-child>
                    <Link href="/photos/create">Subir Foto</Link>
                </Button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div v-for="photo in photos" :key="photo.id" class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                     <div class="flex h-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                         {{ photo.title }}
                     </div>
                </div>
            </div>
            <div v-if="photos.length === 0" class="text-gray-500">No hay fotos.</div>
        </div>
    </AppLayout>
</template>
