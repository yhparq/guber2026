<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import {
    Calendar,
    Clock,
    Edit,
    FileText,
    Trash2,
    Video,
} from 'lucide-vue-next';

import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    ponencias: Array<{
        id: number;
        titulo: string;
        ponente: string;
        descripcion: string | null;
        hora_inicio: string;
        hora_fin: string;
        dia: number;
        link_video: string | null;
        link_material: string | null;
    }>;
}>();

const deletePonencia = (id: number) => {
    if (confirm('¿Estás seguro de que deseas eliminar esta ponencia?')) {
        router.delete(`/ponencias/${id}`);
    }
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Ponencias',
        href: '/ponencias',
    },
];
</script>

<template>
    <Head title="Ponencias" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Lista de Ponencias</h1>
                <Button as-child>
                    <Link href="/ponencias/create">Nueva Ponencia</Link>
                </Button>
            </div>

            <div
                class="overflow-hidden rounded-xl border border-sidebar-border/70 bg-white shadow-sm dark:border-sidebar-border dark:bg-gray-900"
            >
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead
                            class="border-b border-sidebar-border/70 bg-gray-100 text-xs font-bold text-gray-600 uppercase dark:border-sidebar-border dark:bg-gray-800 dark:text-gray-300"
                        >
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">Día</th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Horario
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Ponencia
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Recursos
                                </th>
                                <th
                                    class="px-4 py-3 text-right whitespace-nowrap"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border"
                        >
                            <tr
                                v-for="p in ponencias"
                                :key="p.id"
                                class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                            >
                                <td class="px-4 py-3 font-bold text-primary">
                                    Día {{ p.dia }}
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="flex items-center gap-2 font-medium text-gray-900 dark:text-white"
                                    >
                                        <Clock class="h-4 w-4 text-gray-400" />
                                        {{ p.hora_inicio.substring(0, 5) }} -
                                        {{ p.hora_fin.substring(0, 5) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="leading-tight font-bold text-gray-900 uppercase dark:text-white"
                                    >
                                        {{ p.titulo }}
                                    </div>
                                    <div
                                        class="mt-1 text-xs font-medium text-primary"
                                    >
                                        Ponente: {{ p.ponente }}
                                    </div>
                                    <div
                                        v-if="p.descripcion"
                                        class="mt-1 max-w-xs truncate text-xs text-gray-500"
                                        :title="p.descripcion"
                                    >
                                        {{ p.descripcion }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a
                                            v-if="p.link_video"
                                            :href="p.link_video"
                                            target="_blank"
                                            class="rounded-md bg-blue-50 p-1.5 text-blue-600 hover:bg-blue-100"
                                            title="Link Video"
                                        >
                                            <Video class="h-4 w-4" />
                                        </a>
                                        <a
                                            v-if="p.link_material"
                                            :href="p.link_material"
                                            target="_blank"
                                            class="rounded-md bg-purple-50 p-1.5 text-purple-600 hover:bg-purple-100"
                                            title="Link Material"
                                        >
                                            <FileText class="h-4 w-4" />
                                        </a>
                                        <span
                                            v-if="
                                                !p.link_video &&
                                                !p.link_material
                                            "
                                            class="text-xs text-gray-400 italic"
                                            >Sin recursos</span
                                        >
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2"
                                    >
                                        <Link
                                            :href="`/ponencias/${p.id}/edit`"
                                            class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-blue-600"
                                            title="Editar"
                                        >
                                            <Edit class="h-4 w-4" />
                                        </Link>
                                        <button
                                            @click="deletePonencia(p.id)"
                                            class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-red-50 hover:text-red-600"
                                            title="Eliminar"
                                        >
                                            <Trash2 class="h-4 w-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!ponencias || ponencias.length === 0">
                                <td
                                    colspan="5"
                                    class="px-4 py-12 text-center text-gray-500"
                                >
                                    <div
                                        class="flex flex-col items-center justify-center gap-2"
                                    >
                                        <Calendar
                                            class="h-8 w-8 text-gray-300"
                                        />
                                        <p>
                                            No se encontraron ponencias
                                            registradas.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
