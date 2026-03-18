<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

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
    hours.value = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
    );
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
    {
        label: 'Días',
        value: days,
        color: 'text-primary',
        bg: 'bg-primary/5',
        border: 'border-primary/20',
    },
    {
        label: 'Horas',
        value: hours,
        color: 'text-brand-yellow',
        bg: 'bg-brand-yellow/5',
        border: 'border-brand-yellow/20',
    },
    {
        label: 'Minutos',
        value: minutes,
        color: 'text-blue-600',
        bg: 'bg-blue-50',
        border: 'border-blue-100',
    },
];
</script>

<template>
    <section
        class="relative w-full overflow-hidden border-b border-gray-100 bg-white py-10"
    >
        <div class="relative z-10 container mx-auto px-4">
            <!-- Grid Layout -->
            <div
                class="grid w-full grid-cols-1 items-center gap-8 lg:grid-cols-[1fr_auto_1fr] lg:gap-16"
            >
                <!-- Left: Faltan -->
                <div class="order-1 text-center lg:text-right">
                    <span
                        class="font-heading text-3xl font-black tracking-[0.4em] text-primary uppercase lg:text-5xl"
                        >Faltan</span
                    >
                </div>

                <!-- Center: Clock (Multicolor) -->
                <div
                    class="order-2 flex items-center justify-center gap-3 md:gap-5"
                >
                    <div
                        v-for="unit in units"
                        :key="unit.label"
                        class="flex flex-col items-center"
                    >
                        <div
                            :class="[
                                'flex h-22 w-20 flex-col items-center justify-center rounded-[2rem] border shadow-sm transition-all duration-500 md:h-28 md:w-28',
                                unit.bg,
                                unit.border,
                            ]"
                        >
                            <span
                                :class="[
                                    'font-heading text-3xl leading-none font-black md:text-5xl',
                                    unit.color,
                                ]"
                            >
                                {{
                                    unit.value.value.toString().padStart(2, '0')
                                }}
                            </span>
                            <span
                                :class="[
                                    'mt-2 font-sans text-[8px] font-black tracking-[0.1em] uppercase opacity-70 md:text-[9px]',
                                    unit.color,
                                ]"
                                >{{ unit.label }}</span
                            >
                        </div>
                    </div>

                    <div
                        class="animate-pulse text-xl font-black text-slate-200 md:text-2xl"
                    >
                        :
                    </div>

                    <!-- Seconds (Dark Blue/Slate Style) -->
                    <div class="flex flex-col items-center">
                        <div
                            class="group relative flex h-22 w-20 flex-col items-center justify-center overflow-hidden rounded-[2rem] bg-slate-900 shadow-lg shadow-slate-900/20 transition-all duration-500 md:h-28 md:w-28"
                        >
                            <div
                                class="relative z-10 flex flex-col items-center"
                            >
                                <span
                                    class="font-heading text-3xl leading-none font-black text-white md:text-5xl"
                                >
                                    {{ seconds.toString().padStart(2, '0') }}
                                </span>
                                <span
                                    class="mt-2 font-sans text-[8px] font-black tracking-[0.1em] text-white/60 uppercase md:text-[9px]"
                                    >Segundos</span
                                >
                            </div>
                            <div
                                class="absolute inset-0 translate-y-full bg-blue-600/20 transition-transform duration-500 group-hover:translate-y-0"
                            ></div>
                        </div>
                    </div>
                </div>

                <!-- Right: Frase -->
                <div class="order-3 text-center lg:text-left">
                    <h2
                        class="font-heading text-xl leading-[0.9] font-black tracking-[0.1em] text-slate-900 uppercase lg:text-3xl"
                    >
                        PARA ESTE <br />
                        <span class="text-2xl text-brand-yellow lg:text-4xl"
                            >MAGNO EVENTO</span
                        >
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
