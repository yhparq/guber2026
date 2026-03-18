<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { CheckCircle2, X } from 'lucide-vue-next';

defineProps<{
    isOpen: boolean;
    axis: any;
}>();

defineEmits(['close']);
</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-3xl border border-gray-100 bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
                        >
                            <div v-if="axis">
                                <!-- Header Image -->
                                <div
                                    class="relative h-48 w-full overflow-hidden"
                                >
                                    <img
                                        :src="axis.image"
                                        :alt="axis.category"
                                        class="h-full w-full object-cover"
                                    />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"
                                    ></div>
                                    <div
                                        class="absolute right-6 bottom-4 left-6"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-yellow text-sm font-bold text-white shadow-md"
                                            >
                                                {{ axis.number }}
                                            </div>
                                            <DialogTitle
                                                as="h3"
                                                class="font-heading text-xl leading-6 font-bold text-white uppercase drop-shadow-md"
                                            >
                                                {{ axis.category }}
                                            </DialogTitle>
                                        </div>
                                    </div>
                                    <button
                                        @click="$emit('close')"
                                        class="absolute top-4 right-4 rounded-full bg-white/20 p-1 text-white backdrop-blur-sm transition-colors hover:bg-white/40"
                                    >
                                        <X class="h-5 w-5" />
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="p-8">
                                    <div class="mb-6">
                                        <h4
                                            class="mb-3 flex items-center gap-2 text-sm font-bold tracking-wider text-primary uppercase"
                                        >
                                            <component
                                                :is="axis.icon"
                                                class="h-4 w-4"
                                            />
                                            Descripción General
                                        </h4>
                                        <p
                                            class="font-sans text-sm leading-relaxed text-gray-600"
                                        >
                                            Este eje aborda en profundidad los
                                            desafíos y oportunidades actuales,
                                            proporcionando herramientas
                                            prácticas y conocimientos
                                            actualizados para una gestión
                                            pública eficiente y transparente.
                                        </p>
                                    </div>

                                    <div>
                                        <h4
                                            class="mb-4 text-sm font-bold tracking-wider text-primary uppercase"
                                        >
                                            Temas a Tratar
                                        </h4>
                                        <ul class="space-y-3">
                                            <li
                                                v-for="(
                                                    item, index
                                                ) in axis.items"
                                                :key="index"
                                                class="flex items-start gap-3 rounded-xl bg-slate-50 p-3 transition-colors hover:bg-slate-100"
                                            >
                                                <CheckCircle2
                                                    class="mt-0.5 h-5 w-5 shrink-0 text-brand-yellow"
                                                />
                                                <span
                                                    class="text-sm font-medium text-gray-700"
                                                    >{{ item }}</span
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div
                                    class="flex flex-row-reverse bg-gray-50 px-6 py-4 sm:px-8"
                                >
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-xl bg-primary px-6 py-3 text-sm font-bold tracking-wide text-white uppercase shadow-sm transition-colors hover:bg-slate-900 sm:w-auto"
                                        @click="$emit('close')"
                                    >
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
