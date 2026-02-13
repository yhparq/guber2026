<script setup lang="ts">
import { Head, useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';
import { Upload, X, Save } from 'lucide-vue-next';

const props = defineProps<{
    photo: { id: number, title: string, path: string };
}>();

const form = useForm({
    title: props.photo.title,
    image: null as File | null,
    _method: 'POST' // We use POST for update with files
});

const imagePreview = ref<string | null>(props.photo.path);

const handleImageChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.image = file;
        
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    form.post(`/photos/${props.photo.id}`);
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Fotos',
        href: '/photos',
    },
    {
        title: 'Editar Foto',
        href: `/photos/${props.photo.id}/edit`,
    },
];
</script>

<template>
    <Head title="Editar Foto" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Editar Foto</h1>
                <p class="text-slate-500 text-sm mt-1">Actualiza la descripción o la imagen de la galería.</p>
            </div>
            
            <form @submit.prevent="submit" class="space-y-8 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                
                <div class="space-y-2">
                    <Label for="title" class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Descripción / Título</Label>
                    <Input 
                        id="title" 
                        v-model="form.title" 
                        required 
                        placeholder="Ej: Ceremonia de Inauguración"
                        class="h-12 rounded-xl border-slate-100 focus:border-primary focus:ring-primary"
                    />
                    <InputError :message="form.errors.title" />
                </div>

                <div class="space-y-2">
                    <Label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Imagen (Dejar en blanco para mantener la actual)</Label>
                    
                    <div class="relative rounded-3xl overflow-hidden border border-slate-200 bg-slate-50 p-2">
                        <img :src="imagePreview" class="w-full aspect-video object-cover rounded-2xl" />
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                            <input
                                id="image"
                                type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                @change="handleImageChange"
                                accept="image/*"
                            />
                            <div class="flex flex-col items-center text-white">
                                <Upload class="w-8 h-8 mb-2" />
                                <span class="text-xs font-bold uppercase tracking-widest">Cambiar Imagen</span>
                            </div>
                        </div>
                    </div>
                    
                    <InputError :message="form.errors.image" />
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-50">
                    <Button variant="ghost" as-child class="rounded-xl">
                        <Link href="/photos">Cancelar</Link>
                    </Button>
                    <Button type="submit" :disabled="form.processing" class="rounded-xl h-12 px-8 font-bold uppercase tracking-widest text-xs">
                        <Save class="w-4 h-4 mr-2" />
                        <span v-if="form.processing">Guardando...</span>
                        <span v-else>Actualizar Foto</span>
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
