<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { CheckCircle, X } from 'lucide-vue-next';

defineProps<{
    isOpen: boolean;
    category: any;
}>();

const emit = defineEmits(['close']);

function closeModal() {
    emit('close');
}
</script>

<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-50">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/75 backdrop-blur-sm" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white text-left align-middle shadow-xl transition-all"
                        >
                            <!-- Header -->
                            <div
                                class="flex items-center justify-between bg-primary p-6"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="font-heading text-2xl font-bold text-white"
                                >
                                    Beneficios: {{ category?.title }}
                                </DialogTitle>
                                <button
                                    @click="closeModal"
                                    class="text-white transition-colors hover:text-brand-yellow"
                                >
                                    <X class="h-6 w-6" />
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="grid gap-8 p-6 md:grid-cols-2 md:p-8">
                                <!-- Presencial -->
                                <div
                                    class="rounded-xl border border-gray-100 bg-gray-50 p-6"
                                >
                                    <h4
                                        class="mb-4 flex items-center gap-2 font-heading text-xl font-bold text-primary"
                                    >
                                        <span
                                            class="h-8 w-2 rounded-full bg-brand-yellow"
                                        ></span>
                                        Modalidad Presencial
                                    </h4>
                                    <ul class="space-y-3">
                                        <li
                                            v-for="(benefit, idx) in category
                                                ?.benefits?.presencial"
                                            :key="idx"
                                            class="flex items-start gap-3 text-sm text-gray-700"
                                        >
                                            <CheckCircle
                                                class="mt-0.5 h-5 w-5 shrink-0 text-primary"
                                            />
                                            <span>{{ benefit }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Virtual -->
                                <div
                                    class="rounded-xl border border-gray-100 bg-gray-50 p-6"
                                >
                                    <h4
                                        class="mb-4 flex items-center gap-2 font-heading text-xl font-bold text-black"
                                    >
                                        <span
                                            class="h-8 w-2 rounded-full bg-gray-400"
                                        ></span>
                                        Modalidad Virtual
                                    </h4>
                                    <ul class="space-y-3">
                                        <li
                                            v-for="(benefit, idx) in category
                                                ?.benefits?.virtual"
                                            :key="idx"
                                            class="flex items-start gap-3 text-sm text-gray-700"
                                        >
                                            <CheckCircle
                                                class="mt-0.5 h-5 w-5 shrink-0 text-gray-400"
                                            />
                                            <span>{{ benefit }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="flex justify-end bg-gray-50 p-6">
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-full border border-transparent bg-primary px-6 py-2 text-sm font-bold text-white transition-colors hover:bg-primary/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
                                    @click="closeModal"
                                >
                                    Entendido
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
