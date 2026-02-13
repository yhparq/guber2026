<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { ArrowLeft, Maximize2, X, ChevronLeft, ChevronRight, Images } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps<{
    photos: Array<{ id: number, title: string, path: string }>;
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
        selectedPhotoIndex.value = (selectedPhotoIndex.value + 1) % props.photos.length;
    }
};
const prevPhoto = () => {
    if (selectedPhotoIndex.value !== null) {
        selectedPhotoIndex.value = (selectedPhotoIndex.value - 1 + props.photos.length) % props.photos.length;
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
        <div class="bg-white min-h-screen relative overflow-hidden font-sans">
            <!-- Background Accents -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/5 rounded-full blur-[120px] -mr-64 -mt-64 z-0"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-yellow/5 rounded-full blur-[100px] -ml-32 -mb-32 z-0"></div>

            <!-- Enhanced Header Section with Background -->
            <section class="relative pt-32 pb-32 overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-slate-900/5 backdrop-blur-[2px]"></div>
                    <img v-if="photos.length > 0" :src="photos[0].path" class="w-full h-full object-cover opacity-10 grayscale" />
                </div>
                
                <div class="container mx-auto px-6 relative z-10">
                    <div class="flex flex-col items-center text-center">
                        <Link href="/" class="group flex items-center gap-2 text-slate-500 hover:text-primary transition-colors mb-16 bg-white/50 backdrop-blur-md px-4 py-1.5 rounded-full border border-slate-200">
                            <ArrowLeft class="w-4 h-4 group-hover:-translate-x-1 transition-transform" />
                            <span class="text-[10px] font-black uppercase tracking-[0.3em]">Inicio</span>
                        </Link>
                        
                        <div class="relative py-12 px-20 bg-white/80 backdrop-blur-xl rounded-[4rem] border border-white shadow-2xl shadow-slate-200/50">
                            <span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-primary text-white text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-[0.4em] shadow-lg">Archivo</span>
                            <h1 class="text-6xl lg:text-8xl font-heading font-black text-slate-900 uppercase tracking-tighter leading-none">
                                Galería <span class="text-primary italic">2026</span>
                            </h1>
                            <p class="mt-6 text-slate-400 font-sans text-[11px] uppercase tracking-[0.6em] font-black">Memoria Visual de la Convención</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Refined Grid (Larger thumbnails) -->
            <section class="pb-20 relative z-10 -mt-12">
                <div class="container mx-auto px-6 max-w-7xl">
                    <div v-if="paginatedPhotos.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div v-for="(photo, index) in paginatedPhotos" :key="photo.id" 
                            class="relative aspect-[4/3] group cursor-pointer overflow-hidden rounded-3xl bg-slate-50 border border-slate-100 transition-all duration-500 hover:shadow-2xl hover:z-20 hover:-translate-y-2"
                            @click="openLightbox((currentPage - 1) * perPage + index)"
                        >
                            <img :src="photo.path" :alt="photo.title" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110" />
                            
                            <!-- Minimalist Hover -->
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                <p class="text-white font-heading font-bold text-sm uppercase tracking-tight mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ photo.title }}</p>
                                <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/30">
                                    <Maximize2 class="w-4 h-4" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="flex flex-col items-center justify-center py-40 bg-slate-50/50 rounded-[3rem] border border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6">
                            <Images class="w-8 h-8 text-slate-200" />
                        </div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-slate-400">Sin registros visuales</h3>
                    </div>

                    <!-- Paginator -->
                    <div v-if="totalPages > 1" class="mt-20 flex justify-center items-center gap-2">
                        <button 
                            @click="setPage(currentPage - 1)" 
                            :disabled="currentPage === 1"
                            class="w-12 h-12 rounded-2xl flex items-center justify-center border border-slate-100 bg-white text-slate-400 hover:text-primary hover:border-primary transition-all disabled:opacity-20 disabled:cursor-not-allowed"
                        >
                            <ChevronLeft class="w-5 h-5" />
                        </button>
                        
                        <div class="flex gap-2">
                            <button 
                                v-for="page in totalPages" 
                                :key="page"
                                @click="setPage(page)"
                                class="w-12 h-12 rounded-2xl font-black text-xs transition-all border"
                                :class="currentPage === page 
                                    ? 'bg-primary text-white border-primary shadow-lg shadow-primary/20' 
                                    : 'bg-white text-slate-400 border-slate-100 hover:border-primary hover:text-primary'"
                            >
                                {{ page }}
                            </button>
                        </div>

                        <button 
                            @click="setPage(currentPage + 1)" 
                            :disabled="currentPage === totalPages"
                            class="w-12 h-12 rounded-2xl flex items-center justify-center border border-slate-100 bg-white text-slate-400 hover:text-primary hover:border-primary transition-all disabled:opacity-20 disabled:cursor-not-allowed"
                        >
                            <ChevronRight class="w-5 h-5" />
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
                <div v-if="selectedPhotoIndex !== null" class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8">
                    <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-md" @click="closeLightbox"></div>
                    
                    <div class="relative w-full max-w-5xl h-full flex flex-col items-center justify-center">
                        <button @click="closeLightbox" class="absolute top-0 right-0 text-white/50 hover:text-white transition-colors bg-white/10 p-3 rounded-full backdrop-blur-md z-50">
                            <X class="w-6 h-6" />
                        </button>

                        <div class="relative w-full flex-1 flex items-center justify-center group/nav">
                            <button @click.stop="prevPhoto" class="absolute left-0 z-10 p-4 bg-white/5 hover:bg-white/20 text-white rounded-full backdrop-blur-md transition-all opacity-0 group-hover/nav:opacity-100">
                                <ChevronLeft class="w-8 h-8" />
                            </button>
                            
                            <img :src="photos[selectedPhotoIndex].path" :alt="photos[selectedPhotoIndex].title" 
                                class="max-w-full max-h-[80vh] object-contain shadow-2xl rounded-2xl" 
                            />

                            <button @click.stop="nextPhoto" class="absolute right-0 z-10 p-4 bg-white/5 hover:bg-white/20 text-white rounded-full backdrop-blur-md transition-all opacity-0 group-hover/nav:opacity-100">
                                <ChevronRight class="w-8 h-8" />
                            </button>
                        </div>

                        <div class="mt-8 text-center text-white">
                            <h3 class="font-heading font-bold text-xl uppercase tracking-widest mb-2">{{ photos[selectedPhotoIndex].title }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.4em] opacity-50">{{ selectedPhotoIndex + 1 }} / {{ photos.length }}</p>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </LandingLayout>
</template>
