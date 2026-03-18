<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import {
    ArrowRight,
    Calendar,
    Circle,
    Clock,
    FileText,
    LogOut,
    Menu,
    Play,
    User,
    X,
} from 'lucide-vue-next';
import { computed, ref } from 'vue';

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
        .filter((p) => p.dia === selectedDay.value)
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

    <div
        class="flex h-screen overflow-hidden bg-[#F8FAFC] font-sans text-slate-900"
    >
        <!-- Sidebar Premium -->
        <aside
            class="relative hidden w-72 shrink-0 flex-col overflow-hidden bg-slate-900 text-white lg:flex"
        >
            <!-- Decorative background glow -->
            <div
                class="absolute -top-24 -left-24 h-48 w-48 rounded-full bg-primary/20 blur-[80px]"
            ></div>

            <div class="relative z-10 p-8">
                <div class="mb-10 flex items-center gap-3">
                    <div
                        class="rounded-2xl bg-white p-2 shadow-xl shadow-black/20"
                    >
                        <img
                            src="/media/imgs/logo1.png"
                            alt="Logo"
                            class="h-8 w-auto"
                        />
                    </div>
                    <div>
                        <div
                            class="font-heading text-xl leading-none font-black tracking-tighter"
                        >
                            GUBER <span class="text-brand-yellow">2026</span>
                        </div>
                        <div
                            class="mt-1 text-[9px] font-bold tracking-[0.2em] text-white/40 uppercase"
                        >
                            Plataforma Académica
                        </div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <div
                        class="mb-6 px-2 text-[10px] font-black tracking-[0.3em] text-white/20 uppercase"
                    >
                        Cronograma Oficial
                    </div>

                    <button
                        v-for="day in eventDays"
                        :key="day.id"
                        @click="selectDay(day.id)"
                        class="group relative flex w-full items-center gap-4 overflow-hidden rounded-2xl px-5 py-4 transition-all duration-500"
                        :class="
                            selectedDay === day.id
                                ? 'bg-white/10 text-white shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]'
                                : 'text-white/40 hover:text-white'
                        "
                    >
                        <!-- Active indicator -->
                        <div
                            v-if="selectedDay === day.id"
                            class="absolute top-0 bottom-0 left-0 w-1 bg-brand-yellow"
                        ></div>

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl transition-all duration-500"
                            :class="
                                selectedDay === day.id
                                    ? 'scale-110 bg-primary text-white shadow-lg shadow-primary/40'
                                    : 'bg-white/5 text-white/20 group-hover:bg-white/10'
                            "
                        >
                            <Calendar class="h-5 w-5" />
                        </div>
                        <div class="flex-1 text-left">
                            <p class="mb-1 text-sm leading-none font-bold">
                                {{ day.label }}
                            </p>
                            <p class="text-[10px] opacity-50">
                                {{ day.date }} de Abril
                            </p>
                        </div>
                        <ArrowRight
                            v-if="selectedDay === day.id"
                            class="h-4 w-4 animate-pulse text-brand-yellow"
                        />
                    </button>
                </nav>
            </div>

            <!-- User Card at Bottom -->
            <div class="relative z-10 mt-auto p-6">
                <div
                    class="rounded-[2rem] border border-white/5 bg-white/5 p-5 backdrop-blur-md"
                >
                    <div class="mb-4 flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-tr from-primary to-purple-400 text-sm font-bold text-white shadow-lg"
                            >
                                {{ participant.nombres[0] }}
                            </div>
                            <div
                                class="absolute -right-0.5 -bottom-0.5 h-3.5 w-3.5 rounded-full border-2 border-slate-900 bg-green-500"
                            ></div>
                        </div>
                        <div class="min-w-0">
                            <p
                                class="truncate text-xs leading-none font-black text-white uppercase"
                            >
                                {{ participant.nombres }}
                            </p>
                            <p
                                class="mt-1 truncate text-[9px] tracking-wider text-white/30"
                            >
                                {{ participant.dni }}
                            </p>
                        </div>
                    </div>
                    <button
                        @click="logout"
                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-500/10 py-3 text-[10px] font-black tracking-[0.2em] text-red-400 uppercase transition-all hover:bg-red-500/20 hover:text-white"
                    >
                        <LogOut class="h-3 w-3" /> Cerrar Sesión
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex h-full flex-1 flex-col overflow-hidden">
            <!-- Header Mobile -->
            <header
                class="relative z-30 flex h-16 items-center justify-between bg-slate-900 px-6 text-white shadow-xl lg:hidden"
            >
                <div class="flex items-center gap-2">
                    <img
                        src="/media/imgs/logo1.png"
                        alt="Logo"
                        class="h-7 w-auto rounded-lg bg-white p-1"
                    />
                    <span class="text-sm font-black tracking-tighter uppercase"
                        >Guber <span class="text-brand-yellow">2026</span></span
                    >
                </div>
                <button
                    @click="isMobileMenuOpen = true"
                    class="rounded-xl bg-white/10 p-2.5 text-brand-yellow"
                >
                    <Menu class="h-6 w-6" />
                </button>
            </header>

            <!-- Content Title Area -->
            <div
                class="relative z-20 flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-8 py-8 lg:px-12"
            >
                <div>
                    <nav
                        class="mb-2 flex items-center gap-2 text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                    >
                        <span>Aula Virtual</span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="text-primary">{{
                            eventDays.find((d) => d.id === selectedDay)?.label
                        }}</span>
                    </nav>
                    <h1
                        class="font-heading text-2xl font-black tracking-tight text-slate-900 uppercase lg:text-3xl"
                    >
                        Cronograma
                        <span class="text-primary">{{
                            eventDays.find((d) => d.id === selectedDay)?.date
                        }}</span>
                    </h1>
                </div>

                <div
                    class="hidden items-center gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-2 md:flex"
                >
                    <div class="flex -space-x-2">
                        <div
                            v-for="i in 3"
                            :key="i"
                            class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-slate-200 text-[10px] font-bold text-slate-500"
                        >
                            +
                        </div>
                    </div>
                    <span
                        class="mr-2 text-[10px] font-black tracking-widest text-slate-500 uppercase"
                        >Participantes Conectados</span
                    >
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="flex-1 overflow-y-auto bg-[#F8FAFC]">
                <div class="mx-auto max-w-5xl px-8 py-12 lg:px-12">
                    <div
                        v-if="filteredPonencias.length === 0"
                        class="flex flex-col items-center justify-center rounded-[3rem] border border-slate-200 bg-white py-32 shadow-sm"
                    >
                        <div
                            class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-slate-50 text-slate-200"
                        >
                            <Clock class="h-10 w-10" />
                        </div>
                        <h3
                            class="text-lg font-black tracking-widest text-slate-400 uppercase"
                        >
                            Sin actividad programada
                        </h3>
                        <p class="mt-2 text-sm font-medium text-slate-300">
                            Las ponencias para este día aparecerán pronto.
                        </p>
                    </div>

                    <div v-else class="relative">
                        <!-- Timeline Line -->
                        <div
                            class="absolute top-0 bottom-0 left-[27px] hidden w-0.5 bg-gradient-to-b from-primary/30 via-slate-200 to-transparent md:block"
                        ></div>

                        <div class="space-y-8">
                            <div
                                v-for="(ponencia, index) in filteredPonencias"
                                :key="ponencia.id"
                                class="group relative md:pl-16"
                            >
                                <!-- Timeline Point -->
                                <div
                                    class="absolute top-8 left-0 z-10 hidden h-14 w-14 items-center justify-center bg-[#F8FAFC] md:flex"
                                >
                                    <div
                                        class="h-4 w-4 rounded-full border-4 border-primary bg-white shadow-[0_0_0_4px_rgba(116,34,132,0.1)] transition-transform duration-500 group-hover:scale-125"
                                    ></div>
                                </div>

                                <!-- Card Premium -->
                                <div
                                    class="flex flex-col overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] transition-all duration-500 hover:border-primary/20 hover:shadow-[0_20px_40px_-8px_rgba(0,0,0,0.1)] md:flex-row"
                                >
                                    <!-- Time Column Sidebarish -->
                                    <div
                                        class="flex flex-row items-center justify-between gap-4 border-slate-100 bg-slate-50/50 p-8 md:w-40 md:flex-col md:justify-center md:border-r"
                                    >
                                        <div class="text-center">
                                            <div
                                                class="mb-1 text-xs font-black tracking-widest text-primary uppercase"
                                            >
                                                {{
                                                    ponencia.hora_inicio.substring(
                                                        0,
                                                        5,
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="text-[10px] font-bold tracking-tighter text-slate-400 uppercase"
                                            >
                                                Hora Inicio
                                            </div>
                                        </div>
                                        <div
                                            class="hidden h-px w-8 bg-slate-200 md:block"
                                        ></div>
                                        <div class="text-center">
                                            <div
                                                class="mb-1 text-xs font-black tracking-widest text-slate-400 uppercase"
                                            >
                                                {{
                                                    ponencia.hora_fin.substring(
                                                        0,
                                                        5,
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="text-[10px] font-bold tracking-tighter text-slate-300 uppercase"
                                            >
                                                Término
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content Body -->
                                    <div class="relative flex-1 p-8 lg:p-10">
                                        <!-- Category Tag Decor -->
                                        <div
                                            class="absolute top-8 right-8 hidden sm:block"
                                        >
                                            <div
                                                class="flex items-center gap-2 rounded-full border border-primary/10 bg-primary/5 px-3 py-1"
                                            >
                                                <Circle
                                                    class="h-1.5 w-1.5 fill-primary text-primary"
                                                />
                                                <span
                                                    class="text-[9px] font-black tracking-widest text-primary uppercase"
                                                    >Ponencia Magistral</span
                                                >
                                            </div>
                                        </div>

                                        <h3
                                            class="mb-4 font-heading text-xl leading-tight font-black tracking-tight text-slate-900 uppercase transition-colors group-hover:text-primary lg:text-2xl"
                                        >
                                            {{ ponencia.titulo }}
                                        </h3>

                                        <div
                                            class="mb-6 flex items-center gap-4"
                                        >
                                            <div
                                                class="flex items-center gap-2"
                                            >
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-xl border border-brand-yellow/20 bg-brand-yellow/10 text-brand-yellow"
                                                >
                                                    <User class="h-4 w-4" />
                                                </div>
                                                <span
                                                    class="text-xs font-bold tracking-wide text-slate-600 uppercase"
                                                    >Dr(a).
                                                    {{ ponencia.ponente }}</span
                                                >
                                            </div>
                                        </div>

                                        <p
                                            v-if="ponencia.descripcion"
                                            class="mb-8 border-l-2 border-slate-100 pl-4 text-sm leading-relaxed text-slate-500"
                                        >
                                            {{ ponencia.descripcion }}
                                        </p>

                                        <!-- Luxury Actions -->
                                        <div
                                            class="flex flex-wrap items-center gap-4"
                                        >
                                            <a
                                                v-if="ponencia.link_video"
                                                :href="ponencia.link_video"
                                                target="_blank"
                                                class="group/btn flex items-center gap-3 rounded-2xl bg-slate-900 px-6 py-3.5 text-[10px] font-black tracking-[0.2em] text-white uppercase transition-all duration-500 hover:bg-primary hover:shadow-xl hover:shadow-primary/30"
                                            >
                                                <Play
                                                    class="h-4 w-4 fill-brand-yellow text-brand-yellow transition-transform group-hover/btn:scale-110"
                                                />
                                                Ver Sesión
                                            </a>
                                            <a
                                                v-if="ponencia.archivo_material"
                                                :href="`/storage/${ponencia.archivo_material}`"
                                                target="_blank"
                                                class="flex items-center gap-3 rounded-2xl border-2 border-slate-100 bg-white px-6 py-3.5 text-[10px] font-black tracking-[0.2em] text-slate-900 uppercase transition-all duration-500 hover:border-primary hover:text-primary"
                                            >
                                                <FileText
                                                    class="h-4 w-4 text-primary"
                                                />
                                                Descargar PDF
                                            </a>
                                            <a
                                                v-else-if="
                                                    ponencia.link_material
                                                "
                                                :href="ponencia.link_material"
                                                target="_blank"
                                                class="flex items-center gap-3 rounded-2xl border-2 border-slate-100 bg-white px-6 py-3.5 text-[10px] font-black tracking-[0.2em] text-slate-900 uppercase transition-all duration-500 hover:border-primary hover:text-primary"
                                            >
                                                <FileText
                                                    class="h-4 w-4 text-primary"
                                                />
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
            <div
                v-if="isMobileMenuOpen"
                class="fixed inset-0 z-50 flex lg:hidden"
            >
                <div
                    class="flex-1 bg-slate-900/60 backdrop-blur-sm"
                    @click="isMobileMenuOpen = false"
                ></div>
                <div class="relative w-80 bg-slate-900 p-8 shadow-2xl">
                    <button
                        @click="isMobileMenuOpen = false"
                        class="absolute top-6 right-6 p-2 text-white/30 hover:text-white"
                    >
                        <X class="h-6 w-6" />
                    </button>

                    <div class="mb-12">
                        <img
                            src="/media/imgs/logo1.png"
                            alt="Logo"
                            class="mb-4 h-10 w-auto rounded-xl bg-white p-1.5"
                        />
                        <div
                            class="text-lg font-black tracking-widest text-white uppercase"
                        >
                            Cronograma
                        </div>
                    </div>

                    <div class="space-y-4">
                        <button
                            v-for="day in eventDays"
                            :key="day.id"
                            @click="selectDay(day.id)"
                            class="flex w-full items-center justify-between rounded-[2rem] border px-6 py-5 transition-all"
                            :class="
                                selectedDay === day.id
                                    ? 'border-primary bg-primary text-white shadow-lg shadow-primary/20'
                                    : 'border-transparent bg-white/5 text-white/40'
                            "
                        >
                            <div class="text-left">
                                <p
                                    class="text-sm font-black tracking-widest uppercase"
                                >
                                    {{ day.label }}
                                </p>
                                <p class="text-[10px] opacity-50">
                                    {{ day.date }} de Abril
                                </p>
                            </div>
                            <Calendar class="h-5 w-5 opacity-30" />
                        </button>
                    </div>

                    <div class="absolute right-8 bottom-10 left-8">
                        <div
                            class="rounded-[2rem] border border-white/5 bg-white/5 p-6"
                        >
                            <div class="mb-6 flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-primary font-bold"
                                >
                                    {{ participant.nombres[0] }}
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="truncate text-[10px] font-black text-white uppercase"
                                    >
                                        {{ participant.nombres }}
                                    </p>
                                    <p
                                        class="mt-1 truncate text-[9px] tracking-widest text-white/20"
                                    >
                                        PARTICIPANTE
                                    </p>
                                </div>
                            </div>
                            <button
                                @click="logout"
                                class="w-full rounded-2xl border border-red-500/10 bg-red-500/10 py-4 text-[10px] font-black tracking-[0.2em] text-red-400 uppercase"
                            >
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
