<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Trash2, ExternalLink } from 'lucide-vue-next';

defineProps<{
    photos: Array<{ id: number, title: string, path: string }>;
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Galería de Fotos</h1>
                    <p class="text-slate-500 text-sm mt-1">Gestiona las imágenes que se muestran en el landing page y la galería pública.</p>
                </div>
                <Button as-child>
                    <Link href="/photos/create">Subir Foto</Link>
                </Button>
            </div>

            <div v-if="photos.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div v-for="photo in photos" :key="photo.id" class="group relative aspect-video overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-all">
                     <img :src="photo.path" :alt="photo.title" class="w-full h-full object-cover" />
                     
                     <!-- Overlay on hover -->
                     <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-4 text-white">
                         <div class="flex justify-end gap-2">
                             <a :href="photo.path" target="_blank" class="p-2 bg-white/20 hover:bg-white/40 rounded-lg backdrop-blur-sm transition-colors" title="Ver original">
                                 <ExternalLink class="w-4 h-4" />
                             </a>
                             <button @click="deletePhoto(photo.id)" class="p-2 bg-red-500/80 hover:bg-red-500 rounded-lg backdrop-blur-sm transition-colors" title="Eliminar">
                                 <Trash2 class="w-4 h-4" />
                             </button>
                         </div>
                         <div class="bg-black/20 p-2 rounded-lg backdrop-blur-sm">
                             <p class="text-xs font-bold truncate">{{ photo.title }}</p>
                         </div>
                     </div>
                </div>
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
