<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { type BreadcrumbItem } from '@/types';

const form = useForm({
    dni: '',
    nombres: '',
    apellidos: '',
    email: '',
    celular: '',
    colegio_departamental: '',
    departamento: '',
    provincia: '',
    distrito: '',
    direccion_actual: '',
    categoria_participante: '',
    modalidad_participante: '',
    codigo_pago: '',
    tipo_comprobante: '',
    foto_voucher: '',
});

const submit = () => {
    form.post('/participants');
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Participantes',
        href: '/participants',
    },
    {
        title: 'Nuevo Participante',
        href: '/participants/create',
    },
];
</script>

<template>
    <Head title="Nuevo Participante" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Registrar Nuevo Participante</h1>
            
            <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                
                <div class="space-y-2">
                    <Label for="dni">DNI</Label>
                    <Input id="dni" v-model="form.dni" required />
                    <InputError :message="form.errors.dni" />
                </div>

                <div class="space-y-2">
                    <Label for="nombres">Nombres</Label>
                    <Input id="nombres" v-model="form.nombres" required />
                    <InputError :message="form.errors.nombres" />
                </div>

                <div class="space-y-2">
                    <Label for="apellidos">Apellidos</Label>
                    <Input id="apellidos" v-model="form.apellidos" required />
                    <InputError :message="form.errors.apellidos" />
                </div>

                <div class="space-y-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" v-model="form.email" required />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="space-y-2">
                    <Label for="celular">Celular</Label>
                    <Input id="celular" v-model="form.celular" />
                    <InputError :message="form.errors.celular" />
                </div>

                <div class="space-y-2">
                    <Label for="colegio_departamental">Colegio Departamental</Label>
                    <Input id="colegio_departamental" v-model="form.colegio_departamental" />
                </div>

                <div class="space-y-2">
                    <Label for="departamento">Departamento</Label>
                    <Input id="departamento" v-model="form.departamento" />
                </div>

                <div class="space-y-2">
                    <Label for="provincia">Provincia</Label>
                    <Input id="provincia" v-model="form.provincia" />
                </div>

                <div class="space-y-2">
                    <Label for="distrito">Distrito</Label>
                    <Input id="distrito" v-model="form.distrito" />
                </div>

                <div class="space-y-2 md:col-span-2">
                    <Label for="direccion_actual">Dirección Actual</Label>
                    <Input id="direccion_actual" v-model="form.direccion_actual" />
                </div>

                <div class="space-y-2">
                    <Label for="categoria_participante">Categoría</Label>
                    <!-- Simple select using native HTML for now, could use a UI Select component if available -->
                    <select id="categoria_participante" v-model="form.categoria_participante" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm dark:border-sidebar-border dark:text-white">
                        <option value="" disabled>Seleccione una categoría</option>
                        <option value="ESTUDIANTES">ESTUDIANTES</option>
                        <option value="PLENOS">PLENOS</option>
                        <option value="OBSERVADORES">OBSERVADORES</option>
                    </select>
                    <InputError :message="form.errors.categoria_participante" />
                </div>

                <div class="space-y-2">
                    <Label for="modalidad_participante">Modalidad</Label>
                    <select id="modalidad_participante" v-model="form.modalidad_participante" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm dark:border-sidebar-border dark:text-white">
                        <option value="" disabled>Seleccione modalidad</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <Label for="codigo_pago">Código de Pago</Label>
                    <Input id="codigo_pago" v-model="form.codigo_pago" />
                </div>

                <div class="space-y-2">
                    <Label for="tipo_comprobante">Tipo de Comprobante</Label>
                    <Input id="tipo_comprobante" v-model="form.tipo_comprobante" />
                </div>
                
                <!-- Voucher can be text for now as per controller logic -->
                <div class="space-y-2">
                    <Label for="foto_voucher">Foto Voucher (URL/Path)</Label>
                    <Input id="foto_voucher" v-model="form.foto_voucher" placeholder="Ruta del archivo" />
                </div>

                <div class="md:col-span-2 flex justify-end">
                    <Button type="submit" :disabled="form.processing">
                        Guardar Participante
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
