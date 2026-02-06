<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref } from 'vue';
import { Menu, X, MessageCircle, FileText, Calendar, MapPin, Clock, Mail, Phone } from 'lucide-vue-next';

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
                    <a href="#home" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Inicio</a>
                    <a href="#material" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Material</a>
                    <a href="#investment" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Inversión</a>
                    <a href="#speakers" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Coreferencistas</a>
                    <a href="#topics" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Temario</a>
                    <a href="#info" class="text-xs font-black text-white/80 hover:text-brand-yellow uppercase tracking-widest transition-all">Información</a>
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
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="transform -translate-y-4 opacity-0"
                enter-to-class="transform translate-y-0 opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="transform translate-y-0 opacity-100"
                leave-to-class="transform -translate-y-4 opacity-0"
            >
                <div v-if="isMenuOpen" class="md:hidden border-t border-white/10 bg-slate-900 shadow-2xl">
                    <nav class="flex flex-col p-6 gap-6">
                        <a href="#home" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Inicio</a>
                        <a href="#material" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Material</a>
                        <a href="#investment" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Inversión</a>
                        <a href="#speakers" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Coreferencistas</a>
                        <a href="#topics" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Temario</a>
                        <a href="#info" class="text-sm font-black text-white hover:text-brand-yellow uppercase tracking-widest transition-colors" @click="isMenuOpen = false">Información</a>
                        <Link v-if="canRegister" href="/inscripciones" class="bg-primary text-white text-center py-4 rounded-xl font-bold uppercase tracking-widest">Inscribirme ahora</Link>
                    </nav>
                </div>
            </transition>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="border-t-4 border-primary bg-white pt-16 pb-8 text-black">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                    <!-- Column 1: Informacion General -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-black uppercase tracking-wider text-primary border-b-2 border-primary w-fit pb-1">INFORMACIÓN GENERAL</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-primary/10 rounded-lg text-primary mt-1">
                                    <Calendar class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="font-bold text-lg leading-tight">GUBER 2026</p>
                                    <p class="text-gray-600">23, 24 y 25 de abril</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-primary/10 rounded-lg text-primary mt-1">
                                    <Users class="w-5 h-5" />
                                </div>
                                <p class="text-gray-600 font-medium pt-2">Presencial y Virtual</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-primary/10 rounded-lg text-primary mt-1">
                                    <MapPin class="w-5 h-5" />
                                </div>
                                <a 
                                    href="https://maps.google.com/?q=UNIVERSIDAD+NACIONAL+AMAZONICA+DE+MADRE+DE+DIOS" 
                                    target="_blank" 
                                    class="text-gray-600 hover:text-primary transition-colors text-sm font-medium leading-relaxed underline decoration-dotted"
                                >
                                    AUDITORIO de la UNIVERSIDAD NACIONAL AMAZÓNICA DE MADRE DE DIOS
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Contacto -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-black uppercase tracking-wider text-primary border-b-2 border-primary w-fit pb-1">CCP MADRE DE DIOS</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <MapPin class="w-5 h-5 text-primary mt-1 shrink-0" />
                                <p class="text-sm text-gray-600">Jr. Libertad 850, Puerto Maldonado, Perú</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <Clock class="w-5 h-5 text-primary mt-1 shrink-0" />
                                <div class="text-xs text-gray-600 space-y-1">
                                    <p><span class="font-bold">Lunes a Viernes:</span> 09:00 a 13:00 hrs. y 15:00 a 18:00 hrs.</p>
                                    <p><span class="font-bold">Sábados:</span> 09:00 a 13:00 hrs.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <Mail class="w-5 h-5 text-primary shrink-0" />
                                <a href="mailto:ccpmdd@gmail.com" class="text-sm text-gray-600 hover:text-primary transition-colors underline decoration-dotted">ccpmdd@gmail.com</a>
                            </div>
                            <div class="flex items-center gap-3">
                                <Phone class="w-5 h-5 text-primary shrink-0" />
                                <div class="text-sm text-gray-600 font-bold space-y-0.5">
                                    <p>+51 997 161 347</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Logo -->
                    <div class="flex flex-col items-center md:items-end justify-start">
                        <img src="/media/imgs/logo1.png" alt="Guber 2026 Logo" class="w-64 h-auto drop-shadow-xl" />
                        <div class="mt-6 text-right hidden md:block">
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.3em] font-black">Puerto Maldonado</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.3em] font-black">Capital de la Biodiversidad</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-gray-400 font-bold tracking-widest uppercase">
                        &copy; 2026 Guber. Todos los derechos reservados.
                    </p>
                    <div class="flex gap-6">
                        <!-- Redes Sociales placeholders -->
                        <span class="text-[10px] font-black text-primary/40 uppercase tracking-widest">Excelencia en Gestión</span>
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