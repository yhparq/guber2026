<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogTitle,
} from '@/components/ui/dialog';
import Autoplay from 'embla-carousel-autoplay';
import emblaCarouselVue from 'embla-carousel-vue';
import { Award, MapPin, User } from 'lucide-vue-next';
import { VisuallyHidden } from 'reka-ui';
import { ref } from 'vue';

const [emblaRef] = emblaCarouselVue(
    {
        loop: true,
        align: 'start',
        slidesToScroll: 1,
        breakpoints: {
            '(min-width: 640px)': { slidesToScroll: 2 },
            '(min-width: 768px)': { slidesToScroll: 3 },
            '(min-width: 1024px)': { slidesToScroll: 4 },
        },
    },
    [Autoplay({ delay: 4000, stopOnInteraction: false })],
);

const speakers = [
    {
        name: 'MBA. Oscar Gustavo Núñez Del Arco Mendoza',
        role: 'Director General de Contabilidad Pública - MEF',
        topic: 'Avance de la Reforma del Sistema Nacional de Contabilidad.',
        label: 'Nacional',
        image: '/media/ponentes/OSCAR NUÑEZ.png',
        flyer: '/media/ponentes/flayers/OSCAR-GUSTAVO.png',
    },
    {
        name: 'Mg. Abg. Cesar Enrique Aguilar Surichaqui',
        role: 'Contralor General de la República',
        topic: 'Responsabilidad administrativa funcional en la Gestión Pública.',
        label: 'Nacional',
        image: '/media/ponentes/CESAR SURICHAQUI.png',
        flyer: '/media/ponentes/flayers/MG-ABG-CESAR.png',
    },
    {
        name: 'Mg. Judith Tania Apaza Marca',
        role: 'Miembro IPSASB/ IFAC (Bolivia)',
        topic: 'Contabilidad de Software y Activos Intangibles generados internamente, revisión de su vida útil, deterioro y obsolescencia tecnológica.',
        label: 'Internacional',
        image: '/media/ponentes/JUDITH APAZA.png',
        flyer: '/media/ponentes/flayers/MG.-JUDITH-BOLIVIA.png',
    },
    {
        name: 'CPA. Agustina Llambi',
        role: 'Directora del IPSASB (Canadá)',
        topic: 'Últimas NICSP y desafíos de la contabilidad gubernamental hacia la transparencia, control y el cumplimiento ético en la presentación de rendición de cuentas.',
        label: 'Internacional',
        image: '/media/ponentes/AGUSTINA LLAMBI.png',
        flyer: '/media/ponentes/flayers/CPA.-AGUSTINA.png',
    },
    {
        name: 'CPC. Loli Jhover Chávez Cabrera',
        role: 'Director General de Presupuesto Público MEF',
        topic: 'Planeamiento estratégico en el Sector Público: Los Programas Presupuestales y su asociación con el cumplimiento de los ODS 2023.',
        label: 'Nacional',
        image: '/media/ponentes/LOLI CHAVEZ.png',
        flyer: '/media/ponentes/flayers/CPC-LOLY.png',
    },
    {
        name: 'Abog. Laura Lisset Gutiérrez Gonzales',
        role: 'Past presidente ejecutiva del OSCE-MEF',
        topic: 'Nueva Ley de Contrataciones, modificaciones y su incidencia en la Programación Multianual de Bienes Servicios y Obras.',
        label: 'Nacional',
        image: '/media/ponentes/LAURA GUTIERREZ.png',
        flyer: '/media/ponentes/flayers/Abg-Laura-Lisset (1).png',
    },
    {
        name: 'Dr. CPC. Marlon Ivan Prieto Hormaza',
        role: 'Especialista Normativo de la DGCP-MEF',
        topic: 'Liquidación y transferencia de proyectos de inversión pública, y tratamiento contable de obras paralizadas bajo el marco NICSP.',
        label: 'Nacional',
        image: '/media/ponentes/MARLON PRIETO.png',
        flyer: '/media/ponentes/flayers/Dr.-CPC.-Marlon-Prieto.png',
    },
    {
        name: 'Dr. Alexei Estrella Morales',
        role: 'Vicepresidente del Comité Sector Público AIC (Ecuador)',
        topic: 'Experiencias y buenas prácticas de Gestión Pública en el proceso de transición al marco NIC-SP de Ecuador.',
        label: 'Internacional',
        image: '/media/ponentes/ALEXEI ESTRELLA.png',
        flyer: '/media/ponentes/flayers/Dr.-Alexei.png',
    },
    {
        name: 'Mg. CPC. Juan Francisco Martin Aranibar Romero',
        role: 'Presidente del Comité Técnico de Contabilidad Gubernamental JDCCPP',
        topic: 'Toma de Inventario Físicos valorizados y conciliación contable de elementos de Propiedades, Planta y Equipo, Inventarios y Otras Cuentas del Activo, bajo el marco NIC-SP.',
        label: 'Nacional',
        image: '/media/ponentes/JUAN ARANIBAR.png',
        flyer: '/media/ponentes/flayers/CPC-JUAN-FRANCISCO.png',
    },
    {
        name: 'MBA. Jesús Araya Zúniga',
        role: 'Jefe en la Dirección General de Contabilidad Nacional (Costa Rica)',
        topic: 'Contabilidad de la Biodiversidad, Recursos Naturales e Implicancias del cambio climático hacia la sostenibilidad de las Finanzas Públicas.',
        label: 'Internacional',
        image: '/media/ponentes/JESUS ARAYA.png',
        flyer: '/media/ponentes/flayers/MBA-JESUS-ARAYA.png',
    },
    {
        name: 'CPC. Juan Pablo Diaz Soria',
        role: 'Director de Normatividad de la DGCP',
        topic: 'Marco Contable Simplificado para entidades menos complejas del Sector Público.',
        label: 'Nacional',
        image: '/media/ponentes/JUAN DIAZ.png',
        flyer: '/media/ponentes/flayers/CPC-JUAN-PABLO.png',
    },
    {
        name: 'Mg. Jesús Ruitón Cabanillas',
        role: 'Past Director de Inversión Pública del MEF',
        topic: 'Modernización de la Gestión de la Inversión Pública y su articulación con los planes de desarrollo territorial hacia la creación de valor público.',
        label: 'Nacional',
        image: '/media/ponentes/JESUS RUITON.png',
        flyer: '/media/ponentes/flayers/Mg-Jesus-Ruiton.png',
    },
];

const isOpen = ref(false);
const selectedSpeaker = ref<(typeof speakers)[0] | null>(null);

const openSpeakerModal = (speaker: (typeof speakers)[0]) => {
    selectedSpeaker.value = speaker;
    isOpen.value = true;
};
</script>

<template>
    <section
        id="speakers"
        class="overflow-hidden border-t border-gray-100 bg-slate-50 py-24 text-center"
    >
        <div class="container mx-auto px-4">
            <div class="mb-16">
                <span
                    class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                    >Plana Académica</span
                >
                <h2
                    class="mb-6 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                >
                    EXPOSITORES <span class="text-primary">DESTACADOS</span>
                </h2>
                <div
                    class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                ></div>
                <p
                    class="mx-auto max-w-2xl font-sans text-lg font-medium text-gray-600"
                >
                    Contamos con la presencia de reconocidos especialistas de
                    trayectoria nacional e internacional.
                </p>
            </div>

            <!-- Carousel Container -->
            <div class="embla overflow-hidden" ref="emblaRef">
                <div class="-ml-6 flex py-10">
                    <!-- Slides -->
                    <div
                        v-for="(speaker, index) in speakers"
                        :key="index"
                        class="flex min-w-0 flex-[0_0_85%] items-stretch pl-6 sm:flex-[0_0_50%] md:flex-[0_0_33%] lg:flex-[0_0_25%]"
                    >
                        <div
                            @click="openSpeakerModal(speaker)"
                            class="group relative flex h-full w-full cursor-pointer flex-col items-center rounded-[3rem] border border-slate-100 bg-white p-10 shadow-sm transition-all duration-500 hover:-translate-y-4 hover:shadow-2xl"
                        >
                            <!-- Avatar Container -->
                            <div
                                class="relative mb-10 shrink-0 transform transition-transform duration-500 group-hover:scale-105"
                            >
                                <div
                                    class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-[3.5rem] border-8 border-white bg-slate-50 shadow-xl transition-all duration-500 group-hover:border-primary/5 lg:h-48 lg:w-48"
                                >
                                    <img
                                        v-if="speaker.image"
                                        :src="speaker.image"
                                        :alt="speaker.name"
                                        class="h-full w-full object-cover"
                                    />
                                    <User
                                        v-else
                                        class="h-20 w-20 text-slate-200 transition-colors duration-500 group-hover:text-primary/40"
                                    />
                                </div>
                                <div
                                    class="absolute -right-2 -bottom-2 transform rounded-2xl bg-brand-yellow p-3 text-white shadow-lg transition-all duration-500 group-hover:rotate-12"
                                >
                                    <Award class="h-5 w-5" />
                                </div>
                            </div>

                            <!-- Speaker Info -->
                            <div
                                class="flex w-full flex-1 flex-col text-center"
                            >
                                <div
                                    class="mb-2 flex min-h-[80px] items-center justify-center"
                                >
                                    <h3
                                        class="font-heading text-lg leading-tight font-bold text-slate-900 uppercase lg:text-xl"
                                    >
                                        {{ speaker.name }}
                                    </h3>
                                </div>

                                <div
                                    class="mb-8 flex min-h-[70px] items-center justify-center"
                                >
                                    <p
                                        class="text-[10px] leading-relaxed font-bold tracking-[0.2em] text-primary uppercase lg:text-[11px]"
                                    >
                                        {{ speaker.role }}
                                    </p>
                                </div>

                                <div
                                    class="mt-auto w-full border-t border-slate-50 pt-6"
                                >
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-slate-50 px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-400 uppercase transition-colors duration-500 group-hover:bg-primary/5 group-hover:text-primary"
                                    >
                                        <MapPin class="h-3 w-3" />
                                        {{ speaker.label }}
                                    </span>
                                </div>
                            </div>

                            <!-- Subtle background decoration -->
                            <div
                                class="absolute top-0 right-0 -z-10 h-32 w-32 rounded-bl-[6rem] bg-primary/5 transition-colors duration-500 group-hover:bg-primary/10"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Speaker Modal -->
            <Dialog v-model:open="isOpen">
                <DialogContent
                    class="w-[90vw] max-w-[95vw] overflow-hidden rounded-[2rem] border-0 bg-white p-0 sm:max-w-4xl"
                >
                    <div
                        v-if="selectedSpeaker"
                        class="flex max-h-[90vh] flex-col"
                    >
                        <VisuallyHidden>
                            <DialogTitle>{{
                                selectedSpeaker.name
                            }}</DialogTitle>
                            <DialogDescription>{{
                                selectedSpeaker.role
                            }}</DialogDescription>
                        </VisuallyHidden>

                        <!-- Content (Scrollable) -->
                        <div class="overflow-y-auto">
                            <!-- Flyer / Additional Info -->
                            <div
                                v-if="selectedSpeaker.flyer"
                                class="flex justify-center"
                            >
                                <img
                                    :src="selectedSpeaker.flyer"
                                    :alt="`Afiche de ${selectedSpeaker.name}`"
                                    class="h-auto max-h-[90vh] w-full object-contain"
                                />
                            </div>

                            <!-- Placeholder if no flyer but has image -->
                            <div
                                v-else-if="selectedSpeaker.image"
                                class="flex justify-center p-10"
                            >
                                <img
                                    :src="selectedSpeaker.image"
                                    :alt="selectedSpeaker.name"
                                    class="h-64 w-64 rounded-full border-4 border-white object-cover shadow-md"
                                />
                            </div>
                        </div>
                    </div>
                </DialogContent>
            </Dialog>
        </div>
    </section>
</template>

<style scoped>
.embla {
    cursor: grab;
}
.embla:active {
    cursor: grabbing;
}
</style>
