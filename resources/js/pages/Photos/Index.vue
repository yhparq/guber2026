<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Edit2, ExternalLink, Plus, Trash2 } from 'lucide-vue-next';

import Pagination from '@/components/Pagination.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    photos: {
        data: Array<{ id: number; title: string; path: string }>;
        links: any[];
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Fotos',
        href: '/photos',
    },
];

const deletePhoto = (id: number) => {
    if (confirm('¿Estás seguro de que deseas eliminar esta foto?')) {
        router.delete(`/photos/${id}`);
    }
};
</script>

<template>
    <Head title="Fotos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div
                class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-center"
            >
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">
                        Galería del Administrador
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Gestiona las imágenes que se muestran en el sitio web
                        principal.
                    </p>
                </div>
                <Button
                    as-child
                    class="h-12 rounded-xl px-6 shadow-lg shadow-primary/20"
                >
                    <Link href="/photos/create">
                        <Plus class="mr-2 h-4 w-4" />
                        Nueva Foto
                    </Link>
                </Button>
            </div>

            <div
                v-if="photos.data.length > 0"
                class="overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm"
            >
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th
                                class="px-6 py-5 text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                            >
                                Miniatura
                            </th>
                            <th
                                class="px-6 py-5 text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                            >
                                Descripción / Título
                            </th>
                            <th
                                class="px-6 py-5 text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                            >
                                Fecha
                            </th>
                            <th
                                class="px-6 py-5 text-right text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr
                            v-for="photo in photos.data"
                            :key="photo.id"
                            class="group transition-colors hover:bg-slate-50/50"
                        >
                            <td class="px-6 py-4">
                                <div
                                    class="h-12 w-20 overflow-hidden rounded-lg border border-slate-200 bg-slate-100"
                                >
                                    <img
                                        :src="photo.path"
                                        :alt="photo.title"
                                        class="h-full w-full object-cover"
                                    />
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-bold text-slate-900"
                                    >{{ photo.title }}</span
                                >
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-slate-500"
                                    >Reciente</span
                                >
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a
                                        :href="photo.path"
                                        target="_blank"
                                        class="rounded-xl border border-transparent p-2 text-slate-400 shadow-none transition-all hover:border-slate-100 hover:bg-white hover:text-primary hover:shadow-sm"
                                        title="Ver original"
                                    >
                                        <ExternalLink class="h-4 w-4" />
                                    </a>
                                    <Link
                                        :href="`/photos/${photo.id}/edit`"
                                        class="rounded-xl border border-transparent p-2 text-slate-400 shadow-none transition-all hover:border-slate-100 hover:bg-white hover:text-primary hover:shadow-sm"
                                        title="Editar"
                                    >
                                        <Edit2 class="h-4 w-4" />
                                    </Link>
                                    <button
                                        @click="deletePhoto(photo.id)"
                                        class="rounded-xl border border-transparent p-2 text-slate-400 shadow-none transition-all hover:border-slate-100 hover:bg-white hover:text-red-500 hover:shadow-sm"
                                        title="Eliminar"
                                    >
                                        <Trash2 class="h-4 w-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="photos.links" />
            </div>

            <div
                v-else
                class="flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 py-20 dark:border-slate-800 dark:bg-slate-900/50"
            >
                <div
                    class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm dark:bg-slate-800"
                >
                    <Trash2 class="h-8 w-8 text-slate-300" />
                </div>
                <p class="font-medium text-slate-500">
                    No hay fotos registradas aún.
                </p>
                <Link
                    href="/photos/create"
                    class="mt-4 text-sm font-bold text-primary hover:underline"
                    >Subir la primera foto</Link
                >
            </div>
        </div>
    </AppLayout>
</template>
