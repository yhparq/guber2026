<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Save } from 'lucide-vue-next';

import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    participant: {
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
        status: number;
    };
}>();

const form = useForm({
    _method: 'PUT', // For multipart/form-data support with PUT
    dni: props.participant.dni,
    nombres: props.participant.nombres,
    apellidos: props.participant.apellidos,
    email: props.participant.email,
    celular: props.participant.celular,
    colegio_departamental: props.participant.colegio_departamental,
    departamento: props.participant.departamento,
    provincia: props.participant.provincia,
    distrito: props.participant.distrito,
    direccion_actual: props.participant.direccion_actual,
    categoria_participante: props.participant.categoria_participante,
    modalidad_participante: props.participant.modalidad_participante,
    codigo_pago: props.participant.codigo_pago,
    tipo_comprobante: props.participant.tipo_comprobante,
    ruc: props.participant.ruc || '',
    razon_social: props.participant.razon_social || '',
    status: props.participant.status,
    foto_voucher: null as File | null,
});

const submit = () => {
    form.post(`/participants/${props.participant.id}`, {
        preserveScroll: true,
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Participantes', href: '/participants' },
    { title: 'Editar Participante', href: '#' },
];

const professionalColleges = [
    'NO PERTENEZCO A NINGÚN COLEGIO DEPARTAMENTAL',
    'COLEGIO DE CONTADORES PÚBLICOS DE PUNO',
    'COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS',
    // ... Simplified for brevity in admin
];
</script>

<template>
    <Head title="Editar Participante" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">
                    Editar Participante #{{ participant.id }}
                </h1>
                <Button variant="outline" as-child>
                    <a href="/participants"
                        ><ArrowLeft class="mr-2 h-4 w-4" /> Volver</a
                    >
                </Button>
            </div>

            <div
                class="max-w-4xl rounded-xl border border-sidebar-border/70 bg-white p-6 shadow-sm dark:bg-gray-900"
            >
                <form
                    @submit.prevent="submit"
                    class="grid grid-cols-1 gap-6 md:grid-cols-2"
                >
                    <div class="space-y-2">
                        <label class="text-sm font-bold"
                            >Estado de Activación</label
                        >
                        <select
                            v-model="form.status"
                            class="w-full rounded-lg border bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-primary/20 dark:bg-gray-800"
                        >
                            <option :value="0">Pendiente (Inactivo)</option>
                            <option :value="1">Activo (Verificado)</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">DNI</label>
                        <input
                            v-model="form.dni"
                            type="text"
                            class="w-full rounded-lg border bg-gray-50 px-3 py-2 dark:bg-gray-800"
                        />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Nombres</label>
                        <input
                            v-model="form.nombres"
                            type="text"
                            class="w-full rounded-lg border px-3 py-2"
                        />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Apellidos</label>
                        <input
                            v-model="form.apellidos"
                            type="text"
                            class="w-full rounded-lg border px-3 py-2"
                        />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="w-full rounded-lg border px-3 py-2"
                        />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Celular</label>
                        <input
                            v-model="form.celular"
                            type="text"
                            class="w-full rounded-lg border px-3 py-2"
                        />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold"
                            >Tipo Comprobante</label
                        >
                        <select
                            v-model="form.tipo_comprobante"
                            class="w-full rounded-lg border bg-white px-3 py-2 dark:bg-gray-800"
                        >
                            <option value="Boleta">Boleta</option>
                            <option value="Factura">Factura</option>
                        </select>
                    </div>

                    <div
                        v-if="form.tipo_comprobante === 'Factura'"
                        class="space-y-2"
                    >
                        <label class="text-sm font-bold text-primary"
                            >RUC</label
                        >
                        <input
                            v-model="form.ruc"
                            type="text"
                            class="w-full rounded-lg border border-primary/50 px-3 py-2"
                        />
                    </div>

                    <div
                        v-if="form.tipo_comprobante === 'Factura'"
                        class="space-y-2"
                    >
                        <label class="text-sm font-bold text-primary"
                            >Razón Social</label
                        >
                        <input
                            v-model="form.razon_social"
                            type="text"
                            class="w-full rounded-lg border border-primary/50 px-3 py-2"
                        />
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-bold"
                            >Actualizar Voucher (Opcional)</label
                        >
                        <input
                            type="file"
                            @input="form.foto_voucher = $event.target.files[0]"
                            class="w-full rounded-lg border px-3 py-2"
                        />
                    </div>

                    <div class="mt-4 border-t pt-4 md:col-span-2">
                        <Button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full md:w-auto"
                        >
                            <Save class="mr-2 h-4 w-4" />
                            {{
                                form.processing
                                    ? 'Guardando...'
                                    : 'Guardar Cambios'
                            }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
