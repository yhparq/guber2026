<script setup lang="ts">
import emblaCarouselVue from 'embla-carousel-vue';
import Autoplay from 'embla-carousel-autoplay';
import { User, Award, MapPin } from 'lucide-vue-next';

const [emblaRef] = emblaCarouselVue(
    { 
        loop: true, 
        align: 'start',
        slidesToScroll: 1,
        breakpoints: {
            '(min-width: 640px)': { slidesToScroll: 2 },
            '(min-width: 768px)': { slidesToScroll: 3 },
            '(min-width: 1024px)': { slidesToScroll: 4 }
        }
    }, 
    [Autoplay({ delay: 4000, stopOnInteraction: false })]
);

// Lista genérica de 12 espacios para expositores
const speakers = Array.from({ length: 12 }, (_, i) => ({
    name: "EXPOSITOR GUBER 2026",
    role: "ESPECIALISTA INVITADO",
    label: "Por confirmar"
}));
</script>

<template>
    <section id="speakers" class="py-24 bg-slate-50 border-t border-gray-100 overflow-hidden text-center">
        <div class="container mx-auto px-4">
            <div class="mb-16">
                <h2 class="text-4xl font-heading font-bold text-black uppercase">EXPOSITORES DESTACADOS</h2>
                <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                <p class="text-lg font-sans text-gray-600 max-w-2xl mx-auto font-medium">Contamos con la presencia de reconocidos especialistas de trayectoria nacional e internacional.</p>
            </div>

            <!-- Carousel Container -->
            <div class="embla overflow-hidden" ref="emblaRef">
                <div class="flex -ml-6 py-10">
                    <!-- Slides -->
                    <div v-for="(speaker, index) in speakers" :key="index" class="flex-[0_0_85%] sm:flex-[0_0_50%] md:flex-[0_0_33%] lg:flex-[0_0_25%] min-w-0 pl-6">
                        <div class="group bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100 hover:shadow-2xl hover:-translate-y-4 transition-all duration-500 flex flex-col items-center relative min-h-[450px]">
                            
                            <!-- Avatar Container -->
                            <div class="relative mb-12 transform group-hover:scale-105 transition-transform duration-500">
                                <div class="w-48 h-48 rounded-[3.5rem] bg-slate-50 flex items-center justify-center border-8 border-white shadow-xl group-hover:border-primary/5 transition-all duration-500 overflow-hidden">
                                    <User class="w-24 h-24 text-slate-200 group-hover:text-primary/40 transition-colors duration-500" />
                                </div>
                                <div class="absolute -bottom-2 -right-2 bg-brand-yellow text-white p-3 rounded-2xl shadow-lg transform group-hover:rotate-12 transition-all duration-500">
                                    <Award class="w-6 h-6" />
                                </div>
                            </div>

                            <!-- Speaker Info (Generic) -->
                            <div class="mt-auto w-full">
                                <h3 class="text-2xl font-heading font-bold text-slate-900 mb-2 uppercase leading-tight">{{ speaker.name }}</h3>
                                <p class="text-primary font-bold text-xs uppercase tracking-[0.25em] mb-6">{{ speaker.role }}</p>
                                
                                <div class="pt-6 border-t border-slate-50 w-full">
                                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-slate-50 rounded-full text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:bg-primary/5 group-hover:text-primary transition-colors duration-500">
                                        <MapPin class="w-3 h-3" />
                                        NACIONAL / INTERNACIONAL
                                    </span>
                                </div>
                            </div>

                            <!-- Subtle background decoration -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[6rem] -z-10 group-hover:bg-primary/10 transition-colors duration-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.embla {
    cursor: grab;
}
.embla:active {
    cursor: grabbing;
}
</style>