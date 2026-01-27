<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref } from 'vue';
import { Menu, X, MessageCircle, FileText } from 'lucide-vue-next';

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
        <header class="sticky top-0 z-50 w-full shadow-lg border-b border-white/10 bg-primary">
            <div class="container mx-auto px-4 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2 font-bold text-xl text-white">
                    <img src="/media/imgs/logo1.png" alt="Guber Logo" class="h-8 w-auto brightness-0 invert" />
                    <span>GUBER 2026</span>
                </div>
                
                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#home" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Inicio</a>
                    <a href="#material" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Material</a>
                    <a href="#investment" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Inversión</a>
                    <a href="#speakers" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Coreferencistas</a>
                    <a href="#topics" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Temario</a>
                    <a href="#info" class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors">Información</a>
                    
                    <div class="flex items-center gap-4 ml-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="text-sm font-medium text-white/90 hover:text-brand-yellow transition-colors"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="login()"
                                class="rounded-full bg-white px-6 py-2 text-sm font-bold text-primary hover:text-brand-yellow transition-all shadow-md"
                            >
                                Ingresar
                            </Link>
                        </template>
                    </div>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = !isMenuOpen">
                    <Menu v-if="!isMenuOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6" />
                </button>
            </div>

            <!-- Mobile Nav -->
            <div v-if="isMenuOpen" class="md:hidden border-t border-white/10 bg-primary">
                <nav class="flex flex-col p-4 gap-4">
                    <a href="#home" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Inicio</a>
                    <a href="#material" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Material</a>
                    <a href="#investment" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Inversión</a>
                    <a href="#speakers" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Coreferencistas</a>
                    <a href="#topics" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Temario</a>
                    <a href="#info" class="text-sm font-medium text-white hover:text-brand-yellow transition-colors" @click="isMenuOpen = false">Información</a>
                    <hr class="border-white/20" />
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="text-sm font-medium text-white hover:text-brand-yellow transition-colors"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="text-sm font-medium text-white font-bold bg-white/10 px-4 py-2 rounded-lg text-center"
                        >
                            Ingresar
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="border-t border-primary bg-white py-8">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <img src="/media/imgs/logo1.png" alt="Guber Logo" class="h-6 w-auto opacity-80" />
                    <span class="text-sm font-semibold text-black">Guber 2026</span>
                </div>
                <p class="text-sm text-black">
                    &copy; 2026 Guber. Todos los derechos reservados.
                </p>
            </div>
        </footer>

        <!-- Floating Action Buttons (Bottom Right) -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
            <!-- WhatsApp Button -->
            <a 
                href="https://wa.me/51900000000" 
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
