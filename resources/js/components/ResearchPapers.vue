<script setup lang="ts">
import { Calendar, Trophy, Mail, Info, ArrowRight, Medal } from 'lucide-vue-next';

const researchInfo = {
    deadline: "04 de Abril, 2026",
    prizes: [
        { place: "1er Lugar", amount: "S/ 3,500.00 + Reconocimiento", color: "text-yellow-500" },
        { place: "2do Lugar", amount: "S/ 2,500.00 + Reconocimiento", color: "text-slate-400" },
        { place: "3er Lugar", amount: "S/ 1,500.00 + Reconocimiento", color: "text-orange-400" }
    ],
    submissionEmail: "ctngubernamental@jdccpp.org.pe",
    rulesPdf: "/media/pdfs/reglamento_investigacion.pdf"
};
</script>

<template>
    <section id="investigacion" class="py-24 bg-white overflow-hidden border-t border-gray-100">
        <div class="container mx-auto px-4">
            <!-- Full Width Title -->
            <div class="text-center mb-16">
                <span class="text-brand-yellow font-black tracking-[0.2em] text-xs uppercase block mb-4 font-sans">Convocatoria Científica</span>
                <h2 class="text-4xl font-heading font-bold text-slate-900 uppercase leading-tight mb-6">
                    Presentación de Trabajos de <span class="text-primary">Investigación</span>
                </h2>
                <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto"></div>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-center gap-16 max-w-6xl mx-auto">
                
                <!-- Left: Animated Image -->
                <div class="w-full lg:w-1/2 group flex justify-center">
                    <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 max-w-md animate-float transition-all duration-500 group-hover:shadow-primary/20 group-hover:scale-[1.02]">
                        <img src="/media/imgs/banner1.png" alt="Convocatoria" class="w-full h-auto object-contain" />
                        <div class="absolute inset-0 bg-primary/5 group-hover:bg-transparent transition-colors"></div>
                    </div>
                </div>

                <!-- Right: Information in a narrower layout -->
                <div class="w-full lg:w-5/12 flex flex-col gap-10 max-w-sm">
                    
                    <!-- Deadline Box -->
                    <div class="flex items-center gap-6 p-6 bg-slate-50 rounded-3xl border border-slate-100">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-primary shrink-0 border border-slate-100">
                            <Calendar class="w-7 h-7" />
                        </div>
                        <div>
                            <h4 class="font-sans font-bold text-slate-500 uppercase text-[10px] tracking-[0.15em] mb-1">Fecha Límite de Entrega</h4>
                            <p class="text-2xl font-heading font-black text-slate-950 uppercase leading-none">{{ researchInfo.deadline }}</p>
                        </div>
                    </div>

                    <!-- Prizes List -->
                    <div class="space-y-4">
                        <h4 class="font-heading font-bold text-primary uppercase text-sm tracking-widest flex items-center gap-2 mb-4">
                            <Trophy class="w-5 h-5 text-brand-yellow" />
                            Premios por Categoría
                        </h4>
                        <div v-for="(prize, idx) in researchInfo.prizes" :key="idx" 
                            class="flex items-center justify-between p-5 bg-white border border-slate-100 rounded-2xl hover:border-primary/20 transition-all group"
                        >
                            <div class="flex items-center gap-4">
                                <Medal :class="['w-6 h-6', prize.color]" />
                                <span class="font-heading font-bold text-slate-900 text-base uppercase">{{ prize.place }}</span>
                            </div>
                            <span class="font-sans font-black text-primary text-sm">{{ prize.amount }}</span>
                        </div>
                    </div>

                    <!-- Submission Info -->
                    <div class="flex flex-col gap-6 pt-2">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary border border-primary/10">
                                <Mail class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase font-sans tracking-wider">Enviar trabajos a:</p>
                                <a :href="`mailto:${researchInfo.submissionEmail}`" class="text-base font-bold text-slate-900 hover:text-primary transition-colors underline decoration-primary/20 underline-offset-4">{{ researchInfo.submissionEmail }}</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-brand-yellow/10 rounded-2xl flex items-center justify-center text-brand-yellow border border-brand-yellow/10">
                                <Info class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase font-sans tracking-wider">Normativa:</p>
                                <a :href="researchInfo.rulesPdf" target="_blank" class="text-base font-bold text-slate-900 hover:text-brand-yellow transition-colors underline decoration-brand-yellow/20 underline-offset-4 flex items-center gap-2">
                                    Ver bases completas (PDF)
                                    <ArrowRight class="w-4 h-4" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.group:hover .animate-float {
    animation-play-state: paused;
}
</style>