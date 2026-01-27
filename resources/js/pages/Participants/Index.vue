<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';

defineProps<{
    participants: Array<{
        id: number;
        dni: string;
        nombres: string;
        apellidos: string;
        email: string;
        celular: string;
        colegio_departamental: string;
        departamento: string;
        provincia: string;
        distrito: string;
        direccion_actual: string;
        categoria_participante: string;
        modalidad_participante: string;
        codigo_pago: string;
        tipo_comprobante: string;
        foto_voucher: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Participantes',
        href: '/participants',
    },
];
</script>

<template>
    <Head title="Participantes" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Lista de Participantes</h1>
                <Button as-child>
                    <Link href="/participants/create">Nuevo Participante</Link>
                </Button>
            </div>

            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-800 text-xs uppercase font-medium border-b border-sidebar-border/70 dark:border-sidebar-border">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">DNI</th>
                                <th class="px-4 py-3">Nombres</th>
                                <th class="px-4 py-3">Apellidos</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Celular</th>
                                <th class="px-4 py-3">Colegio</th>
                                <th class="px-4 py-3">Dpto</th>
                                <th class="px-4 py-3">Prov</th>
                                <th class="px-4 py-3">Dist</th>
                                <th class="px-4 py-3">Dirección</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Modalidad</th>
                                <th class="px-4 py-3">Cód. Pago</th>
                                <th class="px-4 py-3">Comprobante</th>
                                <th class="px-4 py-3">Voucher</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                            <tr v-for="p in participants" :key="p.id" class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                <td class="px-4 py-3">{{ p.id }}</td>
                                <td class="px-4 py-3 font-mono">{{ p.dni }}</td>
                                <td class="px-4 py-3 font-medium">{{ p.nombres }}</td>
                                <td class="px-4 py-3 font-medium">{{ p.apellidos }}</td>
                                <td class="px-4 py-3">{{ p.email }}</td>
                                <td class="px-4 py-3">{{ p.celular }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ p.colegio_departamental }}</td>
                                <td class="px-4 py-3">{{ p.departamento }}</td>
                                <td class="px-4 py-3">{{ p.provincia }}</td>
                                <td class="px-4 py-3">{{ p.distrito }}</td>
                                <td class="px-4 py-3 max-w-[200px] truncate" :title="p.direccion_actual">{{ p.direccion_actual }}</td>
                                <td class="px-4 py-3">{{ p.categoria_participante }}</td>
                                <td class="px-4 py-3">{{ p.modalidad_participante }}</td>
                                <td class="px-4 py-3 font-mono">{{ p.codigo_pago }}</td>
                                <td class="px-4 py-3">{{ p.tipo_comprobante }}</td>
                                <td class="px-4 py-3 text-blue-500 underline cursor-pointer">
                                    <span v-if="p.foto_voucher">Ver Voucher</span>
                                    <span v-else class="text-gray-400 no-underline">N/A</span>
                                </td>
                            </tr>
                            <tr v-if="participants.length === 0">
                                <td colspan="16" class="px-4 py-8 text-center text-gray-500">
                                    No se encontraron participantes registrados.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>