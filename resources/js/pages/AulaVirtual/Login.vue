<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { Mail, CreditCard, LogIn, AlertCircle } from 'lucide-vue-next';
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
        <div class="min-h-[80vh] flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-[2.5rem] shadow-2xl border border-slate-100">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-primary/10 text-primary mb-6 shadow-inner">
                        <LogIn class="w-10 h-10" />
                    </div>
                    <h2 class="text-4xl font-heading font-bold text-slate-900 uppercase tracking-tighter mb-2">
                        Aula <span class="text-primary">Virtual</span>
                    </h2>
                    <p class="text-sm font-sans font-medium text-slate-500 uppercase tracking-widest">
                        Ingresa con tus datos de registro
                    </p>
                </div>

                <form class="mt-8 space-y-6" @submit.prevent="submit">
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Correo Electrónico</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                    <Mail class="h-5 w-5" />
                                </div>
                                <input id="email" v-model="form.email" type="email" required 
                                    class="block w-full pl-12 pr-4 py-4 border-2 border-slate-100 rounded-2xl focus:ring-0 focus:border-primary transition-all font-sans text-sm font-medium placeholder:text-slate-300" 
                                    placeholder="ejemplo@correo.com"
                                />
                            </div>
                            <p v-if="form.errors.email" class="mt-2 text-xs text-red-600 font-bold flex items-center gap-1">
                                <AlertCircle class="w-3 h-3" /> {{ form.errors.email }}
                            </p>
                        </div>

                        <div>
                            <label for="dni" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">DNI / Documento</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                    <CreditCard class="h-5 w-5" />
                                </div>
                                <input id="dni" v-model="form.dni" type="text" required 
                                    class="block w-full pl-12 pr-4 py-4 border-2 border-slate-100 rounded-2xl focus:ring-0 focus:border-primary transition-all font-sans text-sm font-medium placeholder:text-slate-300" 
                                    placeholder="Ingresa tu DNI"
                                />
                            </div>
                            <p v-if="form.errors.dni" class="mt-2 text-xs text-red-600 font-bold flex items-center gap-1">
                                <AlertCircle class="w-3 h-3" /> {{ form.errors.dni }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <button type="submit" :disabled="form.processing"
                            class="group relative w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl text-sm font-black uppercase tracking-[0.2em] text-white bg-primary hover:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all shadow-lg shadow-primary/20 disabled:opacity-50"
                        >
                            <span v-if="form.processing">Ingresando...</span>
                            <span v-else>Entrar al Aula</span>
                        </button>
                    </div>
                </form>

                <div class="mt-10 pt-8 border-t border-slate-50 text-center">
                    <p class="text-[10px] font-sans font-bold text-slate-400 uppercase tracking-widest">
                        ¿Tienes problemas para ingresar?
                    </p>
                    <a href="https://wa.me/51997161347" target="_blank" class="mt-2 inline-flex items-center gap-2 text-primary font-black uppercase text-[10px] tracking-widest hover:text-slate-900 transition-colors">
                        Soporte Técnico Guber
                    </a>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
