<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { X, CheckCircle, Award, Eye, GraduationCap } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    isOpen: boolean;
}>();

const emit = defineEmits(['close']);

function closeModal() {
    emit('close');
}

const activeTab = ref(0);

const categories = [
    {
        title: "PLENOS",
        icon: Award,
        description: "Contadores Públicos inscritos en su respectivo Colegio Departamental.",
        price: "S/ 300.00",
        benefits: {
            presencial: [
                "12 conferencias magistrales", "Credencial", "Coffee break", "Mochila GUBER", "Block de notas GUBER", "Folder GUBER", "Lapicero", "Jueves 23: Noche Madrediosense", "Viernes 24: Noche Deportiva", "Sábado 25: Almuerzo de Confraternidad", "Acceso a Aula Virtual y la información completa", "Certificado"
            ],
            virtual: [
                "12 conferencias magistrales", "Acceso a Aula Virtual", "Certificado"
            ]
        }
    },
    {
        title: "OBSERVADORES",
        icon: Eye,
        description: "Empresarios, profesionales, bachilleres, egresados y público interesado.",
        price: "S/ 250.00",
        benefits: {
            presencial: [
                "12 conferencias magistrales", "Credencial", "Coffee break", "Bolsa GUBER", "Block de Notas GUBER", "Folder GUBER", "Lapicero", "Jueves 23: Noche Madrediosense", "Viernes 24: Noche Deportiva", "Acceso a Aula Virtual y la información completa", "Certificado"
            ],
            virtual: [
                "12 conferencias magistrales", "Acceso a Aula Virtual", "Certificado"
            ]
        }
    },
    {
        title: "ESTUDIANTES",
        icon: GraduationCap,
        description: "Estudiantes de nivel superior en Ciencias Contables y afines.",
        price: "S/ 150.00",
        benefits: {
            presencial: [
                "12 conferencias magistrales", "Credencial", "Coffee break", "Bolsa GUBER", "Block de notas GUBER", "Lapicero", "Jueves 23: Noche Madrediosense", "Viernes 24: Noche Deportiva", "Acceso a Aula Virtual y la información completa", "Certificado"
            ],
            virtual: [
                "12 conferencias magistrales", "Acceso a Aula Virtual", "Certificado"
            ]
        }
    }
];
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
                            <div class="bg-gray-900 p-6 flex justify-between items-center border-b border-gray-800">
                                <DialogTitle as="h3" class="text-xl md:text-2xl font-black text-white flex items-center gap-3">
                                    <Award class="w-6 h-6 text-brand-yellow" />
                                    CATEGORÍAS DE INSCRIPCIÓN
                                </DialogTitle>
                                <button @click="closeModal" class="text-white hover:text-brand-yellow transition-colors bg-white/10 p-2 rounded-full hover:bg-white/20">
                                    <X class="w-5 h-5" />
                                </button>
                            </div>

                            <!-- Tabs Header -->
                            <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                                <button 
                                    v-for="(cat, index) in categories" 
                                    :key="index"
                                    @click="activeTab = index"
                                    class="flex-1 py-4 px-6 text-sm md:text-base font-bold transition-all whitespace-nowrap flex items-center justify-center gap-2 border-b-4"
                                    :class="activeTab === index ? 'border-primary text-primary bg-white' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                                >
                                    <component :is="cat.icon" class="w-5 h-5" :class="activeTab === index ? 'text-primary' : 'text-gray-400'" />
                                    {{ cat.title }}
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="p-6 md:p-8">
                                <div class="mb-8 text-center">
                                    <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ categories[activeTab].title }}</h4>
                                    <p class="text-gray-600 max-w-2xl mx-auto">{{ categories[activeTab].description }}</p>
                                    <div class="mt-4 inline-block bg-primary/10 text-primary px-6 py-2 rounded-full font-black text-2xl border border-primary/20">
                                        {{ categories[activeTab].price }}
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-8">
                                    <!-- Presencial -->
                                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
                                        <h4 class="text-lg font-bold text-primary mb-4 flex items-center gap-2 border-b border-gray-200 pb-3">
                                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                                            Beneficios Presenciales
                                        </h4>
                                        <ul class="space-y-3">
                                            <li v-for="(benefit, idx) in categories[activeTab].benefits.presencial" :key="idx" class="flex items-start gap-3 text-sm text-gray-700">
                                                <CheckCircle class="w-4 h-4 text-primary shrink-0 mt-0.5" />
                                                <span class="leading-tight">{{ benefit }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Virtual -->
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md transition-shadow">
                                        <h4 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                                            <span class="w-1.5 h-6 bg-gray-400 rounded-full"></span>
                                            Beneficios Virtuales
                                        </h4>
                                        <ul class="space-y-3">
                                            <li v-for="(benefit, idx) in categories[activeTab].benefits.virtual" :key="idx" class="flex items-start gap-3 text-sm text-gray-600">
                                                <CheckCircle class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" />
                                                <span class="leading-tight">{{ benefit }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="bg-gray-50 p-6 flex justify-end">
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-xl border border-transparent bg-gray-900 px-8 py-3 text-sm font-bold text-white hover:bg-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 transition-all shadow-lg hover:shadow-xl"
                                    @click="closeModal"
                                >
                                    Cerrar
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>