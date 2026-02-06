<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const targetDate = new Date('2026-04-23T09:00:00').getTime();

const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

let timer: any = null;

const updateCountdown = () => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) {
        if (timer) clearInterval(timer);
        return;
    }

    days.value = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours.value = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes.value = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds.value = Math.floor((distance % (1000 * 60)) / 1000);
};

onMounted(() => {
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
});

const units = [
    { label: 'Días', value: days, color: 'text-primary', bg: 'bg-primary/5', border: 'border-primary/20' },
    { label: 'Horas', value: hours, color: 'text-brand-yellow', bg: 'bg-brand-yellow/5', border: 'border-brand-yellow/20' },
    { label: 'Minutos', value: minutes, color: 'text-blue-600', bg: 'bg-blue-50', border: 'border-blue-100' }
];
</script>

<template>
    <section class="w-full bg-white py-10 border-b border-gray-100 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center gap-8 lg:gap-16 w-full">
                
                <!-- Left: Faltan -->
                <div class="text-center lg:text-right order-1">
                    <span class="text-primary font-heading font-black uppercase tracking-[0.4em] text-3xl lg:text-5xl">Faltan</span>
                </div>

                <!-- Center: Clock (Multicolor) -->
                <div class="flex items-center justify-center gap-3 md:gap-5 order-2">
                    
                    <div v-for="unit in units" :key="unit.label" class="flex flex-col items-center">
                        <div :class="['w-20 h-22 md:w-28 md:h-28 rounded-[2rem] border flex flex-col items-center justify-center shadow-sm transition-all duration-500', unit.bg, unit.border]">
                            <span :class="['text-3xl md:text-5xl font-heading font-black leading-none', unit.color]">
                                {{ unit.value.value.toString().padStart(2, '0') }}
                            </span>
                            <span :class="['text-[8px] md:text-[9px] font-sans font-black uppercase tracking-[0.1em] mt-2 opacity-70', unit.color]">{{ unit.label }}</span>
                        </div>
                    </div>

                    <div class="text-xl md:text-2xl font-black text-slate-200 animate-pulse">:</div>

                    <!-- Seconds (Dark Blue/Slate Style) -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-22 md:w-28 md:h-28 bg-slate-900 rounded-[2rem] shadow-lg shadow-slate-900/20 flex flex-col items-center justify-center transition-all duration-500 relative overflow-hidden group">
                            <div class="relative z-10 flex flex-col items-center">
                                <span class="text-3xl md:text-5xl font-heading font-black text-white leading-none">
                                    {{ seconds.toString().padStart(2, '0') }}
                                </span>
                                <span class="text-[8px] md:text-[9px] font-sans font-black text-white/60 uppercase tracking-[0.1em] mt-2">Segundos</span>
                            </div>
                            <div class="absolute inset-0 bg-blue-600/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        </div>
                    </div>
                </div>

                <!-- Right: Frase -->
                <div class="text-center lg:text-left order-3">
                    <h2 class="text-xl lg:text-3xl font-heading font-black text-slate-900 uppercase tracking-[0.1em] leading-[0.9]">
                        PARA ESTE <br> 
                        <span class="text-brand-yellow text-2xl lg:text-4xl">MAGNO EVENTO</span>
                    </h2>
                </div>

            </div>
        </div>
    </section>
</template>

<style scoped>
.font-heading {
    font-family: 'Oswald', sans-serif;
}
.font-sans {
    font-family: 'Montserrat', sans-serif;
}
</style>