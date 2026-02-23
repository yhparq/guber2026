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

// Lista real y completa de expositores según el documento
const speakers = [
    {
        name: "Mg. Abg. Cesar Enrique Aguilar Surichaqui",
        role: "Contralor General de la República",
        label: "Nacional",
        image: null // Foto pendiente
    },
    {
        name: "CPA. Agustina Llambi",
        role: "Directora del IPSASB - Canadá",
        label: "Internacional",
        image: "/media/ponentes/AGUSTINA LLAMBI.png"
    },
    {
        name: "Mg. Judith Tania Apaza Marca",
        role: "Miembro IPSASB/ IFAC - Bolivia",
        label: "Internacional",
        image: "/media/ponentes/JUDITH APAZA.png"
    },
    {
        name: "Dr. CPC. Marlon Ivan Prieto Hormaza",
        role: "Especialista Normativo de la Dirección General de Contabilidad Publica - MEF",
        label: "Nacional",
        image: "/media/ponentes/MARLON PRIETO.png"
    },
    {
        name: "Abog. Laura Lisset Gutiérrez Gonzales",
        role: "Past presidenta ejecutiva del OSCE",
        label: "Nacional",
        image: "/media/ponentes/LAURA GUTIERREZ.png"
    },
    {
        name: "CPC. Juan Francisco Aranibar Romero",
        role: "Presidente del Comité Técnico de Contabilidad Gubernamental JDCCPP",
        label: "Nacional",
        image: "/media/ponentes/JUAN ARANIBAR.png"
    },
    {
        name: "Dr. Alexei Estrella Morales",
        role: "Secretario Técnico del Comité Sector Público AIC - Ecuador",
        label: "Internacional",
        image: null // Foto pendiente
    },
    {
        name: "Mg. Jesús Ruitón Cabanillas",
        role: "Especialista en Proyectos de Inversión Pública",
        label: "Nacional",
        image: "/media/ponentes/JESUS RUITON.png"
    }
];
</script>

<template>
    <section id="speakers" class="py-24 bg-slate-50 border-t border-gray-100 overflow-hidden text-center">
        <div class="container mx-auto px-4">
            <div class="mb-16">
                <span class="text-brand-yellow font-black tracking-[0.3em] text-xs uppercase block mb-4 font-sans">Plana Académica</span>
                <h2 class="text-4xl lg:text-6xl font-heading font-bold text-slate-900 mb-6 uppercase tracking-tight">EXPOSITORES <span class="text-primary">DESTACADOS</span></h2>
                <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                <p class="text-lg font-sans text-gray-600 max-w-2xl mx-auto font-medium">Contamos con la presencia de reconocidos especialistas de trayectoria nacional e internacional.</p>
            </div>

            <!-- Carousel Container -->
            <div class="embla overflow-hidden" ref="emblaRef">
                <div class="flex -ml-6 py-10">
                    <!-- Slides -->
                    <div v-for="(speaker, index) in speakers" :key="index" class="flex-[0_0_85%] sm:flex-[0_0_50%] md:flex-[0_0_33%] lg:flex-[0_0_25%] min-w-0 pl-6 flex items-stretch">
                        <div class="group bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100 hover:shadow-2xl hover:-translate-y-4 transition-all duration-500 flex flex-col items-center relative w-full h-full">
                            
                            <!-- Avatar Container -->
                            <div class="relative mb-10 transform group-hover:scale-105 transition-transform duration-500 shrink-0">
                                <div class="w-40 h-40 lg:w-48 lg:h-48 rounded-[3.5rem] bg-slate-50 flex items-center justify-center border-8 border-white shadow-xl group-hover:border-primary/5 transition-all duration-500 overflow-hidden">
                                    <img v-if="speaker.image" :src="speaker.image" :alt="speaker.name" class="w-full h-full object-cover" />
                                    <User v-else class="w-20 h-20 text-slate-200 group-hover:text-primary/40 transition-colors duration-500" />
                                </div>
                                <div class="absolute -bottom-2 -right-2 bg-brand-yellow text-white p-3 rounded-2xl shadow-lg transform group-hover:rotate-12 transition-all duration-500">
                                    <Award class="w-5 h-5" />
                                </div>
                            </div>

                            <!-- Speaker Info -->
                            <div class="flex flex-col flex-1 w-full text-center">
                                <div class="min-h-[80px] flex items-center justify-center mb-2">
                                    <h3 class="text-lg lg:text-xl font-heading font-bold text-slate-900 uppercase leading-tight">{{ speaker.name }}</h3>
                                </div>
                                
                                <div class="min-h-[70px] flex items-center justify-center mb-8">
                                    <p class="text-primary font-bold text-[10px] lg:text-[11px] uppercase tracking-[0.2em] leading-relaxed">{{ speaker.role }}</p>
                                </div>
                                
                                <div class="mt-auto pt-6 border-t border-slate-50 w-full">
                                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-slate-50 rounded-full text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:bg-primary/5 group-hover:text-primary transition-colors duration-500">
                                        <MapPin class="w-3 h-3" />
                                        {{ speaker.label }}
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

<style scoped>
.embla {
    cursor: grab;
}
.embla:active {
    cursor: grabbing;
}
</style>