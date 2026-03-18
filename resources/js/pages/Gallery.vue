<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    ChevronLeft,
    ChevronRight,
    Images,
    Maximize2,
    X,
} from 'lucide-vue-next';
import { computed, onMounted, onUnmounted, ref } from 'vue';

import LandingLayout from '@/layouts/LandingLayout.vue';

const props = defineProps<{
    photos: Array<{ id: number; title: string; path: string }>;
}>();

// Lightbox Logic
const selectedPhotoIndex = ref<number | null>(null);
const openLightbox = (index: number) => {
    selectedPhotoIndex.value = index;
    document.body.style.overflow = 'hidden';
};
const closeLightbox = () => {
    selectedPhotoIndex.value = null;
    document.body.style.overflow = 'auto';
};

// Pagination Logic
const currentPage = ref(1);
const perPage = 24; // Using 24 for a cleaner grid (divisible by 2, 3, 4)

const totalPages = computed(() => Math.ceil(props.photos.length / perPage));
const paginatedPhotos = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    return props.photos.slice(start, start + perPage);
});

const setPage = (page: number) => {
    currentPage.value = page;
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

// Navigation Logic
const nextPhoto = () => {
    if (selectedPhotoIndex.value !== null) {
        selectedPhotoIndex.value =
            (selectedPhotoIndex.value + 1) % props.photos.length;
    }
};
const prevPhoto = () => {
    if (selectedPhotoIndex.value !== null) {
        selectedPhotoIndex.value =
            (selectedPhotoIndex.value - 1 + props.photos.length) %
            props.photos.length;
    }
};

const handleKeydown = (e: KeyboardEvent) => {
    if (selectedPhotoIndex.value !== null) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextPhoto();
        if (e.key === 'ArrowLeft') prevPhoto();
    }
};

onMounted(() => window.addEventListener('keydown', handleKeydown));
onUnmounted(() => window.removeEventListener('keydown', handleKeydown));
</script>

<template>
    <Head title="Galería - Guber 2026" />

    <LandingLayout>
        <div class="relative min-h-screen overflow-hidden bg-white font-sans">
            <!-- Background Accents -->
            <div
                class="absolute top-0 right-0 z-0 -mt-64 -mr-64 h-[600px] w-[600px] rounded-full bg-primary/5 blur-[120px]"
            ></div>
            <div
                class="absolute bottom-0 left-0 z-0 -mb-32 -ml-32 h-[400px] w-[400px] rounded-full bg-brand-yellow/5 blur-[100px]"
            ></div>

            <!-- Enhanced Header Section with Background -->
            <section class="relative overflow-hidden pt-32 pb-32">
                <div class="absolute inset-0 z-0">
                    <div
                        class="absolute inset-0 bg-slate-900/5 backdrop-blur-[2px]"
                    ></div>
                    <img
                        v-if="photos.length > 0"
                        :src="photos[0].path"
                        class="h-full w-full object-cover opacity-10 grayscale"
                    />
                </div>

                <div class="relative z-10 container mx-auto px-6">
                    <div class="flex flex-col items-center text-center">
                        <Link
                            href="/"
                            class="group mb-16 flex items-center gap-2 rounded-full border border-slate-200 bg-white/50 px-4 py-1.5 text-slate-500 backdrop-blur-md transition-colors hover:text-primary"
                        >
                            <ArrowLeft
                                class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                            />
                            <span
                                class="text-[10px] font-black tracking-[0.3em] uppercase"
                                >Inicio</span
                            >
                        </Link>

                        <div
                            class="relative rounded-[4rem] border border-white bg-white/80 px-20 py-12 shadow-2xl shadow-slate-200/50 backdrop-blur-xl"
                        >
                            <span
                                class="absolute -top-6 left-1/2 -translate-x-1/2 rounded-full bg-primary px-6 py-2 text-[10px] font-black tracking-[0.4em] text-white uppercase shadow-lg"
                                >Archivo</span
                            >
                            <h1
                                class="font-heading text-6xl leading-none font-black tracking-tighter text-slate-900 uppercase lg:text-8xl"
                            >
                                Galería
                                <span class="text-primary italic">2026</span>
                            </h1>
                            <p
                                class="mt-6 font-sans text-[11px] font-black tracking-[0.6em] text-slate-400 uppercase"
                            >
                                Memoria Visual de la Convención
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Refined Grid (Larger thumbnails) -->
            <section class="relative z-10 -mt-12 pb-20">
                <div class="container mx-auto max-w-7xl px-6">
                    <div
                        v-if="paginatedPhotos.length > 0"
                        class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4"
                    >
                        <div
                            v-for="(photo, index) in paginatedPhotos"
                            :key="photo.id"
                            class="group relative aspect-[4/3] cursor-pointer overflow-hidden rounded-3xl border border-slate-100 bg-slate-50 transition-all duration-500 hover:z-20 hover:-translate-y-2 hover:shadow-2xl"
                            @click="
                                openLightbox(
                                    (currentPage - 1) * perPage + index,
                                )
                            "
                        >
                            <img
                                :src="photo.path"
                                :alt="photo.title"
                                class="h-full w-full object-cover transition-all duration-700 group-hover:scale-110"
                            />

                            <!-- Minimalist Hover -->
                            <div
                                class="absolute inset-0 flex flex-col justify-end bg-slate-900/40 p-6 opacity-0 transition-all duration-500 group-hover:opacity-100"
                            >
                                <p
                                    class="mb-2 translate-y-4 font-heading text-sm font-bold tracking-tight text-white uppercase transition-transform duration-500 group-hover:translate-y-0"
                                >
                                    {{ photo.title }}
                                </p>
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-full border border-white/30 bg-white/20 text-white backdrop-blur-md"
                                >
                                    <Maximize2 class="h-4 w-4" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div
                        v-else
                        class="flex flex-col items-center justify-center rounded-[3rem] border border-dashed border-slate-200 bg-slate-50/50 py-40"
                    >
                        <div
                            class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm"
                        >
                            <Images class="h-8 w-8 text-slate-200" />
                        </div>
                        <h3
                            class="text-xs font-black tracking-widest text-slate-400 uppercase"
                        >
                            Sin registros visuales
                        </h3>
                    </div>

                    <!-- Paginator -->
                    <div
                        v-if="totalPages > 1"
                        class="mt-20 flex items-center justify-center gap-2"
                    >
                        <button
                            @click="setPage(currentPage - 1)"
                            :disabled="currentPage === 1"
                            class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-100 bg-white text-slate-400 transition-all hover:border-primary hover:text-primary disabled:cursor-not-allowed disabled:opacity-20"
                        >
                            <ChevronLeft class="h-5 w-5" />
                        </button>

                        <div class="flex gap-2">
                            <button
                                v-for="page in totalPages"
                                :key="page"
                                @click="setPage(page)"
                                class="h-12 w-12 rounded-2xl border text-xs font-black transition-all"
                                :class="
                                    currentPage === page
                                        ? 'border-primary bg-primary text-white shadow-lg shadow-primary/20'
                                        : 'border-slate-100 bg-white text-slate-400 hover:border-primary hover:text-primary'
                                "
                            >
                                {{ page }}
                            </button>
                        </div>

                        <button
                            @click="setPage(currentPage + 1)"
                            :disabled="currentPage === totalPages"
                            class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-100 bg-white text-slate-400 transition-all hover:border-primary hover:text-primary disabled:cursor-not-allowed disabled:opacity-20"
                        >
                            <ChevronRight class="h-5 w-5" />
                        </button>
                    </div>
                </div>
            </section>

            <!-- Lightbox -->
            <Transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="selectedPhotoIndex !== null"
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8"
                >
                    <div
                        class="absolute inset-0 bg-slate-950/95 backdrop-blur-md"
                        @click="closeLightbox"
                    ></div>

                    <div
                        class="relative flex h-full w-full max-w-5xl flex-col items-center justify-center"
                    >
                        <button
                            @click="closeLightbox"
                            class="absolute top-0 right-0 z-50 rounded-full bg-white/10 p-3 text-white/50 backdrop-blur-md transition-colors hover:text-white"
                        >
                            <X class="h-6 w-6" />
                        </button>

                        <div
                            class="group/nav relative flex w-full flex-1 items-center justify-center"
                        >
                            <button
                                @click.stop="prevPhoto"
                                class="absolute left-0 z-10 rounded-full bg-white/5 p-4 text-white opacity-0 backdrop-blur-md transition-all group-hover/nav:opacity-100 hover:bg-white/20"
                            >
                                <ChevronLeft class="h-8 w-8" />
                            </button>

                            <img
                                :src="photos[selectedPhotoIndex].path"
                                :alt="photos[selectedPhotoIndex].title"
                                class="max-h-[80vh] max-w-full rounded-2xl object-contain shadow-2xl"
                            />

                            <button
                                @click.stop="nextPhoto"
                                class="absolute right-0 z-10 rounded-full bg-white/5 p-4 text-white opacity-0 backdrop-blur-md transition-all group-hover/nav:opacity-100 hover:bg-white/20"
                            >
                                <ChevronRight class="h-8 w-8" />
                            </button>
                        </div>

                        <div class="mt-8 text-center text-white">
                            <h3
                                class="mb-2 font-heading text-xl font-bold tracking-widest uppercase"
                            >
                                {{ photos[selectedPhotoIndex].title }}
                            </h3>
                            <p
                                class="text-[10px] font-black tracking-[0.4em] uppercase opacity-50"
                            >
                                {{ selectedPhotoIndex + 1 }} /
                                {{ photos.length }}
                            </p>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </LandingLayout>
</template>
