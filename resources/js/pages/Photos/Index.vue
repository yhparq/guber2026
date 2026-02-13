<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Trash2, ExternalLink, Edit2, Plus } from 'lucide-vue-next';
import Pagination from '@/components/Pagination.vue';

const props = defineProps<{
    photos: {
        data: Array<{ id: number, title: string, path: string }>;
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
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Galería del Administrador</h1>
                    <p class="text-slate-500 text-sm mt-1">Gestiona las imágenes que se muestran en el sitio web principal.</p>
                </div>
                <Button as-child class="rounded-xl h-12 px-6 shadow-lg shadow-primary/20">
                    <Link href="/photos/create">
                        <Plus class="w-4 h-4 mr-2" />
                        Nueva Foto
                    </Link>
                </Button>
            </div>

            <div v-if="photos.data.length > 0" class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Miniatura</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Descripción / Título</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Fecha</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr v-for="photo in photos.data" :key="photo.id" class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="w-20 h-12 rounded-lg overflow-hidden bg-slate-100 border border-slate-200">
                                    <img :src="photo.path" :alt="photo.title" class="w-full h-full object-cover" />
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-900">{{ photo.title }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-slate-500">Reciente</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a :href="photo.path" target="_blank" class="p-2 text-slate-400 hover:text-primary hover:bg-white rounded-xl transition-all border border-transparent hover:border-slate-100 shadow-none hover:shadow-sm" title="Ver original">
                                        <ExternalLink class="w-4 h-4" />
                                    </a>
                                    <Link :href="`/photos/${photo.id}/edit`" class="p-2 text-slate-400 hover:text-primary hover:bg-white rounded-xl transition-all border border-transparent hover:border-slate-100 shadow-none hover:shadow-sm" title="Editar">
                                        <Edit2 class="w-4 h-4" />
                                    </Link>
                                    <button @click="deletePhoto(photo.id)" class="p-2 text-slate-400 hover:text-red-500 hover:bg-white rounded-xl transition-all border border-transparent hover:border-slate-100 shadow-none hover:shadow-sm" title="Eliminar">
                                        <Trash2 class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="photos.links" />
            </div>
            
            <div v-else class="flex flex-col items-center justify-center py-20 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-800">
                <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center shadow-sm mb-4">
                    <Trash2 class="w-8 h-8 text-slate-300" />
                </div>
                <p class="text-slate-500 font-medium">No hay fotos registradas aún.</p>
                <Link href="/photos/create" class="text-primary font-bold text-sm mt-4 hover:underline">Subir la primera foto</Link>
            </div>
        </div>
    </AppLayout>
</template>
