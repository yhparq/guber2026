<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { type BreadcrumbItem } from '@/types';
import { Upload } from 'lucide-vue-next';

const form = useForm({
    titulo: '',
    ponente: '',
    descripcion: '',
    hora_inicio: '',
    hora_fin: '',
    dia: 1,
    link_video: '',
    link_material: '',
    archivo_material: null as File | null,
});

const submit = () => {
    form.post('/ponencias');
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Ponencias',
        href: '/ponencias',
    },
    {
        title: 'Nueva Ponencia',
        href: '/ponencias/create',
    },
];
</script>

<template>
    <Head title="Nueva Ponencia" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Registrar Nueva Ponencia</h1>
            
            <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                
                <div class="space-y-2 md:col-span-2">
                    <Label for="titulo">Título de la Ponencia</Label>
                    <Input id="titulo" v-model="form.titulo" required placeholder="Ej: Modernización de la Gestión Pública" />
                    <InputError :message="form.errors.titulo" />
                </div>

                <div class="space-y-2">
                    <Label for="ponente">Nombre del Ponente</Label>
                    <Input id="ponente" v-model="form.ponente" required placeholder="Ej: Dr. Juan Pérez" />
                    <InputError :message="form.errors.ponente" />
                </div>

                <div class="space-y-2">
                    <Label for="dia">Día del Evento</Label>
                    <select id="dia" v-model="form.dia" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring dark:border-sidebar-border dark:text-white">
                        <option :value="1">Día 1 - Jueves 23</option>
                        <option :value="2">Día 2 - Viernes 24</option>
                        <option :value="3">Día 3 - Sábado 25</option>
                    </select>
                    <InputError :message="form.errors.dia" />
                </div>

                <div class="space-y-2">
                    <Label for="hora_inicio">Hora de Inicio</Label>
                    <Input id="hora_inicio" type="time" v-model="form.hora_inicio" required />
                    <InputError :message="form.errors.hora_inicio" />
                </div>

                <div class="space-y-2">
                    <Label for="hora_fin">Hora de Finalización</Label>
                    <Input id="hora_fin" type="time" v-model="form.hora_fin" required />
                    <InputError :message="form.errors.hora_fin" />
                </div>

                <div class="space-y-2 md:col-span-2">
                    <Label for="descripcion">Descripción / Resumen (Opcional)</Label>
                    <textarea id="descripcion" v-model="form.descripcion" placeholder="Breve descripción de los temas a tratar..." rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 dark:border-sidebar-border dark:text-white"></textarea>
                    <InputError :message="form.errors.descripcion" />
                </div>

                <div class="space-y-2">
                    <Label for="link_video">Link de Video / Transmisión (Opcional)</Label>
                    <Input id="link_video" type="url" v-model="form.link_video" placeholder="https://youtube.com/..." />
                    <InputError :message="form.errors.link_video" />
                </div>

                <div class="space-y-2">
                    <Label for="archivo_material" class="flex items-center gap-2">
                        <Upload class="w-4 h-4" /> Subir Material (PDF)
                    </Label>
                    <input id="archivo_material" type="file" @input="form.archivo_material = $event.target.files[0]" accept=".pdf" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 dark:border-sidebar-border" />
                    <p class="text-[10px] text-slate-400">Solo archivos PDF. Máximo 10MB.</p>
                    <InputError :message="form.errors.archivo_material" />
                </div>

                <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                    <Button variant="outline" as-child>
                        <Link href="/ponencias">Cancelar</Link>
                    </Button>
                    <Button type="submit" :disabled="form.processing">
                        Guardar Ponencia
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
