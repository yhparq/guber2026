<script setup lang="ts">
import {
    ArrowRight,
    Calendar,
    Info,
    Mail,
    Medal,
    Trophy,
} from 'lucide-vue-next';

const researchInfo = {
    deadline: '03 de Abril, 2026',
    prizes: [
        {
            place: '1er Lugar',
            amount: 'S/ 3,500.00 + Reconocimiento',
            color: 'text-yellow-500',
        },
        {
            place: '2do Lugar',
            amount: 'S/ 2,500.00 + Reconocimiento',
            color: 'text-slate-400',
        },
        {
            place: '3er Lugar',
            amount: 'S/ 1,500.00 + Reconocimiento',
            color: 'text-orange-400',
        },
    ],
    submissionEmail: 'ctngubernamental@jdccpp.org.pe',
    rulesPdf: '/media/pdfs/reglamento-in estigacion.pdf',
};
</script>

<template>
    <section
        id="investigacion"
        class="overflow-hidden border-t border-gray-100 bg-white py-24"
    >
        <div class="relative z-10 container mx-auto px-4">
            <!-- Background Decorative Text -->
            <span
                class="pointer-events-none absolute top-0 right-0 -mt-20 -mr-20 font-heading text-[12rem] leading-none font-black text-slate-50 select-none"
                >SCIENCE</span
            >

            <!-- Full Width Title -->
            <div class="relative mb-20 text-center">
                <span
                    class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                    >Convocatoria Científica</span
                >
                <h2
                    class="mb-6 font-heading text-4xl leading-none font-bold tracking-tighter text-slate-900 uppercase lg:text-6xl"
                >
                    TRABAJOS DE <span class="text-primary">INVESTIGACIÓN</span>
                </h2>
                <div
                    class="mx-auto h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                ></div>
            </div>

            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-center gap-16 lg:flex-row lg:gap-24"
            >
                <!-- Left: Animated Image & Decorative Frame -->
                <div class="group relative flex w-full justify-center lg:w-1/2">
                    <div
                        class="absolute -inset-4 scale-95 -rotate-3 rounded-[3rem] bg-primary/5 transition-all duration-700 group-hover:scale-100 group-hover:rotate-0"
                    ></div>
                    <div
                        class="animate-float relative max-w-md overflow-hidden rounded-[2.5rem] border-8 border-white shadow-2xl transition-all duration-500 group-hover:scale-[1.02] group-hover:shadow-primary/20"
                    >
                        <img
                            src="/media/imgs/banner1.png"
                            alt="Convocatoria"
                            class="h-auto w-full object-contain"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                        ></div>
                    </div>
                    <!-- Small Badge -->
                    <div
                        class="absolute -right-6 -bottom-6 hidden rotate-12 transform rounded-3xl bg-slate-900 p-6 text-white shadow-xl transition-transform duration-500 group-hover:rotate-0 md:block"
                    >
                        <Trophy class="mb-2 h-8 w-8 text-brand-yellow" />
                        <p
                            class="text-[10px] leading-tight font-black tracking-widest uppercase"
                        >
                            Excelencia<br />Académica
                        </p>
                    </div>
                </div>

                <!-- Right: Information in a narrower layout -->
                <div class="flex w-full flex-col gap-8 lg:w-5/12">
                    <!-- Deadline Box (Monumental Style) -->
                    <div class="group/deadline relative">
                        <div
                            class="absolute -inset-2 bg-gradient-to-r from-primary to-brand-yellow opacity-20 blur-xl transition-opacity group-hover/deadline:opacity-40"
                        ></div>
                        <div
                            class="relative flex items-center gap-8 rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl"
                        >
                            <div
                                class="flex h-20 w-20 shrink-0 items-center justify-center rounded-3xl border border-slate-100 bg-slate-50 text-primary transition-all duration-500 group-hover/deadline:bg-primary group-hover/deadline:text-white"
                            >
                                <Calendar class="h-10 w-10" />
                            </div>
                            <div>
                                <h4
                                    class="mb-2 font-sans text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                                >
                                    Fecha Límite de Entrega
                                </h4>
                                <p
                                    class="font-heading text-3xl leading-none font-black tracking-tighter text-slate-950 uppercase lg:text-4xl"
                                >
                                    {{ researchInfo.deadline }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Prizes List (Card Based) -->
                    <div
                        class="rounded-[3rem] border border-slate-100 bg-slate-50/50 p-8"
                    >
                        <h4
                            class="mb-8 flex items-center gap-3 font-heading text-sm font-bold tracking-widest text-slate-900 uppercase"
                        >
                            <div class="h-px w-8 bg-brand-yellow"></div>
                            Premios por Categoría
                        </h4>
                        <div class="space-y-4">
                            <div
                                v-for="(prize, idx) in researchInfo.prizes"
                                :key="idx"
                                class="group/prize flex items-center justify-between rounded-2xl border border-slate-100 bg-white p-5 transition-all hover:-translate-x-2 hover:border-primary/30 hover:shadow-lg"
                            >
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 transition-colors group-hover/prize:bg-primary/5"
                                    >
                                        <Medal
                                            :class="['h-6 w-6', prize.color]"
                                        />
                                    </div>
                                    <span
                                        class="font-heading text-lg font-bold text-slate-900 uppercase"
                                        >{{ prize.place }}</span
                                    >
                                </div>
                                <span
                                    class="font-sans text-sm font-black tracking-tight text-primary"
                                    >{{ prize.amount }}</span
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Submission Info (Clean & Action Oriented) -->
                    <div class="grid grid-cols-1 gap-4 pt-4">
                        <a
                            :href="`mailto:${researchInfo.submissionEmail}`"
                            class="group/link flex items-center gap-6 rounded-3xl bg-slate-900 p-6 text-white shadow-lg transition-all duration-500 hover:bg-primary"
                        >
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white transition-transform group-hover/link:scale-110"
                            >
                                <Mail class="h-6 w-6" />
                            </div>
                            <div class="text-left">
                                <p
                                    class="mb-1 font-sans text-[9px] font-black tracking-[0.2em] text-white/40 uppercase"
                                >
                                    Enviar trabajos a:
                                </p>
                                <p class="text-sm font-bold tracking-tight">
                                    {{ researchInfo.submissionEmail }}
                                </p>
                            </div>
                        </a>

                        <a
                            :href="researchInfo.rulesPdf"
                            target="_blank"
                            class="group/rules flex items-center gap-6 rounded-3xl border-2 border-slate-100 bg-white p-6 shadow-sm transition-all duration-500 hover:border-brand-yellow hover:shadow-xl"
                        >
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl border border-brand-yellow/10 bg-brand-yellow/10 text-brand-yellow transition-transform group-hover/rules:rotate-12"
                            >
                                <Info class="h-6 w-6" />
                            </div>
                            <div class="text-left">
                                <p
                                    class="mb-1 font-sans text-[9px] font-black tracking-[0.2em] text-slate-400 uppercase"
                                >
                                    Marco Académico:
                                </p>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-bold text-slate-900">
                                        Ver bases completas (PDF)
                                    </p>
                                    <ArrowRight
                                        class="h-4 w-4 text-brand-yellow transition-transform group-hover/rules:translate-x-2"
                                    />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
    100% {
        transform: translateY(0px);
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.group:hover .animate-float {
    animation-play-state: paused;
}
</style>
