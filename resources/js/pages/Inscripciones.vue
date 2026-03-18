<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, Building2, CheckCircle, User } from 'lucide-vue-next';

import LandingLayout from '@/layouts/LandingLayout.vue';

defineProps<{
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="Inscripciones - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="min-h-screen bg-gray-50 py-20">
            <div class="container mx-auto px-4">
                <div class="mx-auto mb-16 max-w-3xl text-center">
                    <h1
                        class="mb-6 text-4xl font-black text-gray-900 md:text-5xl"
                    >
                        Participa con <span class="text-primary">Nosotros</span>
                    </h1>
                    <p class="text-xl text-gray-600">
                        Forma parte de la GUBER 2026, el evento más importante
                        en Contabilidad Gubernamental y Gestión Pública. Elige
                        tu tipo de inscripción y únete a miles de profesionales.
                    </p>
                </div>

                <div
                    class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-2"
                >
                    <!-- Individual Registration Card -->
                    <div
                        class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                    >
                        <div
                            class="flex items-center justify-center border-b border-primary/10 bg-primary/5 p-8 transition-colors group-hover:bg-primary/10"
                        >
                            <div
                                class="rounded-full bg-white p-4 shadow-md transition-transform duration-300 group-hover:scale-110"
                            >
                                <User class="h-12 w-12 text-primary" />
                            </div>
                        </div>
                        <div class="p-8">
                            <h2
                                class="mb-4 text-center text-2xl font-bold text-gray-900 transition-colors group-hover:text-primary"
                            >
                                INSCRIPCIÓN INDIVIDUAL
                            </h2>

                            <ul class="mb-8 space-y-3">
                                <li
                                    class="flex items-center gap-3 text-sm text-gray-600"
                                >
                                    <CheckCircle
                                        class="h-5 w-5 shrink-0 text-primary"
                                    />
                                    <span>Registro rápido y sencillo</span>
                                </li>
                                <li
                                    class="flex items-center gap-3 text-sm text-gray-600"
                                >
                                    <CheckCircle
                                        class="h-5 w-5 shrink-0 text-primary"
                                    />
                                    <span>Acceso completo al evento</span>
                                </li>
                            </ul>

                            <Link
                                href="/inscripcion-individual"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 py-4 font-bold text-white transition-all duration-300 hover:bg-primary hover:shadow-lg"
                            >
                                <span>Comenzar Inscripción Individual</span>
                                <ArrowRight class="h-5 w-5" />
                            </Link>
                        </div>
                    </div>

                    <!-- Corporate Registration Card -->
                    <div
                        class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                    >
                        <div
                            class="flex items-center justify-center border-b border-primary/10 bg-primary/5 p-8 transition-colors group-hover:bg-primary/10"
                        >
                            <div
                                class="rounded-full bg-white p-4 shadow-md transition-transform duration-300 group-hover:scale-110"
                            >
                                <Building2 class="h-12 w-12 text-primary" />
                            </div>
                        </div>
                        <div class="p-8">
                            <h2
                                class="mb-4 text-center text-2xl font-bold text-gray-900 transition-colors group-hover:text-primary"
                            >
                                INSCRIPCIÓN CORPORATIVA
                            </h2>

                            <ul class="mb-8 space-y-3">
                                <li
                                    class="flex items-center gap-3 text-sm text-gray-600"
                                >
                                    <CheckCircle
                                        class="h-5 w-5 shrink-0 text-primary"
                                    />
                                    <span
                                        >Registro de múltiples
                                        participantes</span
                                    >
                                </li>
                                <li
                                    class="flex items-center gap-3 text-sm text-gray-600"
                                >
                                    <CheckCircle
                                        class="h-5 w-5 shrink-0 text-primary"
                                    />
                                    <span>Rápido y Sencillo</span>
                                </li>
                                <li
                                    class="flex items-center gap-3 text-sm text-gray-600"
                                >
                                    <CheckCircle
                                        class="h-5 w-5 shrink-0 text-primary"
                                    />
                                    <span>Acceso completo al evento</span>
                                </li>
                            </ul>

                            <Link
                                href="/inscripcion-corporativa"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 py-4 font-bold text-white transition-all duration-300 hover:bg-primary hover:shadow-lg"
                            >
                                <span>Comenzar Inscripción Corporativa</span>
                                <ArrowRight class="h-5 w-5" />
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="mt-16 text-center">
                    <p class="mb-4 text-gray-500">
                        ¿Tienes dudas sobre el proceso?
                    </p>
                    <a
                        href="https://wa.me/51900000000"
                        target="_blank"
                        class="inline-flex items-center gap-2 font-bold text-primary hover:underline"
                    >
                        Contactar a Soporte por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
