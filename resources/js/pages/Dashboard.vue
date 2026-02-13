<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

import PlaceholderPattern from '../components/PlaceholderPattern.vue';

defineProps<{
    participants: Array<{ id: number, nombres: string, apellidos: string, email: string }>;
    corporateParticipants: Array<{ id: number, razon_social: string, email: string, nombres: string, apellidos: string }>;
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
    <Head title="Dashboard Guber" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4 bg-slate-50"
        >
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                <!-- Participants -->
                <div class="rounded-xl border border-slate-200 p-6 bg-white shadow-sm">
                    <h2 class="mb-4 text-lg font-bold text-slate-900">Participantes Recientes</h2>
                    <ul class="divide-y divide-slate-100">
                        <li v-for="participant in participants" :key="participant.id" class="py-3">
                            <div class="font-medium text-slate-900">{{ participant.nombres }} {{ participant.apellidos }}</div>
                            <div class="text-sm text-slate-500">{{ participant.email }}</div>
                        </li>
                        <li v-if="participants.length === 0" class="py-3 text-slate-500 italic">No se encontraron participantes.</li>
                    </ul>
                </div>

                <!-- Corporate Participants -->
                <div class="rounded-xl border border-slate-200 p-6 bg-white shadow-sm">
                    <h2 class="mb-4 text-lg font-bold text-slate-900">Corporativos Recientes</h2>
                    <ul class="divide-y divide-slate-100">
                        <li v-for="cp in corporateParticipants" :key="cp.id" class="py-3">
                            <div class="font-bold text-slate-900">{{ cp.razon_social }}</div>
                            <div class="text-sm text-slate-700">{{ cp.nombres }} {{ cp.apellidos }}</div>
                            <div class="text-sm text-slate-500">{{ cp.email }}</div>
                        </li>
                        <li v-if="corporateParticipants.length === 0" class="py-3 text-slate-500 italic">No se encontraron participantes corporativos.</li>
                    </ul>
                </div>

                <!-- Photos -->
                <div class="rounded-xl border border-slate-200 p-6 bg-white shadow-sm">
                    <h2 class="mb-4 text-lg font-bold text-slate-900">Fotos</h2>
                    <div v-if="photos.length > 0" class="grid grid-cols-2 gap-3">
                         <div v-for="photo in photos" :key="photo.id" class="relative aspect-video overflow-hidden rounded-lg border border-slate-100 bg-slate-50">
                             <div class="flex h-full items-center justify-center p-2 text-center text-xs text-slate-400 font-medium">
                                 {{ photo.title }}
                             </div>
                        </div>
                    </div>
                    <div v-else class="text-slate-500 italic py-2">No se encontraron fotos.</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
