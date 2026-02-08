<script setup lang="ts">
import { Calendar, Trophy, Mail, Info, ArrowRight, Medal } from 'lucide-vue-next';

const researchInfo = {
    deadline: "03 de Abril, 2026",
    prizes: [
        { place: "1er Lugar", amount: "S/ 3,500.00 + Reconocimiento", color: "text-yellow-500" },
        { place: "2do Lugar", amount: "S/ 2,500.00 + Reconocimiento", color: "text-slate-400" },
        { place: "3er Lugar", amount: "S/ 1,500.00 + Reconocimiento", color: "text-orange-400" }
    ],
    submissionEmail: "ctngubernamental@jdccpp.org.pe",
    rulesPdf: "/media/pdfs/reglamento-in estigacion.pdf"
};
</script>

<template>
    <section id="investigacion" class="py-24 bg-white overflow-hidden border-t border-gray-100">
        <div class="container mx-auto px-4 relative z-10">
            <!-- Background Decorative Text -->
            <span class="absolute top-0 right-0 text-[12rem] font-heading font-black text-slate-50 select-none pointer-events-none -mr-20 -mt-20 leading-none">SCIENCE</span>
            
            <!-- Full Width Title -->
            <div class="text-center mb-20 relative">
                <span class="text-brand-yellow font-black tracking-[0.3em] text-xs uppercase block mb-4 font-sans">Convocatoria Científica</span>
                <h2 class="text-4xl lg:text-6xl font-heading font-bold text-slate-900 uppercase leading-none tracking-tighter mb-6">
                    TRABAJOS DE <span class="text-primary">INVESTIGACIÓN</span>
                </h2>
                <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto"></div>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-center gap-16 lg:gap-24 max-w-7xl mx-auto">
                
                <!-- Left: Animated Image & Decorative Frame -->
                <div class="w-full lg:w-1/2 group flex justify-center relative">
                    <div class="absolute -inset-4 bg-primary/5 rounded-[3rem] -rotate-3 scale-95 group-hover:rotate-0 group-hover:scale-100 transition-all duration-700"></div>
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white max-w-md animate-float transition-all duration-500 group-hover:shadow-primary/20 group-hover:scale-[1.02]">
                        <img src="/media/imgs/banner1.png" alt="Convocatoria" class="w-full h-auto object-contain" />
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <!-- Small Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-slate-900 text-white p-6 rounded-3xl shadow-xl transform rotate-12 group-hover:rotate-0 transition-transform duration-500 hidden md:block">
                        <Trophy class="w-8 h-8 text-brand-yellow mb-2" />
                        <p class="text-[10px] font-black uppercase tracking-widest leading-tight">Excelencia<br>Académica</p>
                    </div>
                </div>

                <!-- Right: Information in a narrower layout -->
                <div class="w-full lg:w-5/12 flex flex-col gap-8">
                    
                    <!-- Deadline Box (Monumental Style) -->
                    <div class="relative group/deadline">
                        <div class="absolute -inset-2 bg-gradient-to-r from-primary to-brand-yellow opacity-20 blur-xl group-hover/deadline:opacity-40 transition-opacity"></div>
                        <div class="relative flex items-center gap-8 p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-primary shrink-0 border border-slate-100 group-hover/deadline:bg-primary group-hover/deadline:text-white transition-all duration-500">
                                <Calendar class="w-10 h-10" />
                            </div>
                            <div>
                                <h4 class="font-sans font-black text-slate-400 uppercase text-[10px] tracking-[0.2em] mb-2">Fecha Límite de Entrega</h4>
                                <p class="text-3xl lg:text-4xl font-heading font-black text-slate-950 uppercase leading-none tracking-tighter">{{ researchInfo.deadline }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Prizes List (Card Based) -->
                    <div class="bg-slate-50/50 p-8 rounded-[3rem] border border-slate-100">
                        <h4 class="font-heading font-bold text-slate-900 uppercase text-sm tracking-widest flex items-center gap-3 mb-8">
                            <div class="w-8 h-px bg-brand-yellow"></div>
                            Premios por Categoría
                        </h4>
                        <div class="space-y-4">
                            <div v-for="(prize, idx) in researchInfo.prizes" :key="idx" 
                                class="flex items-center justify-between p-5 bg-white border border-slate-100 rounded-2xl hover:border-primary/30 hover:shadow-lg hover:-translate-x-2 transition-all group/prize"
                            >
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover/prize:bg-primary/5 transition-colors">
                                        <Medal :class="['w-6 h-6', prize.color]" />
                                    </div>
                                    <span class="font-heading font-bold text-slate-900 text-lg uppercase">{{ prize.place }}</span>
                                </div>
                                <span class="font-sans font-black text-primary text-sm tracking-tight">{{ prize.amount }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submission Info (Clean & Action Oriented) -->
                    <div class="grid grid-cols-1 gap-4 pt-4">
                        <a :href="`mailto:${researchInfo.submissionEmail}`" class="flex items-center gap-6 p-6 rounded-3xl bg-slate-900 text-white hover:bg-primary transition-all duration-500 group/link shadow-lg">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white border border-white/10 group-hover/link:scale-110 transition-transform">
                                <Mail class="w-6 h-6" />
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] font-black text-white/40 uppercase font-sans tracking-[0.2em] mb-1">Enviar trabajos a:</p>
                                <p class="text-sm font-bold tracking-tight">{{ researchInfo.submissionEmail }}</p>
                            </div>
                        </a>
                        
                        <a :href="researchInfo.rulesPdf" target="_blank" class="flex items-center gap-6 p-6 rounded-3xl bg-white border-2 border-slate-100 hover:border-brand-yellow transition-all duration-500 group/rules shadow-sm hover:shadow-xl">
                            <div class="w-12 h-12 bg-brand-yellow/10 rounded-2xl flex items-center justify-center text-brand-yellow border border-brand-yellow/10 group-hover/rules:rotate-12 transition-transform">
                                <Info class="w-6 h-6" />
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] font-black text-slate-400 uppercase font-sans tracking-[0.2em] mb-1">Marco Académico:</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-bold text-slate-900">Ver bases completas (PDF)</p>
                                    <ArrowRight class="w-4 h-4 text-brand-yellow group-hover/rules:translate-x-2 transition-transform" />
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