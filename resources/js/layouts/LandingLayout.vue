<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Calendar, FileText, Menu, Monitor, Users, X } from 'lucide-vue-next';
import { ref } from 'vue';

import { inscripciones } from '@/routes';
import * as aulaVirtual from '@/routes/aula-virtual';

withDefaults(
    defineProps<{
        canRegister?: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const isMenuOpen = ref(false);
</script>

<template>
    <div
        class="relative flex min-h-screen flex-col bg-white font-sans text-black"
    >
        <!-- Navbar with Motto Section Background Color -->
        <header
            class="sticky top-0 z-50 w-full border-b-2 border-brand-yellow/30 bg-slate-900 shadow-2xl backdrop-blur-md"
        >
            <div
                class="container mx-auto flex h-20 items-center justify-between px-4"
            >
                <div
                    class="group flex cursor-pointer items-center gap-3 text-xl font-bold text-white"
                >
                    <div
                        class="rounded-lg bg-white p-1.5 transition-transform duration-300 group-hover:rotate-12"
                    >
                        <img
                            src="/media/imgs/logo1.png"
                            alt="Guber Logo"
                            class="h-10 w-auto"
                        />
                    </div>
                    <div class="flex flex-col leading-none">
                        <span
                            class="font-heading text-2xl font-black tracking-tighter"
                            >GUBER</span
                        >
                        <span
                            class="text-[10px] font-black tracking-[0.3em] text-brand-yellow uppercase"
                            >2026</span
                        >
                    </div>
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden items-center gap-8 md:flex">
                    <a
                        href="/#home"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Inicio</a
                    >
                    <a
                        href="/#investment"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Inversión</a
                    >
                    <a
                        href="/#speakers"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Conferencistas</a
                    >
                    <a
                        href="/#topics"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Temario</a
                    >
                    <a
                        href="/#reglamentos"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Reglamentos</a
                    >
                    <a
                        href="/#material"
                        class="text-xs font-black tracking-widest text-white/80 uppercase transition-all hover:text-brand-yellow"
                        >Material</a
                    >
                </nav>

                <!-- Action Button (Optional highlight) -->
                <div class="hidden items-center gap-4 lg:flex">
                    <Link
                        :href="aulaVirtual.index().url"
                        class="rounded-xl border border-white/10 bg-white/10 px-6 py-2.5 text-xs font-bold tracking-widest text-white uppercase transition-all hover:bg-white/20"
                    >
                        Aula Virtual
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="inscripciones().url"
                        class="rounded-xl bg-primary px-6 py-2.5 text-xs font-bold tracking-widest text-white uppercase shadow-lg shadow-primary/20 transition-all hover:bg-primary/90"
                    >
                        Inscribirme
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <button
                    class="p-2 text-white transition-colors hover:text-brand-yellow md:hidden"
                    @click="isMenuOpen = !isMenuOpen"
                >
                    <Menu v-if="!isMenuOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6" />
                </button>
            </div>

            <!-- Mobile Nav -->
            <transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="transform -translate-y-4 scale-95 opacity-0"
                enter-to-class="transform translate-y-0 scale-100 opacity-100"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="transform translate-y-0 scale-100 opacity-100"
                leave-to-class="transform -translate-y-4 scale-95 opacity-0"
            >
                <div
                    v-if="isMenuOpen"
                    class="origin-top border-t border-white/10 bg-slate-900 shadow-2xl md:hidden"
                >
                    <nav class="flex flex-col gap-6 p-6">
                        <a
                            href="/#home"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Inicio</a
                        >
                        <a
                            href="/#investment"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Inversión</a
                        >
                        <a
                            href="/#speakers"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Conferencistas</a
                        >
                        <a
                            href="/#topics"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Temario</a
                        >
                        <a
                            href="/#reglamentos"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Reglamentos</a
                        >
                        <a
                            href="/#material"
                            class="text-sm font-black tracking-widest text-white uppercase transition-colors hover:text-brand-yellow"
                            @click="isMenuOpen = false"
                            >Material</a
                        >
                        <Link
                            :href="aulaVirtual.index().url"
                            class="rounded-xl bg-white/10 py-4 text-center font-bold tracking-widest text-white uppercase"
                            >Aula Virtual</Link
                        >
                        <Link
                            v-if="canRegister"
                            :href="inscripciones().url"
                            class="rounded-xl bg-primary py-4 text-center font-bold tracking-widest text-white uppercase"
                            >Inscribirme ahora</Link
                        >
                    </nav>
                </div>
            </transition>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer
            class="relative overflow-hidden bg-slate-950 pt-24 pb-12 text-white"
        >
            <!-- Subtle Decorative Glows -->
            <div
                class="absolute top-0 left-1/4 h-96 w-96 -translate-y-1/2 rounded-full bg-primary/5 blur-[120px]"
            ></div>
            <div
                class="absolute right-0 bottom-0 h-64 w-64 translate-x-1/2 translate-y-1/2 rounded-full bg-brand-yellow/5 blur-[100px]"
            ></div>

            <div class="relative z-10 container mx-auto px-4">
                <div class="mb-20 grid grid-cols-1 gap-16 md:grid-cols-12">
                    <!-- Column 1: Informacion General -->
                    <div class="space-y-10 md:col-span-4">
                        <div class="space-y-4">
                            <span
                                class="block font-heading text-xs font-black tracking-[0.4em] text-brand-yellow uppercase"
                                >Convención Nacional</span
                            >
                            <h3
                                class="font-heading text-3xl font-black tracking-tighter text-white uppercase"
                            >
                                INFORMACIÓN
                                <span class="text-primary">GENERAL</span>
                            </h3>
                            <div
                                class="h-1.5 w-20 rounded-full bg-gradient-to-r from-primary to-transparent"
                            ></div>
                        </div>

                        <div class="space-y-6">
                            <div
                                class="group/footer-item flex items-center gap-5"
                            >
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-800 bg-slate-900 text-primary shadow-lg transition-all duration-500 group-hover/footer-item:bg-primary group-hover/footer-item:text-white"
                                >
                                    <Calendar class="h-6 w-6" />
                                </div>
                                <div>
                                    <p
                                        class="mb-1 text-[10px] leading-none font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Fecha del Evento
                                    </p>
                                    <p
                                        class="font-sans text-sm font-bold text-slate-200 uppercase"
                                    >
                                        23, 24 y 25 de Abril, 2026
                                    </p>
                                </div>
                            </div>
                            <div
                                class="group/footer-item flex items-center gap-5"
                            >
                                <div
                                    class="relative flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-800 bg-slate-900 text-brand-yellow shadow-lg transition-all duration-500 group-hover/footer-item:bg-brand-yellow group-hover/footer-item:text-slate-950"
                                >
                                    <Users
                                        class="absolute h-5 w-5 -translate-x-1 -translate-y-1 opacity-100 transition-opacity group-hover/footer-item:opacity-0"
                                    />
                                    <Monitor
                                        class="absolute h-5 w-5 translate-x-1 translate-y-1 opacity-50 transition-all group-hover/footer-item:translate-x-0 group-hover/footer-item:translate-y-0 group-hover/footer-item:opacity-100"
                                    />
                                </div>
                                <div>
                                    <p
                                        class="mb-1 text-[10px] leading-none font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Modalidad
                                    </p>
                                    <p
                                        class="flex items-center gap-2 font-sans text-sm font-bold tracking-tight text-slate-200 uppercase"
                                    >
                                        Presencial
                                        <span
                                            class="h-1 w-1 rounded-full bg-brand-yellow"
                                        ></span>
                                        Virtual
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Contacto -->
                    <div class="space-y-10 md:col-span-5">
                        <div class="space-y-4">
                            <span
                                class="block font-heading text-xs font-black tracking-[0.4em] text-brand-yellow uppercase"
                                >Canales Oficiales</span
                            >
                            <h3
                                class="font-heading text-3xl font-black tracking-tighter text-white uppercase"
                            >
                                CONTACTO
                                <span class="text-primary">DIRECTO</span>
                            </h3>
                            <div
                                class="h-1.5 w-20 rounded-full bg-gradient-to-r from-primary to-transparent"
                            ></div>
                        </div>

                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                            <div class="space-y-6 text-sm">
                                <div class="group/link">
                                    <p
                                        class="mb-2 text-[10px] font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Ubicación Sede
                                    </p>
                                    <a
                                        href="https://maps.google.com/?q=UNIVERSIDAD+NACIONAL+AMAZONICA+DE+MADRE+DE+DIOS"
                                        target="_blank"
                                        class="block leading-relaxed font-medium text-slate-300 underline decoration-primary/20 underline-offset-4 transition-colors hover:text-primary"
                                    >
                                        Auditorio UNAMAD,<br />
                                        Puerto Maldonado, Perú
                                    </a>
                                </div>
                                <div class="group/link">
                                    <p
                                        class="mb-2 text-[10px] font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Escríbenos
                                    </p>
                                    <a
                                        href="mailto:ccpmdd@gmail.com"
                                        class="font-bold tracking-tight text-white underline decoration-primary/30 underline-offset-4 transition-colors hover:text-primary"
                                        >ccpmdd@gmail.com</a
                                    >
                                </div>
                            </div>
                            <div
                                class="space-y-6 border-l border-slate-800 pl-8"
                            >
                                <div>
                                    <p
                                        class="mb-2 font-sans text-[10px] font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Central Telefónica
                                    </p>
                                    <p
                                        class="font-heading text-xl leading-none font-black tracking-tighter text-white"
                                    >
                                        +51 997 161 347
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="mb-2 font-sans text-[10px] font-black tracking-widest text-slate-500 uppercase"
                                    >
                                        Horario de Atención
                                    </p>
                                    <p
                                        class="font-sans text-[11px] leading-tight tracking-wide text-slate-400 uppercase"
                                    >
                                        Lun - Vie: 09:00 - 18:00<br />Sáb: 09:00
                                        - 13:00
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Logo -->
                    <div
                        class="flex flex-col items-center justify-center md:col-span-3 md:items-end"
                    >
                        <div class="group relative">
                            <div
                                class="absolute -inset-4 rounded-[3rem] bg-primary/20 opacity-0 blur-2xl transition-opacity duration-700 group-hover:opacity-100"
                            ></div>
                            <div
                                class="relative z-10 rounded-[2.5rem] border-b-8 border-brand-yellow bg-white p-8 shadow-2xl transition-transform duration-500 hover:-translate-y-2 hover:rotate-2"
                            >
                                <img
                                    src="/media/imgs/logo1.png"
                                    alt="Guber 2026 Logo"
                                    class="h-auto w-32"
                                />
                            </div>
                        </div>
                        <div class="mt-8 hidden text-right md:block">
                            <p
                                class="mb-2 font-sans text-[10px] leading-none font-black tracking-[0.5em] text-slate-600 uppercase"
                            >
                                Madre de Dios
                            </p>
                            <p
                                class="font-sans text-[10px] font-black tracking-[0.3em] text-primary uppercase italic"
                            >
                                Capital de la Biodiversidad
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="flex flex-col items-center justify-between gap-8 border-t border-slate-900 pt-10 md:flex-row"
                >
                    <div class="flex items-center gap-4">
                        <div class="h-px w-8 bg-slate-800"></div>
                        <p
                            class="font-sans text-[10px] font-bold tracking-[0.2em] text-slate-500 uppercase"
                        >
                            &copy; 2026 Guber. Todos los derechos reservados.
                        </p>
                    </div>
                    <div
                        class="flex items-center gap-10 opacity-30 grayscale transition-all duration-700 hover:opacity-100 hover:grayscale-0"
                    >
                        <span
                            class="font-sans text-[10px] font-black tracking-[0.5em] text-slate-400 uppercase"
                            >Excelencia en Gestión Pública</span
                        >
                    </div>
                </div>
            </div>
        </footer>

        <!-- Floating Action Buttons (Bottom Right) -->
        <div class="fixed right-6 bottom-6 z-50 flex flex-col items-end gap-3">
            <!-- WhatsApp Button -->
            <a
                href="https://wa.me/51997161347"
                target="_blank"
                rel="noopener noreferrer"
                class="group flex items-center gap-3 rounded-full bg-primary px-5 py-2.5 text-white shadow-lg transition-all duration-300 hover:scale-105 hover:bg-primary/90"
            >
                <span class="text-sm font-bold tracking-wide">Escríbenos</span>
                <div class="rounded-full bg-white/20 p-1.5 text-white">
                    <svg
                        viewBox="0 0 24 24"
                        class="h-5 w-5 fill-current"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.869-1.29-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.536 0 1.52 1.115 2.988 1.27 3.196.155.208 2.195 3.35 5.317 4.698.742.32 1.32.511 1.77.65.742.228 1.417.196 1.956.116.602-.089 1.758-.718 2.006-1.412.248-.694.248-1.334.174-1.463-.075-.129-.272-.208-.57-.357zM12.007 2C6.475 2 2 6.475 2 12a9.99 9.99 0 0 0 1.34 4.832l-1.427 5.212 5.346-1.402A9.99 9.99 0 0 0 12.007 22c5.523 0 10-4.475 10-10s-4.477-10-10-10z"
                        />
                    </svg>
                </div>
            </a>

            <!-- Registration Alert Button -->
            <Link
                v-if="canRegister"
                href="/inscripciones"
                class="flex items-center gap-3 rounded-full border border-white/10 bg-brand-yellow px-5 py-2.5 text-white shadow-[0_10px_20px_rgba(188,128,32,0.3)] transition-all duration-300 hover:scale-105 hover:bg-brand-yellow/90"
            >
                <span class="text-sm font-bold tracking-wide"
                    >Regístrate y Participa</span
                >
                <div class="animate-bounce rounded-full bg-white/20 p-1.5">
                    <FileText class="h-5 w-5" />
                </div>
            </Link>
        </div>
    </div>
</template>
