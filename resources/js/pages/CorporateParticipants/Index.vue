<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Edit, Eye, FileDown, Trash2, Users, X, CheckCircle } from 'lucide-vue-next';
import { ref } from 'vue';

import Pagination from '@/components/Pagination.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    participants: {
        data: Array<{
            id: number;
            razon_social: string;
            codigo_pago: string;
            foto_voucher: string | null;
            tipo_comprobante_pago: string | null;

            dni: string;
            nombres: string;
            apellidos: string;
            email: string;
            celular: string;

            departamento: string | null;
            provincia: string | null;
            distrito: string | null;
            direccion: string | null;

            colegio_departamental: string | null;
            categoria_participante: string;
            modalidad_participante: string;

            tipo_comprobante_individual: string | null;
            ruc_individual: string | null;

            status: number;
        }>;
        links: any[];
    };
}>();

const deleteParticipant = (id: number) => {
    if (
        confirm(
            '¿Estás seguro de que deseas eliminar este participante corporativo?',
        )
    ) {
        router.delete(`/corporate-participants/${id}`);
    }
};

const activateParticipant = (p: any) => {
    if (
        confirm(
            `¿Deseas activar a ${p.nombres} y enviarle su correo de acceso?`,
        )
    ) {
        router.put(
            `/corporate-participants/${p.id}`,
            {
                ...p,
                status: 1,
            },
            {
                preserveScroll: true,
            },
        );
    }
};

const voucherModalOpen = ref(false);
const selectedVoucherUrl = ref('');

const openVoucher = (path: string) => {
    selectedVoucherUrl.value = `/storage/${path}`;
    voucherModalOpen.value = true;
};

const closeVoucher = () => {
    voucherModalOpen.value = false;
    selectedVoucherUrl.value = '';
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Participantes Corporativos',
        href: '/corporate-participants',
    },
];
</script>

<template>
    <Head title="Participantes Corporativos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">
                    Lista de Participantes Corporativos
                </h1>
                <div class="flex gap-2">
                    <a
                        href="/corporate-participants/export"
                        class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-bold text-white shadow-sm transition-colors hover:bg-green-700"
                    >
                        <FileDown class="mr-2 h-4 w-4" /> Exportar Excel
                    </a>
                </div>
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
                                <th class="px-4 py-3 whitespace-nowrap">ID</th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Estado
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Empresa / Pago
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Participante
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Contacto
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Ubicación
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Detalles Evento
                                </th>
                                <th class="px-4 py-3 whitespace-nowrap">
                                    Facturación Ind.
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
                                v-for="p in participants.data"
                                :key="p.id"
                                class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                            >
                                <td class="px-4 py-3 font-mono text-gray-500">
                                    {{ p.id }}
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        v-if="p.status === 1"
                                        class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700"
                                        >Activo</span
                                    >
                                    <button
                                        v-else
                                        @click="activateParticipant(p)"
                                        class="group inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-bold text-yellow-700 transition-all hover:bg-green-600 hover:text-white"
                                    >
                                        <CheckCircle class="mr-1 h-3 w-3" />
                                        Activar
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="font-bold text-gray-900 dark:text-white"
                                    >
                                        {{ p.razon_social }}
                                    </div>
                                    <div
                                        class="font-mono text-xs text-gray-500"
                                    >
                                        Op: {{ p.codigo_pago }}
                                    </div>
                                    <button
                                        v-if="p.foto_voucher"
                                        @click="openVoucher(p.foto_voucher)"
                                        class="mt-1 flex items-center gap-1 text-xs text-blue-600 hover:text-blue-800 hover:underline"
                                    >
                                        <Eye class="h-3 w-3" /> Ver Voucher
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="font-bold text-gray-900 dark:text-white"
                                    >
                                        {{ p.nombres }} {{ p.apellidos }}
                                    </div>
                                    <div
                                        class="font-mono text-xs text-gray-500"
                                    >
                                        {{ p.dni }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ p.colegio_departamental }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-gray-900 dark:text-white">
                                        {{ p.email }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ p.celular }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="max-w-[150px] truncate"
                                        :title="p.direccion"
                                    >
                                        {{ p.direccion }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ p.departamento }} - {{ p.provincia }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium">
                                        {{ p.categoria_participante }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ p.modalidad_participante }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        v-if="
                                            p.tipo_comprobante_individual ===
                                            'Factura'
                                        "
                                    >
                                        <span
                                            class="text-xs font-bold text-gray-700"
                                            >Factura</span
                                        >
                                        <div class="text-xs text-gray-500">
                                            RUC: {{ p.ruc_individual }}
                                        </div>
                                    </div>
                                    <span
                                        v-else-if="
                                            p.tipo_comprobante_individual
                                        "
                                        class="text-xs text-gray-500"
                                        >{{
                                            p.tipo_comprobante_individual
                                        }}</span
                                    >
                                    <span
                                        v-else
                                        class="text-xs text-gray-400 italic"
                                        >Global</span
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2"
                                    >
                                        <Link
                                            :href="`/corporate-participants/${p.id}/edit`"
                                            class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-blue-600"
                                            title="Editar"
                                        >
                                            <Edit class="h-4 w-4" />
                                        </Link>
                                        <button
                                            @click="deleteParticipant(p.id)"
                                            class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-red-50 hover:text-red-600"
                                            title="Eliminar"
                                        >
                                            <Trash2 class="h-4 w-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                v-if="
                                    !participants.data ||
                                    participants.data.length === 0
                                "
                            >
                                <td
                                    colspan="9"
                                    class="px-4 py-12 text-center text-gray-500"
                                >
                                    <div
                                        class="flex flex-col items-center justify-center gap-2"
                                    >
                                        <Users class="h-8 w-8 text-gray-300" />
                                        <p>
                                            No se encontraron participantes
                                            corporativos registrados.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :links="participants.links" />
            </div>
        </div>

        <!-- Voucher Modal -->
        <div
            v-if="voucherModalOpen"
            class="fixed inset-0 z-50 flex animate-in items-center justify-center bg-black/80 p-4 backdrop-blur-sm duration-200 fade-in"
            @click.self="closeVoucher"
        >
            <div
                class="relative max-h-[90vh] max-w-3xl overflow-hidden rounded-lg bg-white shadow-2xl"
            >
                <button
                    @click="closeVoucher"
                    class="absolute top-2 right-2 z-10 rounded-full bg-black/50 p-2 text-white transition-colors hover:bg-black/70"
                >
                    <X class="h-5 w-5" />
                </button>
                <img
                    :src="selectedVoucherUrl"
                    alt="Comprobante de Pago"
                    class="h-full max-h-[85vh] w-full object-contain"
                />
            </div>
        </div>
    </AppLayout>
</template>
