<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref } from 'vue';
import { Menu, X, MessageCircle, FileText, Calendar, MapPin, Clock, Mail, Phone, Users, Monitor } from 'lucide-vue-next';

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
    <div class="min-h-screen bg-white text-black flex flex-col font-sans relative">
        <!-- Navbar with Motto Section Background Color -->
        <header class="sticky top-0 z-50 w-full shadow-2xl border-b-2 border-brand-yellow/30 bg-slate-900 backdrop-blur-md">
            <div class="container mx-auto px-4 h-20 flex items-center justify-between">
                <div class="flex items-center gap-3 font-bold text-xl text-white group cursor-pointer">
                    <div class="bg-white p-1.5 rounded-lg transition-transform group-hover:rotate-12 duration-300">
                        <img src="/media/imgs/logo1.png" alt="Guber Logo" class="h-10 w-auto" />
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="font-heading font-black tracking-tighter text-2xl">GUBER</span>
                        <span class="text-[10px] text-brand-yellow font-black tracking-[0.3em] uppercase">2026</span>
                    </div>
                </div>
                
                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="/#home" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Inicio</a>
                    <a href="/#investment" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Inversión</a>
                    <a href="/#speakers" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Conferencistas</a>
                    <a href="/#topics" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Temario</a>
                    <a href="/#reglamentos" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Reglamentos</a>
                    <a href="/#material" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Material</a>
                </nav>

                <!-- Action Button (Optional highlight) -->
                <div class="hidden lg:block">
                    <Link 
                        v-if="canRegister"
                        href="/inscripciones" 
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-primary/20"
                    >
                        Inscribirme
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = !isMenuOpen">
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
                <div v-if="isMenuOpen" class="md:hidden border-t border-white/10 bg-slate-900 shadow-2xl origin-top">
                    <nav class="flex flex-col p-6 gap-6">
                        <a href="/#home" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Inicio</a>
                        <a href="/#investment" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Inversión</a>
                        <a href="/#speakers" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Conferencistas</a>
                        <a href="/#topics" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Temario</a>
                        <a href="/#reglamentos" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Reglamentos</a>
                        <a href="/#material" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Material</a>
                        <Link v-if="canRegister" href="/inscripciones" class="bg-primary text-white text-center py-4 rounded-xl font-bold uppercase tracking-widest">Inscribirme ahora</Link>
                    </nav>
                </div>
            </transition>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="bg-slate-950 text-white pt-24 pb-12 relative overflow-hidden">
            <!-- Subtle Decorative Glows -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-[120px] -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-brand-yellow/5 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">
                    <!-- Column 1: Informacion General -->
                    <div class="md:col-span-4 space-y-10">
                        <div class="space-y-4">
                            <span class="text-brand-yellow font-heading font-black text-xs tracking-[0.4em] uppercase block">Convención Nacional</span>
                            <h3 class="text-3xl font-heading font-black uppercase tracking-tighter text-white">INFORMACIÓN <span class="text-primary">GENERAL</span></h3>
                            <div class="w-20 h-1.5 bg-gradient-to-r from-primary to-transparent rounded-full"></div>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-5 group/footer-item">
                                <div class="w-12 h-12 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center text-primary group-hover/footer-item:bg-primary group-hover/footer-item:text-white transition-all duration-500 shadow-lg">
                                    <Calendar class="w-6 h-6" />
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest leading-none mb-1">Fecha del Evento</p>
                                    <p class="text-sm font-bold text-slate-200 uppercase font-sans">23, 24 y 25 de Abril, 2026</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 group/footer-item">
                                <div class="w-12 h-12 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center text-brand-yellow group-hover/footer-item:bg-brand-yellow group-hover/footer-item:text-slate-950 transition-all duration-500 shadow-lg relative">
                                    <Users class="w-5 h-5 absolute -translate-x-1 -translate-y-1 opacity-100 group-hover/footer-item:opacity-0 transition-opacity" />
                                    <Monitor class="w-5 h-5 absolute translate-x-1 translate-y-1 opacity-50 group-hover/footer-item:opacity-100 group-hover/footer-item:translate-x-0 group-hover/footer-item:translate-y-0 transition-all" />
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest leading-none mb-1">Modalidad</p>
                                    <p class="text-sm font-bold text-slate-200 uppercase font-sans tracking-tight flex items-center gap-2">
                                        Presencial <span class="w-1 h-1 bg-brand-yellow rounded-full"></span> Virtual
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Contacto -->
                    <div class="md:col-span-5 space-y-10">
                        <div class="space-y-4">
                            <span class="text-brand-yellow font-heading font-black text-xs tracking-[0.4em] uppercase block">Canales Oficiales</span>
                            <h3 class="text-3xl font-heading font-black uppercase tracking-tighter text-white">CONTACTO <span class="text-primary">DIRECTO</span></h3>
                            <div class="w-20 h-1.5 bg-gradient-to-r from-primary to-transparent rounded-full"></div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div class="space-y-6 text-sm">
                                <div class="group/link">
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-2">Ubicación Sede</p>
                                    <a href="https://maps.google.com/?q=UNIVERSIDAD+NACIONAL+AMAZONICA+DE+MADRE+DE+DIOS" target="_blank" class="text-slate-300 font-medium hover:text-primary transition-colors leading-relaxed block underline decoration-primary/20 underline-offset-4">
                                        Auditorio UNAMAD,<br> Puerto Maldonado, Perú
                                    </a>
                                </div>
                                <div class="group/link">
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-2">Escríbenos</p>
                                    <a href="mailto:ccpmdd@gmail.com" class="font-bold text-white hover:text-primary transition-colors underline decoration-primary/30 underline-offset-4 tracking-tight">ccpmdd@gmail.com</a>
                                </div>
                            </div>
                            <div class="space-y-6 border-l border-slate-800 pl-8">
                                <div>
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-2 font-sans">Central Telefónica</p>
                                    <p class="text-xl font-heading font-black text-white tracking-tighter leading-none">+51 997 161 347</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-2 font-sans">Horario de Atención</p>
                                    <p class="text-[11px] text-slate-400 leading-tight uppercase font-sans tracking-wide">Lun - Vie: 09:00 - 18:00<br>Sáb: 09:00 - 13:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Logo -->
                    <div class="md:col-span-3 flex flex-col items-center md:items-end justify-center">
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-primary/20 rounded-[3rem] blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl relative z-10 border-b-8 border-brand-yellow transition-transform duration-500 hover:-translate-y-2 hover:rotate-2">
                                <img src="/media/imgs/logo1.png" alt="Guber 2026 Logo" class="w-32 h-auto" />
                            </div>
                        </div>
                        <div class="mt-8 text-right hidden md:block">
                            <p class="text-[10px] text-slate-600 font-black uppercase tracking-[0.5em] leading-none mb-2 font-sans">Madre de Dios</p>
                            <p class="text-[10px] text-primary font-black uppercase tracking-[0.3em] font-sans italic">Capital de la Biodiversidad</p>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-px bg-slate-800"></div>
                        <p class="text-[10px] text-slate-500 font-bold tracking-[0.2em] uppercase font-sans">
                            &copy; 2026 Guber. Todos los derechos reservados.
                        </p>
                    </div>
                    <div class="flex items-center gap-10 grayscale opacity-30 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] font-sans">Excelencia en Gestión Pública</span>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Floating Action Buttons (Bottom Right) -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
            <!-- WhatsApp Button -->
            <a 
                href="https://wa.me/51997161347" 
                target="_blank" 
                rel="noopener noreferrer"
                class="flex items-center gap-3 bg-primary text-white px-5 py-2.5 rounded-full shadow-lg hover:bg-primary/90 hover:scale-105 transition-all duration-300 group"
            >
                <span class="font-bold text-sm tracking-wide">Escríbenos</span>
                <div class="bg-white/20 p-1.5 rounded-full text-white">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.869-1.29-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.536 0 1.52 1.115 2.988 1.27 3.196.155.208 2.195 3.35 5.317 4.698.742.32 1.32.511 1.77.65.742.228 1.417.196 1.956.116.602-.089 1.758-.718 2.006-1.412.248-.694.248-1.334.174-1.463-.075-.129-.272-.208-.57-.357zM12.007 2C6.475 2 2 6.475 2 12a9.99 9.99 0 0 0 1.34 4.832l-1.427 5.212 5.346-1.402A9.99 9.99 0 0 0 12.007 22c5.523 0 10-4.475 10-10s-4.477-10-10-10z" />
                    </svg>
                </div>
            </a>

            <!-- Registration Alert Button -->
            <Link 
                v-if="canRegister"
                href="/inscripciones" 
                class="flex items-center gap-3 bg-brand-yellow text-white px-5 py-2.5 rounded-full shadow-[0_10px_20px_rgba(188,128,32,0.3)] hover:bg-brand-yellow/90 hover:scale-105 transition-all duration-300 border border-white/10"
            >
                <span class="font-bold text-sm tracking-wide">Regístrate y Participa</span>
                <div class="bg-white/20 p-1.5 rounded-full animate-bounce">
                    <FileText class="w-5 h-5" />
                </div>
            </Link>
        </div>
    </div>
</template>