<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

import PlaceholderPattern from '../components/PlaceholderPattern.vue';

defineProps<{
    participants: Array<{ id: number, nombres: string, apellidos: string, email: string }>;
    corporateParticipants: Array<{ id: number, razon_social: string, email: string, nombres: string, apellidos: string }>;
    courses: Array<{ id: number, title: string, description: string }>;
    photos: Array<{ id: number, title: string, path: string }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                <!-- Participants -->
                <div class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h2 class="mb-4 text-lg font-bold">Participantes Recientes</h2>
                    <ul>
                        <li v-for="participant in participants" :key="participant.id" class="border-b border-sidebar-border/70 py-2 last:border-0 dark:border-sidebar-border">
                            {{ participant.nombres }} {{ participant.apellidos }} <span class="text-sm text-gray-500">({{ participant.email }})</span>
                        </li>
                        <li v-if="participants.length === 0" class="text-gray-500">No participantes encontrados.</li>
                    </ul>
                </div>

                <!-- Corporate Participants -->
                <div class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h2 class="mb-4 text-lg font-bold">Corporativos Recientes</h2>
                    <ul>
                        <li v-for="cp in corporateParticipants" :key="cp.id" class="border-b border-sidebar-border/70 py-2 last:border-0 dark:border-sidebar-border">
                            <span class="font-bold">{{ cp.razon_social }}</span> - {{ cp.nombres }} {{ cp.apellidos }} 
                            <div class="text-sm text-gray-500">{{ cp.email }}</div>
                        </li>
                        <li v-if="corporateParticipants.length === 0" class="text-gray-500">No participantes corporativos encontrados.</li>
                    </ul>
                </div>

                <!-- Courses -->
                <div class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h2 class="mb-4 text-lg font-bold">Cursos</h2>
                    <ul>
                        <li v-for="course in courses" :key="course.id" class="border-b border-sidebar-border/70 py-2 last:border-0 dark:border-sidebar-border">
                            <div class="font-medium">{{ course.title }}</div>
                            <div class="text-sm text-gray-500">{{ course.description }}</div>
                        </li>
                        <li v-if="courses.length === 0" class="text-gray-500">No cursos encontrados.</li>
                    </ul>
                </div>

                <!-- Photos -->
                <div class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h2 class="mb-4 text-lg font-bold">Fotos</h2>
                    <div v-if="photos.length > 0" class="grid grid-cols-2 gap-2">
                         <div v-for="photo in photos" :key="photo.id" class="relative aspect-video overflow-hidden rounded-md border border-sidebar-border/70 dark:border-sidebar-border">
                            <!-- Placeholder for image since we don't have real storage setup yet -->
                             <div class="flex h-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                 {{ photo.title }}
                             </div>
                        </div>
                    </div>
                    <div v-else class="text-gray-500">No fotos encontradas.</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
