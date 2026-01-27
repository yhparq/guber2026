<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { User, Building2, CheckCircle, ArrowRight } from 'lucide-vue-next';

defineProps<{
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="Inscripciones - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="bg-gray-50 min-h-screen py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        Inscripciones <span class="text-primary">GUBER 2026</span>
                    </h1>
                    <p class="text-xl text-gray-600">
                        Selecciona el tipo de inscripción que deseas realizar. Contamos con beneficios exclusivos tanto para participantes individuales como para delegaciones corporativas.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Individual Registration Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group border border-gray-100">
                        <div class="bg-primary/5 p-8 flex items-center justify-center border-b border-primary/10 group-hover:bg-primary/10 transition-colors">
                            <div class="bg-white p-4 rounded-full shadow-md group-hover:scale-110 transition-transform duration-300">
                                <User class="w-12 h-12 text-primary" />
                            </div>
                        </div>
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors">Inscripción Individual</h2>
                            <p class="text-gray-600 mb-6 min-h-[80px]">
                                Ideal para profesionales, estudiantes y público en general que deseen asistir por cuenta propia. Accede a todas las conferencias y obtén tu certificación personal.
                            </p>
                            
                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-primary shrink-0" />
                                    <span>Certificado a nombre propio</span>
                                </li>
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-primary shrink-0" />
                                    <span>Material digital incluido</span>
                                </li>
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-primary shrink-0" />
                                    <span>Acceso a networking</span>
                                </li>
                            </ul>

                            <Link href="/inscripcion-individual" class="flex items-center justify-center gap-2 w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-primary hover:shadow-lg transition-all duration-300">
                                <span>Inscribirme Ahora</span>
                                <ArrowRight class="w-5 h-5" />
                            </Link>
                        </div>
                    </div>

                    <!-- Corporate Registration Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group border border-gray-100">
                        <div class="bg-blue-50 p-8 flex items-center justify-center border-b border-blue-100 group-hover:bg-blue-100/50 transition-colors">
                            <div class="bg-white p-4 rounded-full shadow-md group-hover:scale-110 transition-transform duration-300">
                                <Building2 class="w-12 h-12 text-blue-600" />
                            </div>
                        </div>
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">Inscripción Corporativa</h2>
                            <p class="text-gray-600 mb-6 min-h-[80px]">
                                Diseñado para instituciones y empresas. Registra a múltiples colaboradores (mínimo 3) con una tarifa preferencial y facturación unificada.
                            </p>
                            
                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-blue-600 shrink-0" />
                                    <span>Facturación corporativa</span>
                                </li>
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-blue-600 shrink-0" />
                                    <span>Descuentos por volumen</span>
                                </li>
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <CheckCircle class="w-5 h-5 text-blue-600 shrink-0" />
                                    <span>Gestión centralizada</span>
                                </li>
                            </ul>

                            <Link href="/inscripcion-corporativa" class="flex items-center justify-center gap-2 w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-blue-600 hover:shadow-lg transition-all duration-300">
                                <span>Registrar Delegación</span>
                                <ArrowRight class="w-5 h-5" />
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="mt-16 text-center">
                    <p class="text-gray-500 mb-4">¿Tienes dudas sobre el proceso?</p>
                    <a href="https://wa.me/51900000000" target="_blank" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                        Contactar a Soporte por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
