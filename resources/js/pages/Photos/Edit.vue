<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Save, Upload } from 'lucide-vue-next';
import { ref } from 'vue';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    photo: { id: number; title: string; path: string };
}>();

const form = useForm({
    title: props.photo.title,
    image: null as File | null,
    _method: 'POST', // We use POST for update with files
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
        <div class="mx-auto max-w-2xl p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Editar Foto</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Actualiza la descripción o la imagen de la galería.
                </p>
            </div>

            <form
                @submit.prevent="submit"
                class="space-y-8 rounded-[2rem] border border-slate-100 bg-white p-8 shadow-sm"
            >
                <div class="space-y-2">
                    <Label
                        for="title"
                        class="ml-1 text-xs font-bold tracking-widest text-slate-400 uppercase"
                        >Descripción / Título</Label
                    >
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
                    <Label
                        class="ml-1 text-xs font-bold tracking-widest text-slate-400 uppercase"
                        >Imagen (Dejar en blanco para mantener la actual)</Label
                    >

                    <div
                        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-2"
                    >
                        <img
                            :src="imagePreview"
                            class="aspect-video w-full rounded-2xl object-cover"
                        />

                        <div
                            class="absolute inset-0 flex cursor-pointer items-center justify-center bg-black/40 opacity-0 transition-opacity hover:opacity-100"
                        >
                            <input
                                id="image"
                                type="file"
                                class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                                @change="handleImageChange"
                                accept="image/*"
                            />
                            <div class="flex flex-col items-center text-white">
                                <Upload class="mb-2 h-8 w-8" />
                                <span
                                    class="text-xs font-bold tracking-widest uppercase"
                                    >Cambiar Imagen</span
                                >
                            </div>
                        </div>
                    </div>

                    <InputError :message="form.errors.image" />
                </div>

                <div
                    class="flex items-center justify-end gap-4 border-t border-slate-50 pt-4"
                >
                    <Button variant="ghost" as-child class="rounded-xl">
                        <Link href="/photos">Cancelar</Link>
                    </Button>
                    <Button
                        type="submit"
                        :disabled="form.processing"
                        class="h-12 rounded-xl px-8 text-xs font-bold tracking-widest uppercase"
                    >
                        <Save class="mr-2 h-4 w-4" />
                        <span v-if="form.processing">Guardando...</span>
                        <span v-else>Actualizar Foto</span>
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
