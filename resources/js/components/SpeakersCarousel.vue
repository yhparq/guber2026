<script setup lang="ts">
import emblaCarouselVue from 'embla-carousel-vue';
import Autoplay from 'embla-carousel-autoplay';
import { defineProps } from 'vue';

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

const speakers = [
    { 
        name: "Dr. Juan Perez", 
        role: "Contralor General", 
        country: "Perú",
        flag: "pe",
        image: "https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1000&auto=format&fit=crop" 
    },
    { 
        name: "Mg. Maria Rodriguez", 
        role: "Experta en Compliance", 
        country: "Colombia",
        flag: "co",
        image: "https://images.unsplash.com/photo-1573496359-70142d76c229?q=80&w=1000&auto=format&fit=crop" 
    },
    { 
        name: "Lic. Carlos Gomez", 
        role: "Auditor Forense", 
        country: "México",
        flag: "mx",
        image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=1000&auto=format&fit=crop" 
    },
    { 
        name: "Dra. Ana Silva", 
        role: "Gestión Pública", 
        country: "Chile",
        flag: "cl",
        image: "https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1000&auto=format&fit=crop" 
    },
    { 
        name: "Mg. Roberto Mendez", 
        role: "Consultor NICSP", 
        country: "Ecuador",
        flag: "ec",
        image: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=1000&auto=format&fit=crop" 
    }
];
</script>

<template>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-black uppercase tracking-tight">Expositores Destacados</h2>
                <div class="w-24 h-1.5 bg-primary rounded-full mx-auto mt-4"></div>
                <p class="text-black mt-4 font-sans text-sm">Expertos nacionales e internacionales</p>
            </div>

            <!-- Carousel Container -->
            <div class="overflow-hidden" ref="emblaRef">
                <div class="flex -ml-4 py-4">
                    <!-- Slides -->
                    <div v-for="(speaker, index) in speakers" :key="index" class="flex-[0_0_50%] md:flex-[0_0_33.333%] lg:flex-[0_0_25%] min-w-0 pl-4">
                        <div class="group relative overflow-hidden rounded-xl shadow-lg aspect-[3/4] border border-gray-100 hover:shadow-2xl transition-all duration-300">
                            <!-- Speaker Image -->
                            <img :src="speaker.image" :alt="speaker.name" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            
                            <!-- Flag (Top Right) -->
                            <div class="absolute top-3 right-3 z-20 shadow-md rounded overflow-hidden w-8 h-auto border border-white/50">
                                <img :src="`https://flagcdn.com/w80/${speaker.flag}.png`" :alt="speaker.country" class="w-full h-full object-cover" />
                            </div>

                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-90 transition-opacity"></div>
                            
                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 p-4 text-white w-full z-10 translate-y-1 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="w-8 h-0.5 bg-brand-yellow mb-2"></div>
                                <h3 class="text-xl font-heading font-bold mb-0.5 leading-tight">{{ speaker.name }}</h3>
                                <p class="text-[10px] text-white/90 font-medium uppercase tracking-wider font-sans leading-tight">{{ speaker.role }}</p>
                                <p class="text-[9px] text-brand-yellow mt-1 font-bold">{{ speaker.country }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Optional: smoother grab cursor for carousel */
.embla {
    cursor: grab;
}
.embla:active {
    cursor: grabbing;
}
</style>