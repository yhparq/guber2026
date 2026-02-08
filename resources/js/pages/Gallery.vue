<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { ArrowLeft, Eye } from 'lucide-vue-next';

defineProps<{
    photos: Array<{ id: number, title: string, path: string }>;
}>();
</script>

<template>
    <Head title="Galería de Fotos - Guber 2026" />

    <LandingLayout>
        <!-- Hero Gallery Section -->
        <section class="py-24 bg-slate-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <img v-if="photos.length > 0" :src="photos[0].path" class="w-full h-full object-cover blur-sm" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 to-slate-900"></div>
            
            <div class="container mx-auto px-4 relative z-10 text-center">
                <Link href="/" class="inline-flex items-center gap-2 text-brand-yellow font-bold text-sm uppercase tracking-widest mb-12 hover:text-white transition-colors group">
                    <ArrowLeft class="w-4 h-4 group-hover:-translate-x-2 transition-transform" /> Volver al inicio
                </Link>
                <div class="mb-8">
                    <span class="text-brand-yellow font-black tracking-[0.3em] text-xs uppercase block mb-4 font-sans">Memorias Visuales</span>
                    <h1 class="text-4xl lg:text-7xl font-heading font-bold text-white mb-6 uppercase tracking-tighter">GALERÍA DE <span class="text-primary">FOTOS</span></h1>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                    <p class="text-xl text-slate-400 max-w-2xl mx-auto font-medium font-sans">
                        Un registro de los momentos más significativos de nuestra convención nacional.
                    </p>
                </div>
            </div>
        </section>

        <!-- Gallery Grid -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div v-if="photos && photos.length > 0" class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8">
                    <div v-for="photo in photos" :key="photo.id" 
                        class="break-inside-avoid group relative rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-slate-100 bg-white"
                    >
                        <img :src="photo.path" :alt="photo.title" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105" />
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                            <h3 class="text-white font-heading font-bold text-xl uppercase tracking-tight mb-2">{{ photo.title }}</h3>
                            <div class="flex items-center gap-2 text-brand-yellow text-[10px] font-black uppercase tracking-widest">
                                <Eye class="w-3 h-3" /> Ampliar imagen
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="py-40 text-center bg-slate-50 rounded-[4rem] border-2 border-dashed border-slate-200">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-sm mx-auto mb-8">
                            <Eye class="w-10 h-10 text-slate-200" />
                        </div>
                        <h3 class="text-2xl font-heading font-bold text-slate-900 uppercase mb-4">Aún no hay fotos</h3>
                        <p class="text-slate-500 font-sans mb-8">Estamos preparando el registro visual del evento. ¡Vuelve pronto!</p>
                        <Link href="/" class="bg-primary text-white px-8 py-4 rounded-2xl font-bold uppercase text-xs tracking-widest shadow-lg shadow-primary/20 hover:bg-slate-900 transition-all">
                            Ir al Inicio
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-primary relative overflow-hidden">
            <div class="container mx-auto px-4 relative z-10 text-center">
                <h2 class="text-3xl lg:text-5xl font-heading font-bold text-white mb-8 uppercase tracking-tighter">¿QUIERES SER PARTE DE LA PRÓXIMA GALERÍA?</h2>
                <Link href="/inscripciones" class="inline-flex items-center gap-4 bg-white text-primary px-10 py-5 rounded-full font-bold text-lg shadow-2xl hover:scale-105 transition-all font-sans">
                    INSRÍBETE AHORA <ArrowRight class="w-6 h-6" />
                </Link>
            </div>
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-yellow/20 rounded-full blur-3xl -ml-32 -mb-32"></div>
        </section>
    </LandingLayout>
</template>
