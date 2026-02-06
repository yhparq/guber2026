<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { X, CheckCircle2 } from 'lucide-vue-next';

defineProps<{
    isOpen: boolean;
    axis: any;
}>();

defineEmits(['close']);
</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/60 transition-opacity backdrop-blur-sm" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">
                            <div v-if="axis">
                                <!-- Header Image -->
                                <div class="relative h-48 w-full overflow-hidden">
                                    <img :src="axis.image" :alt="axis.category" class="h-full w-full object-cover" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                    <div class="absolute bottom-4 left-6 right-6">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-brand-yellow text-white w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm shadow-md">
                                                {{ axis.number }}
                                            </div>
                                            <DialogTitle as="h3" class="text-xl font-heading font-bold leading-6 text-white uppercase drop-shadow-md">
                                                {{ axis.category }}
                                            </DialogTitle>
                                        </div>
                                    </div>
                                    <button @click="$emit('close')" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full p-1 transition-colors backdrop-blur-sm">
                                        <X class="w-5 h-5" />
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="p-8">
                                    <div class="mb-6">
                                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                                            <component :is="axis.icon" class="w-4 h-4" />
                                            Descripción General
                                        </h4>
                                        <p class="text-gray-600 text-sm leading-relaxed font-sans">
                                            Este eje aborda en profundidad los desafíos y oportunidades actuales, proporcionando herramientas prácticas y conocimientos actualizados para una gestión pública eficiente y transparente.
                                        </p>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider mb-4">Temas a Tratar</h4>
                                        <ul class="space-y-3">
                                            <li v-for="(item, index) in axis.items" :key="index" class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                                                <CheckCircle2 class="w-5 h-5 text-brand-yellow shrink-0 mt-0.5" />
                                                <span class="text-gray-700 text-sm font-medium">{{ item }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse sm:px-8">
                                    <button type="button" class="inline-flex w-full justify-center rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-slate-900 sm:w-auto transition-colors uppercase tracking-wide" @click="$emit('close')">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>