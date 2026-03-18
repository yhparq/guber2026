<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { Upload, X } from 'lucide-vue-next';
import { ref } from 'vue';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const form = useForm({
    title: '',
    image: null as File | null,
});

const imagePreview = ref<string | null>(null);

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

const removeImage = () => {
    form.image = null;
    imagePreview.value = null;
};

const submit = () => {
    form.post('/photos', {
        forceFormData: true,
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Fotos',
        href: '/photos',
    },
    {
        title: 'Nueva Foto',
        href: '/photos/create',
    },
];
</script>

<template>
    <Head title="Nueva Foto" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto max-w-2xl p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">
                    Subir Nueva Foto
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Sube una imagen para la galería del evento.
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
                        >Imagen</Label
                    >

                    <div v-if="!imagePreview" class="relative">
                        <input
                            id="image"
                            type="file"
                            class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                            @change="handleImageChange"
                            accept="image/*"
                        />
                        <div
                            class="flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-12 transition-colors hover:bg-slate-50"
                        >
                            <div
                                class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm"
                            >
                                <Upload class="h-8 w-8 text-primary" />
                            </div>
                            <p class="text-sm font-bold text-slate-900">
                                Haz clic para subir o arrastra una imagen
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                PNG, JPG, WebP hasta 5MB
                            </p>
                        </div>
                    </div>

                    <div
                        v-else
                        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-2"
                    >
                        <img
                            :src="imagePreview"
                            class="aspect-video w-full rounded-2xl object-cover"
                        />
                        <button
                            @click="removeImage"
                            type="button"
                            class="absolute top-4 right-4 rounded-xl bg-red-500 p-2 text-white shadow-lg transition-colors hover:bg-red-600"
                        >
                            <X class="h-5 w-5" />
                        </button>
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
                        <span v-if="form.processing">Subiendo...</span>
                        <span v-else>Guardar Foto</span>
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
