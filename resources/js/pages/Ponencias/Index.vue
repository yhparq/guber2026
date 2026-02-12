<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Calendar, Clock, Video, FileText } from 'lucide-vue-next';

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

            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border overflow-hidden bg-white dark:bg-gray-900 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 dark:bg-gray-800 text-xs uppercase font-bold text-gray-600 dark:text-gray-300 border-b border-sidebar-border/70 dark:border-sidebar-border">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">Día</th>
                                <th class="px-4 py-3 whitespace-nowrap">Horario</th>
                                <th class="px-4 py-3 whitespace-nowrap">Ponencia</th>
                                <th class="px-4 py-3 whitespace-nowrap">Recursos</th>
                                <th class="px-4 py-3 whitespace-nowrap text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                            <tr v-for="p in ponencias" :key="p.id" class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-3 font-bold text-primary">Día {{ p.dia }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2 text-gray-900 dark:text-white font-medium">
                                        <Clock class="w-4 h-4 text-gray-400" /> {{ p.hora_inicio.substring(0, 5) }} - {{ p.hora_fin.substring(0, 5) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900 dark:text-white uppercase leading-tight">{{ p.titulo }}</div>
                                    <div class="text-xs text-primary font-medium mt-1">Ponente: {{ p.ponente }}</div>
                                    <div v-if="p.descripcion" class="text-xs text-gray-500 mt-1 truncate max-w-xs" :title="p.descripcion">{{ p.descripcion }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a v-if="p.link_video" :href="p.link_video" target="_blank" class="p-1.5 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100" title="Link Video">
                                            <Video class="w-4 h-4" />
                                        </a>
                                        <a v-if="p.link_material" :href="p.link_material" target="_blank" class="p-1.5 bg-purple-50 text-purple-600 rounded-md hover:bg-purple-100" title="Link Material">
                                            <FileText class="w-4 h-4" />
                                        </a>
                                        <span v-if="!p.link_video && !p.link_material" class="text-xs text-gray-400 italic">Sin recursos</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <Link :href="`/ponencias/${p.id}/edit`" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-blue-600 transition-colors" title="Editar">
                                            <Edit class="w-4 h-4" />
                                        </Link>
                                        <button @click="deletePonencia(p.id)" class="p-2 hover:bg-red-50 rounded-lg text-gray-500 hover:text-red-600 transition-colors" title="Eliminar">
                                            <Trash2 class="w-4 h-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!ponencias || ponencias.length === 0">
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <Calendar class="w-8 h-8 text-gray-300" />
                                        <p>No se encontraron ponencias registradas.</p>
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
