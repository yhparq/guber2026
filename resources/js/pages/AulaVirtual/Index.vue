<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { 
    LogOut, 
    User, 
    Calendar, 
    Clock, 
    Video, 
    FileText, 
    Menu, 
    X,
    Play,
    Circle,
    ArrowRight
} from 'lucide-vue-next';
import { ref, computed } from 'vue';
import * as aulaVirtual from '@/routes/aula-virtual';

const props = defineProps<{
    participant: any;
    ponencias: any[];
}>();

const selectedDay = ref(1);
const isMobileMenuOpen = ref(false);

const logout = () => {
    router.post(aulaVirtual.logout().url);
};

const filteredPonencias = computed(() => {
    return props.ponencias
        .filter(p => p.dia === selectedDay.value)
        .sort((a, b) => a.hora_inicio.localeCompare(b.hora_inicio));
});

const eventDays = [
    { id: 1, label: 'Día 01', date: 'Jueves 23', status: 'Finalizado' },
    { id: 2, label: 'Día 02', date: 'Viernes 24', status: 'En Vivo' },
    { id: 3, label: 'Día 03', date: 'Sábado 25', status: 'Próximamente' },
];

const selectDay = (dayId: number) => {
    selectedDay.value = dayId;
    isMobileMenuOpen.value = false;
};
</script>

<template>
    <Head title="Aula Virtual - GUBER 2026" />

    <div class="flex h-screen bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">
        <!-- Sidebar Premium -->
        <aside class="hidden lg:flex flex-col w-72 bg-slate-900 text-white shrink-0 relative overflow-hidden">
            <!-- Decorative background glow -->
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-primary/20 rounded-full blur-[80px]"></div>
            
            <div class="p-8 relative z-10">
                <div class="flex items-center gap-3 mb-10">
                    <div class="bg-white p-2 rounded-2xl shadow-xl shadow-black/20">
                        <img src="/media/imgs/logo1.png" alt="Logo" class="h-8 w-auto" />
                    </div>
                    <div>
                        <div class="font-heading font-black tracking-tighter text-xl leading-none">GUBER <span class="text-brand-yellow">2026</span></div>
                        <div class="text-[9px] font-bold text-white/40 uppercase tracking-[0.2em] mt-1">Plataforma Académica</div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <div class="text-[10px] font-black text-white/20 uppercase tracking-[0.3em] mb-6 px-2">Cronograma Oficial</div>
                    
                    <button 
                        v-for="day in eventDays" 
                        :key="day.id"
                        @click="selectDay(day.id)"
                        class="w-full group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-500 overflow-hidden"
                        :class="selectedDay === day.id 
                            ? 'bg-white/10 text-white shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]' 
                            : 'text-white/40 hover:text-white'"
                    >
                        <!-- Active indicator -->
                        <div v-if="selectedDay === day.id" class="absolute left-0 top-0 bottom-0 w-1 bg-brand-yellow"></div>
                        
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-500"
                            :class="selectedDay === day.id ? 'bg-primary text-white scale-110 shadow-lg shadow-primary/40' : 'bg-white/5 text-white/20 group-hover:bg-white/10'"
                        >
                            <Calendar class="w-5 h-5" />
                        </div>
                        <div class="text-left flex-1">
                            <p class="font-bold text-sm leading-none mb-1">{{ day.label }}</p>
                            <p class="text-[10px] opacity-50">{{ day.date }} de Abril</p>
                        </div>
                        <ArrowRight v-if="selectedDay === day.id" class="w-4 h-4 text-brand-yellow animate-pulse" />
                    </button>
                </nav>
            </div>

            <!-- User Card at Bottom -->
            <div class="mt-auto p-6 relative z-10">
                <div class="bg-white/5 rounded-[2rem] p-5 border border-white/5 backdrop-blur-md">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-purple-400 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                {{ participant.nombres[0] }}
                            </div>
                            <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-500 border-2 border-slate-900 rounded-full"></div>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-black truncate leading-none text-white uppercase">{{ participant.nombres }}</p>
                            <p class="text-[9px] text-white/30 truncate mt-1 tracking-wider">{{ participant.dni }}</p>
                        </div>
                    </div>
                    <button @click="logout" class="w-full flex items-center justify-center gap-2 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-red-400 hover:text-white hover:bg-red-500/20 rounded-xl transition-all border border-red-500/10">
                        <LogOut class="w-3 h-3" /> Cerrar Sesión
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-full overflow-hidden">
            <!-- Header Mobile -->
            <header class="lg:hidden h-16 bg-slate-900 flex items-center justify-between px-6 text-white shadow-xl relative z-30">
                <div class="flex items-center gap-2">
                    <img src="/media/imgs/logo1.png" alt="Logo" class="h-7 w-auto bg-white p-1 rounded-lg" />
                    <span class="font-black text-sm uppercase tracking-tighter">Guber <span class="text-brand-yellow">2026</span></span>
                </div>
                <button @click="isMobileMenuOpen = true" class="p-2.5 bg-white/10 rounded-xl text-brand-yellow">
                    <Menu class="w-6 h-6" />
                </button>
            </header>

            <!-- Content Title Area -->
            <div class="px-8 lg:px-12 py-8 bg-white border-b border-slate-200 flex items-center justify-between shrink-0 relative z-20">
                <div>
                    <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">
                        <span>Aula Virtual</span>
                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                        <span class="text-primary">{{ eventDays.find(d => d.id === selectedDay)?.label }}</span>
                    </nav>
                    <h1 class="text-2xl lg:text-3xl font-heading font-black text-slate-900 uppercase tracking-tight">
                        Cronograma <span class="text-primary">{{ eventDays.find(d => d.id === selectedDay)?.date }}</span>
                    </h1>
                </div>
                
                <div class="hidden md:flex items-center gap-4 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                    <div class="flex -space-x-2">
                        <div v-for="i in 3" :key="i" class="w-8 h-8 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500">
                            +
                        </div>
                    </div>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest mr-2">Participantes Conectados</span>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="flex-1 overflow-y-auto bg-[#F8FAFC]">
                <div class="max-w-5xl mx-auto px-8 lg:px-12 py-12">
                    <div v-if="filteredPonencias.length === 0" class="flex flex-col items-center justify-center py-32 bg-white rounded-[3rem] border border-slate-200 shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                            <Clock class="w-10 h-10" />
                        </div>
                        <h3 class="text-lg font-black text-slate-400 uppercase tracking-widest">Sin actividad programada</h3>
                        <p class="text-slate-300 text-sm mt-2 font-medium">Las ponencias para este día aparecerán pronto.</p>
                    </div>

                    <div v-else class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-[27px] top-0 bottom-0 w-0.5 bg-gradient-to-b from-primary/30 via-slate-200 to-transparent hidden md:block"></div>

                        <div class="space-y-8">
                            <div v-for="(ponencia, index) in filteredPonencias" :key="ponencia.id" 
                                class="relative group md:pl-16"
                            >
                                <!-- Timeline Point -->
                                <div class="absolute left-0 top-8 w-14 h-14 bg-[#F8FAFC] hidden md:flex items-center justify-center z-10">
                                    <div class="w-4 h-4 rounded-full bg-white border-4 border-primary shadow-[0_0_0_4px_rgba(116,34,132,0.1)] group-hover:scale-125 transition-transform duration-500"></div>
                                </div>

                                <!-- Card Premium -->
                                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-8px_rgba(0,0,0,0.1)] hover:border-primary/20 transition-all duration-500 overflow-hidden flex flex-col md:flex-row">
                                    
                                    <!-- Time Column Sidebarish -->
                                    <div class="md:w-40 bg-slate-50/50 md:border-r border-slate-100 p-8 flex flex-row md:flex-col items-center justify-between md:justify-center gap-4">
                                        <div class="text-center">
                                            <div class="text-xs font-black text-primary uppercase tracking-widest mb-1">{{ ponencia.hora_inicio.substring(0, 5) }}</div>
                                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Hora Inicio</div>
                                        </div>
                                        <div class="hidden md:block w-8 h-px bg-slate-200"></div>
                                        <div class="text-center">
                                            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">{{ ponencia.hora_fin.substring(0, 5) }}</div>
                                            <div class="text-[10px] font-bold text-slate-300 uppercase tracking-tighter">Término</div>
                                        </div>
                                    </div>

                                    <!-- Content Body -->
                                    <div class="flex-1 p-8 lg:p-10 relative">
                                        <!-- Category Tag Decor -->
                                        <div class="absolute top-8 right-8 hidden sm:block">
                                            <div class="flex items-center gap-2 px-3 py-1 bg-primary/5 rounded-full border border-primary/10">
                                                <Circle class="w-1.5 h-1.5 fill-primary text-primary" />
                                                <span class="text-[9px] font-black text-primary uppercase tracking-widest">Ponencia Magistral</span>
                                            </div>
                                        </div>

                                        <h3 class="text-xl lg:text-2xl font-heading font-black text-slate-900 mb-4 leading-tight uppercase tracking-tight group-hover:text-primary transition-colors">
                                            {{ ponencia.titulo }}
                                        </h3>

                                        <div class="flex items-center gap-4 mb-6">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-xl bg-brand-yellow/10 flex items-center justify-center text-brand-yellow border border-brand-yellow/20">
                                                    <User class="w-4 h-4" />
                                                </div>
                                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Dr(a). {{ ponencia.ponente }}</span>
                                            </div>
                                        </div>
                                        
                                        <p v-if="ponencia.descripcion" class="text-slate-500 text-sm leading-relaxed mb-8 border-l-2 border-slate-100 pl-4">
                                            {{ ponencia.descripcion }}
                                        </p>

                                        <!-- Luxury Actions -->
                                        <div class="flex flex-wrap gap-4 items-center">
                                            <a v-if="ponencia.link_video" :href="ponencia.link_video" target="_blank" 
                                                class="flex items-center gap-3 px-6 py-3.5 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-primary hover:shadow-xl hover:shadow-primary/30 transition-all duration-500 group/btn"
                                            >
                                                <Play class="w-4 h-4 fill-brand-yellow text-brand-yellow group-hover/btn:scale-110 transition-transform" /> 
                                                Ver Sesión
                                            </a>
                                            <a v-if="ponencia.archivo_material" :href="`/storage/${ponencia.archivo_material}`" target="_blank" 
                                                class="flex items-center gap-3 px-6 py-3.5 bg-white text-slate-900 border-2 border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:border-primary hover:text-primary transition-all duration-500"
                                            >
                                                <FileText class="w-4 h-4 text-primary" /> 
                                                Descargar PDF
                                            </a>
                                            <a v-else-if="ponencia.link_material" :href="ponencia.link_material" target="_blank" 
                                                class="flex items-center gap-3 px-6 py-3.5 bg-white text-slate-900 border-2 border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:border-primary hover:text-primary transition-all duration-500"
                                            >
                                                <FileText class="w-4 h-4 text-primary" /> 
                                                Recursos Externos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Mobile Sidebar (Luxury Theme) -->
        <transition
            enter-active-class="transition duration-500 ease-out"
            enter-from-class="translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition duration-400 ease-in"
            leave-from-class="translate-x-0"
            leave-to-class="translate-x-full"
        >
            <div v-if="isMobileMenuOpen" class="fixed inset-0 z-50 lg:hidden flex">
                <div class="flex-1 bg-slate-900/60 backdrop-blur-sm" @click="isMobileMenuOpen = false"></div>
                <div class="w-80 bg-slate-900 p-8 shadow-2xl relative">
                    <button @click="isMobileMenuOpen = false" class="absolute top-6 right-6 p-2 text-white/30 hover:text-white">
                        <X class="w-6 h-6" />
                    </button>

                    <div class="mb-12">
                        <img src="/media/imgs/logo1.png" alt="Logo" class="h-10 w-auto bg-white p-1.5 rounded-xl mb-4" />
                        <div class="font-black text-white text-lg uppercase tracking-widest">Cronograma</div>
                    </div>

                    <div class="space-y-4">
                        <button 
                            v-for="day in eventDays" 
                            :key="day.id"
                            @click="selectDay(day.id)"
                            class="w-full flex items-center justify-between px-6 py-5 rounded-[2rem] transition-all border"
                            :class="selectedDay === day.id ? 'bg-primary border-primary shadow-lg shadow-primary/20 text-white' : 'bg-white/5 border-transparent text-white/40'"
                        >
                            <div class="text-left">
                                <p class="font-black text-sm uppercase tracking-widest">{{ day.label }}</p>
                                <p class="text-[10px] opacity-50">{{ day.date }} de Abril</p>
                            </div>
                            <Calendar class="w-5 h-5 opacity-30" />
                        </button>
                    </div>

                    <div class="absolute bottom-10 left-8 right-8">
                        <div class="bg-white/5 p-6 rounded-[2rem] border border-white/5">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center font-bold">{{ participant.nombres[0] }}</div>
                                <div class="min-w-0">
                                    <p class="text-white font-black text-[10px] uppercase truncate">{{ participant.nombres }}</p>
                                    <p class="text-white/20 text-[9px] truncate tracking-widest mt-1">PARTICIPANTE</p>
                                </div>
                            </div>
                            <button @click="logout" class="w-full py-4 bg-red-500/10 text-red-400 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] border border-red-500/10">
                                Salir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.font-heading {
    font-family: 'Montserrat', sans-serif;
}
</style>
