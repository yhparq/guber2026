<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { X, CheckCircle } from 'lucide-vue-next';

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
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white text-left align-middle shadow-xl transition-all">
                            <!-- Header -->
                            <div class="bg-primary p-6 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-2xl font-heading font-bold text-white">
                                    Beneficios: {{ category?.title }}
                                </DialogTitle>
                                <button @click="closeModal" class="text-white hover:text-brand-yellow transition-colors">
                                    <X class="w-6 h-6" />
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="p-6 md:p-8 grid md:grid-cols-2 gap-8">
                                <!-- Presencial -->
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                                    <h4 class="text-xl font-heading font-bold text-primary mb-4 flex items-center gap-2">
                                        <span class="w-2 h-8 bg-brand-yellow rounded-full"></span>
                                        Modalidad Presencial
                                    </h4>
                                    <ul class="space-y-3">
                                        <li v-for="(benefit, idx) in category?.benefits?.presencial" :key="idx" class="flex items-start gap-3 text-sm text-gray-700">
                                            <CheckCircle class="w-5 h-5 text-primary shrink-0 mt-0.5" />
                                            <span>{{ benefit }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Virtual -->
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                                    <h4 class="text-xl font-heading font-bold text-black mb-4 flex items-center gap-2">
                                        <span class="w-2 h-8 bg-gray-400 rounded-full"></span>
                                        Modalidad Virtual
                                    </h4>
                                    <ul class="space-y-3">
                                        <li v-for="(benefit, idx) in category?.benefits?.virtual" :key="idx" class="flex items-start gap-3 text-sm text-gray-700">
                                            <CheckCircle class="w-5 h-5 text-gray-400 shrink-0 mt-0.5" />
                                            <span>{{ benefit }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="bg-gray-50 p-6 flex justify-end">
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-full border border-transparent bg-primary px-6 py-2 text-sm font-bold text-white hover:bg-primary/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-colors"
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