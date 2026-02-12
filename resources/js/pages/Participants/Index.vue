<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Edit, Trash2, Eye, X, Users, CheckCircle } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    participants: Array<{
        id: number;
        dni: string;
        ruc: string | null;
        razon_social: string | null;
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
        foto_voucher: string | null;
        status: number;
    }>;
}>();

const deleteParticipant = (id: number) => {
    if (confirm('¿Estás seguro de que deseas eliminar este participante?')) {
        router.delete(`/participants/${id}`);
    }
};

const activateParticipant = (p: any) => {
    if (confirm(`¿Deseas activar a ${p.nombres} y enviarle su correo de acceso?`)) {
        router.put(`/participants/${p.id}`, {
            ...p,
            status: 1
        }, {
            preserveScroll: true
        });
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

            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border overflow-hidden bg-white dark:bg-gray-900 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 dark:bg-gray-800 text-xs uppercase font-bold text-gray-600 dark:text-gray-300 border-b border-sidebar-border/70 dark:border-sidebar-border">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">ID</th>
                                <th class="px-4 py-3 whitespace-nowrap">Estado</th>
                                <th class="px-4 py-3 whitespace-nowrap">DNI / RUC</th>
                                <th class="px-4 py-3 whitespace-nowrap">Participante</th>
                                <th class="px-4 py-3 whitespace-nowrap">Contacto</th>
                                <th class="px-4 py-3 whitespace-nowrap">Ubicación</th>
                                <th class="px-4 py-3 whitespace-nowrap">Detalles Evento</th>
                                <th class="px-4 py-3 whitespace-nowrap">Pago</th>
                                <th class="px-4 py-3 whitespace-nowrap text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                            <tr v-for="p in participants" :key="p.id" class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-3 font-mono text-gray-500">{{ p.id }}</td>
                                <td class="px-4 py-3">
                                    <span v-if="p.status === 1" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Activo</span>
                                    <button v-else @click="activateParticipant(p)" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 hover:bg-green-600 hover:text-white transition-all group">
                                        <CheckCircle class="w-3 h-3 mr-1" /> Activar
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ p.dni }}</div>
                                    <div v-if="p.ruc" class="text-xs text-gray-500">RUC: {{ p.ruc }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ p.nombres }} {{ p.apellidos }}</div>
                                    <div v-if="p.razon_social" class="text-xs text-gray-500 font-medium">{{ p.razon_social }}</div>
                                    <div class="text-xs text-gray-400">{{ p.colegio_departamental }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-gray-900 dark:text-white">{{ p.email }}</div>
                                    <div class="text-xs text-gray-500">{{ p.celular }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="truncate max-w-[150px]" :title="p.direccion_actual">{{ p.direccion_actual }}</div>
                                    <div class="text-xs text-gray-500">{{ p.departamento }} - {{ p.provincia }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ p.categoria_participante }}</div>
                                    <div class="text-xs text-gray-500">{{ p.modalidad_participante }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-mono text-xs mb-1">{{ p.codigo_pago }}</div>
                                    <div class="text-xs text-gray-500 mb-1">{{ p.tipo_comprobante }}</div>
                                    <button v-if="p.foto_voucher" @click="openVoucher(p.foto_voucher)" class="text-xs text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1">
                                        <Eye class="w-3 h-3" /> Ver Voucher
                                    </button>
                                    <span v-else class="text-xs text-gray-400 italic">Sin voucher</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <Link :href="`/participants/${p.id}/edit`" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-blue-600 transition-colors" title="Editar">
                                            <Edit class="w-4 h-4" />
                                        </Link>
                                        <button @click="deleteParticipant(p.id)" class="p-2 hover:bg-red-50 rounded-lg text-gray-500 hover:text-red-600 transition-colors" title="Eliminar">
                                            <Trash2 class="w-4 h-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!participants || participants.length === 0">
                                <td colspan="9" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <Users class="w-8 h-8 text-gray-300" />
                                        <p>No se encontraron participantes registrados.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Voucher Modal -->
        <div v-if="voucherModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm animate-in fade-in duration-200" @click.self="closeVoucher">
            <div class="relative bg-white rounded-lg shadow-2xl max-w-3xl max-h-[90vh] overflow-hidden">
                <button @click="closeVoucher" class="absolute top-2 right-2 p-2 bg-black/50 text-white rounded-full hover:bg-black/70 transition-colors z-10">
                    <X class="w-5 h-5" />
                </button>
                <img :src="selectedVoucherUrl" alt="Comprobante de Pago" class="w-full h-full object-contain max-h-[85vh]" />
            </div>
        </div>
    </AppLayout>
</template>