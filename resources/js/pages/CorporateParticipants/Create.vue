<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { type BreadcrumbItem } from '@/types';

const form = useForm({
    dni: '', // RUC
    nombres: '', // Company Name
    // apellidos: '', // Maybe Contact Name? Controller needs handling. 
    // Wait, DB schema for Corporate: ruc, address, contact_name, contact_phone...
    // But Controller stores into 'participants' table using 'dni' for 'ruc' etc?
    // Let's check the CorporateParticipantController again.
    // It maps: dni -> RUC, nombres -> Company Name, email -> Contact Email.
    // But I added specific columns to the DB: ruc, company_name, etc.
    // AND I updated the Participant model to have 'dni', 'nombres', etc.
    // AND I updated CorporateParticipant model (which IS Participant class in code now) to have 'company_name', 'ruc' etc.
    
    // WAIT. I made a mistake in previous steps. 
    // I made 'participants' table have 'dni', 'nombres'.
    // I made 'corporate_participants' table have 'ruc', 'company_name'.
    // BUT I am using Participant model for BOTH in the routes?
    // Route::get('corporate-participants', [CorporateParticipantController::class, 'index']) -> Participant::where('categoria...', 'Corporativo').
    // So I am storing Corporate participants IN the 'participants' table.
    // BUT I added columns to 'corporate_participants' table! They are separate tables in DB!
    // But I am using Participant model which links to 'participants' table.
    // So if I save a corporate participant using Participant model, it goes to 'participants' table.
    // The 'corporate_participants' table is currently UNUSED by the app logic I wrote.
    
    // I should probably consolidate or fix this. 
    // The user asked for "same table just filtered".
    // "en participantes tiene que ser la misma tabla que participantes solo se filtrata por el campo de categoria de participante"
    // So YES, I should use the 'participants' table for EVERYTHING.
    // So I need to map Corporate fields to 'participants' table fields.
    // RUC -> dni
    // Company Name -> nombres
    // Address -> direccion_actual
    // Contact Name -> Maybe 'apellidos'? Or I should add 'contact_name' to participants table?
    // For now, let's map:
    // RUC -> dni
    // Company Name -> nombres
    // Contact Name -> apellidos
    // Contact Email -> email
    // Contact Phone -> celular
    
    // This matches the Seeder logic I wrote:
    // 'dni' => '20123456789', // RUC
    // 'nombres' => 'Tech Solutions',
    // 'apellidos' => 'SAC', // or Contact Name
    
    // I will proceed with this mapping for the Form.
    apellidos: '', // Contact Name
    email: '', // Contact Email
    celular: '', // Contact Phone
    direccion_actual: '', // Address
    // other fields if needed
});

const submit = () => {
    form.post('/corporate-participants');
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Participantes Corporativos',
        href: '/corporate-participants',
    },
    {
        title: 'Nuevo Corp. Participante',
        href: '/corporate-participants/create',
    },
];
</script>

<template>
    <Head title="Nuevo Participante Corporativo" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Registrar Empresa</h1>
            
            <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                
                <div class="space-y-2">
                    <Label for="dni">RUC</Label>
                    <Input id="dni" v-model="form.dni" required placeholder="20..." />
                    <InputError :message="form.errors.dni" />
                </div>

                <div class="space-y-2">
                    <Label for="nombres">Razón Social (Empresa)</Label>
                    <Input id="nombres" v-model="form.nombres" required />
                    <InputError :message="form.errors.nombres" />
                </div>

                <div class="space-y-2">
                    <Label for="apellidos">Persona de Contacto</Label>
                    <Input id="apellidos" v-model="form.apellidos" placeholder="Nombre del contacto" />
                </div>

                <div class="space-y-2">
                    <Label for="email">Email de Contacto</Label>
                    <Input id="email" type="email" v-model="form.email" required />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="space-y-2">
                    <Label for="celular">Teléfono / Celular</Label>
                    <Input id="celular" v-model="form.celular" />
                </div>

                <div class="space-y-2 md:col-span-2">
                    <Label for="direccion_actual">Dirección Fiscal / Oficina</Label>
                    <Input id="direccion_actual" v-model="form.direccion_actual" />
                </div>

                <div class="md:col-span-2 flex justify-end">
                    <Button type="submit" :disabled="form.processing">
                        Guardar Empresa
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
