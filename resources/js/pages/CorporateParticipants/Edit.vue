<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Save, ArrowLeft } from 'lucide-vue-next';

const props = defineProps<{
    participant: {
        id: number;
        razon_social: string;
        codigo_pago: string;
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
    };
}>();

const form = useForm({
    _method: 'PUT',
    razon_social: props.participant.razon_social,
    codigo_pago: props.participant.codigo_pago,
    tipo_comprobante_pago: props.participant.tipo_comprobante_pago,
    
    dni: props.participant.dni,
    nombres: props.participant.nombres,
    apellidos: props.participant.apellidos,
    email: props.participant.email,
    celular: props.participant.celular,
    
    departamento: props.participant.departamento,
    provincia: props.participant.provincia,
    distrito: props.participant.distrito,
    direccion: props.participant.direccion,
    
    colegio_departamental: props.participant.colegio_departamental,
    categoria_participante: props.participant.categoria_participante,
    modalidad_participante: props.participant.modalidad_participante,
    
    tipo_comprobante_individual: props.participant.tipo_comprobante_individual || 'Boleta',
    ruc_individual: props.participant.ruc_individual || '',
    
    status: props.participant.status,
    foto_voucher: null as File | null,
});

const submit = () => {
    form.post(`/corporate-participants/${props.participant.id}`, {
        preserveScroll: true,
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Participantes Corporativos', href: '/corporate-participants' },
    { title: 'Editar Participante', href: '#' },
];
</script>

<template>
    <Head title="Editar Corporativo" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Editar Corporativo #{{ participant.id }}</h1>
                <Button variant="outline" as-child>
                    <a href="/corporate-participants"><ArrowLeft class="w-4 h-4 mr-2" /> Volver</a>
                </Button>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-xl border border-sidebar-border/70 p-6 shadow-sm max-w-4xl">
                <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2 border-b pb-2 mb-2">
                        <h3 class="text-sm font-bold text-gray-500 uppercase">Datos de la Empresa / Pago</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Razón Social</label>
                        <input v-model="form.razon_social" type="text" class="w-full px-3 py-2 rounded-lg border bg-gray-50 dark:bg-gray-800" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Código de Pago</label>
                        <input v-model="form.codigo_pago" type="text" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="md:col-span-2 border-b pb-2 mb-2 mt-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase">Datos Personales</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Estado</label>
                        <select v-model="form.status" class="w-full px-3 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-white dark:bg-gray-800">
                            <option :value="0">Pendiente (Inactivo)</option>
                            <option :value="1">Activo (Verificado)</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">DNI</label>
                        <input v-model="form.dni" type="text" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Nombres</label>
                        <input v-model="form.nombres" type="text" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Apellidos</label>
                        <input v-model="form.apellidos" type="text" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Email</label>
                        <input v-model="form.email" type="email" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Celular</label>
                        <input v-model="form.celular" type="text" class="w-full px-3 py-2 rounded-lg border" />
                    </div>

                    <div class="md:col-span-2 border-b pb-2 mb-2 mt-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase">Facturación Individual (Opcional)</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold">Tipo Comprobante</label>
                        <select v-model="form.tipo_comprobante_individual" class="w-full px-3 py-2 rounded-lg border bg-white dark:bg-gray-800">
                            <option value="Boleta">Boleta</option>
                            <option value="Factura">Factura</option>
                        </select>
                    </div>

                    <div v-if="form.tipo_comprobante_individual === 'Factura'" class="space-y-2">
                        <label class="text-sm font-bold text-primary">RUC Individual</label>
                        <input v-model="form.ruc_individual" type="text" class="w-full px-3 py-2 rounded-lg border border-primary/50" />
                    </div>

                    <div class="md:col-span-2 pt-4 border-t mt-4">
                        <Button type="submit" :disabled="form.processing" class="w-full md:w-auto">
                            <Save class="w-4 h-4 mr-2" /> {{ form.processing ? 'Guardando...' : 'Guardar Cambios' }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>