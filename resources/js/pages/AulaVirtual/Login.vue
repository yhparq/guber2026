<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { AlertCircle, Info, Lock, LogIn, Mail } from 'lucide-vue-next';

import LandingLayout from '@/layouts/LandingLayout.vue';

import * as aulaVirtual from '@/routes/aula-virtual';

const form = useForm({
    email: '',
    dni: '',
});

const submit = () => {
    form.post(aulaVirtual.login().url, {
        onFinish: () => form.reset('dni'),
    });
};
</script>

<template>
    <Head title="Aula Virtual - Login" />

    <LandingLayout :can-register="false">
        <div
            class="relative flex min-h-[85vh] items-center justify-center overflow-hidden px-4 py-12 sm:px-6 lg:px-8"
        >
            <!-- Background Image with Blur -->
            <div
                class="absolute inset-0 z-0 scale-105 bg-cover bg-center bg-no-repeat"
                style="
                    background-image: url('/media/imgs/img2.webp');
                    filter: blur(8px) brightness(0.7);
                "
            ></div>

            <div
                class="relative z-10 w-full max-w-md space-y-8 rounded-[2.5rem] border border-white/20 bg-white/95 p-10 shadow-2xl backdrop-blur-md"
            >
                <div class="text-center">
                    <div
                        class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-3xl bg-primary/10 text-primary shadow-inner"
                    >
                        <LogIn class="h-10 w-10" />
                    </div>
                    <h2
                        class="mb-2 font-heading text-4xl font-bold tracking-tighter text-slate-900 uppercase"
                    >
                        Aula <span class="text-primary">Virtual</span>
                    </h2>
                    <p
                        class="font-sans text-sm font-medium tracking-widest text-slate-500 uppercase"
                    >
                        Ingresa con tus datos de registro
                    </p>
                </div>

                <form class="mt-8 space-y-6" @submit.prevent="submit">
                    <div class="space-y-4">
                        <div>
                            <label
                                for="email"
                                class="mb-2 ml-1 block text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                                >Correo Electrónico</label
                            >
                            <div class="group relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition-colors group-focus-within:text-primary"
                                >
                                    <Mail class="h-5 w-5" />
                                </div>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="block w-full rounded-2xl border-2 border-slate-100 py-4 pr-4 pl-12 font-sans text-sm font-medium transition-all placeholder:text-slate-300 focus:border-primary focus:ring-0"
                                    placeholder="ejemplo@correo.com"
                                />
                            </div>
                            <p
                                v-if="form.errors.email"
                                class="mt-2 flex items-center gap-1 text-xs font-bold text-red-600"
                            >
                                <AlertCircle class="h-3 w-3" />
                                {{ form.errors.email }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="dni"
                                class="mb-2 ml-1 block text-[10px] font-black tracking-[0.2em] text-slate-400 uppercase"
                                >Contraseña</label
                            >
                            <div class="group relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition-colors group-focus-within:text-primary"
                                >
                                    <Lock class="h-5 w-5" />
                                </div>
                                <input
                                    id="dni"
                                    v-model="form.dni"
                                    type="password"
                                    required
                                    class="block w-full rounded-2xl border-2 border-slate-100 py-4 pr-4 pl-12 font-sans text-sm font-medium transition-all placeholder:text-slate-300 focus:border-primary focus:ring-0"
                                    placeholder="Ingresa tu contraseña"
                                />
                            </div>
                            <p
                                v-if="form.errors.dni"
                                class="mt-2 flex items-center gap-1 text-xs font-bold text-red-600"
                            >
                                <AlertCircle class="h-3 w-3" />
                                {{ form.errors.dni }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="group relative flex w-full justify-center rounded-2xl border border-transparent bg-primary px-4 py-4 text-sm font-black tracking-[0.2em] text-white uppercase shadow-lg shadow-primary/20 transition-all hover:bg-slate-900 focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:outline-none disabled:opacity-50"
                        >
                            <span v-if="form.processing">Ingresando...</span>
                            <span v-else>Entrar al Aula</span>
                        </button>
                    </div>

                    <div
                        class="flex items-start gap-3 rounded-2xl border border-blue-100 bg-blue-50 p-4"
                    >
                        <Info class="mt-0.5 h-5 w-5 shrink-0 text-blue-500" />
                        <p
                            class="text-xs leading-relaxed font-medium text-blue-700"
                        >
                            Sus credenciales le llegaron a su correo electrónico
                            registrado.
                        </p>
                    </div>
                </form>

                <div class="mt-10 border-t border-slate-50 pt-8 text-center">
                    <p
                        class="font-sans text-[10px] font-bold tracking-widest text-slate-400 uppercase"
                    >
                        ¿Tienes problemas para ingresar?
                    </p>
                    <a
                        href="https://wa.me/51997161347"
                        target="_blank"
                        class="mt-2 inline-flex items-center gap-2 text-[10px] font-black tracking-widest text-primary uppercase transition-colors hover:text-slate-900"
                    >
                        Soporte Técnico Guber
                    </a>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
