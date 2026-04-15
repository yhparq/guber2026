<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Autoplay from 'embla-carousel-autoplay';
import emblaCarouselVue from 'embla-carousel-vue';
import {
    ArrowRight,
    Award,
    BarChart3,
    BookOpen,
    Calculator,
    CheckCircle,
    CreditCard,
    DollarSign,
    Eye,
    FileDown,
    FileText,
    FlaskConical,
    GraduationCap,
    Images,
    Leaf,
    MapPin,
    QrCode,
    Quote,
} from 'lucide-vue-next';
import { ref } from 'vue';

import AxisModal from '@/components/AxisModal.vue';
import BenefitsModal from '@/components/BenefitsModal.vue';
import EventCountdown from '@/components/EventCountdown.vue';
import ResearchPapers from '@/components/ResearchPapers.vue';
import SpeakersCarousel from '@/components/SpeakersCarousel.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';

defineProps<{
    canRegister: boolean;
    photos: Array<{ id: number; title: string; path: string }>;
}>();

const [emblaRef] = emblaCarouselVue({ loop: true }, [
    Autoplay({ delay: 4000 }),
]);
const [topicsRef] = emblaCarouselVue(
    {
        loop: true,
        align: 'start',
        slidesToScroll: 1,
        breakpoints: {
            '(min-width: 768px)': { slidesToScroll: 2 },
            '(min-width: 1024px)': { slidesToScroll: 3 },
        },
    },
    [Autoplay({ delay: 5000, stopOnInteraction: false })],
);

const sponsorsRef = emblaCarouselVue(
    {
        loop: true,
        align: 'start',
        slidesToScroll: 1,
        containScroll: false,
    },
    [Autoplay({ delay: 2000, stopOnInteraction: false, playOnInit: true })],
)[0];

const sponsorsList = [
    '1.png',
    '2.png',
    '3.png',
    '4.jpg',
    '5.png',
    '5.1.png',
    '6.jpeg',
    '6.1.png',
    '7.png',
    '8.png',
    '9.png',
    '10.jpg',
    '11.png',
    '12.png',
    '13.jpg',
    '14.jpeg',
    '15.png',
    '16.jpeg',
    '18.jpg',
    '19.jpg',
];

const thematicAxes = [
    {
        number: '01',
        category: 'EJE TEMÁTICO Nº 01:',
        title: 'Modernización de la Administración Financiera del Sector Público',
        description:
            'Enfoque en el planeamiento estratégico y la optimización de los recursos públicos bajo la nueva normativa.',
        image: '/media/imgs/img1.webp',
        icon: BarChart3,
        items: [
            'Planeamiento estratégico en el Sector Público: Los Programas Presupuestales y su asociación con el cumplimiento de los ODS 2023.',
            'Modernización de la Gestión de la Inversión Pública y su articulación con los planes de desarrollo territorial hacia la creación de valor público.',
            'Nueva Ley de Contrataciones, modificaciones y su incidencia en la Programación Multianual de Bienes Servicios y Obras.',
            'Nuevas operaciones de tesorería gubernamental y últimas disposiciones emitidas por la DGTP y su aplicación en el nuevo SIAF WEB.',
        ],
    },
    {
        number: '02',
        category: 'EJE TEMÁTICO Nº 02:',
        title: 'Contabilidad Gubernamental y Adopción plena del marco NIC-SP',
        description:
            'Transición hacia estándares internacionales de contabilidad para una rendición de cuentas transparente.',
        image: '/media/imgs/img2.webp',
        icon: Calculator,
        items: [
            'Modernización del Sistema Nacional de Contabilidad hacia la adopción de plenas del marco de las NIC-SP y nuevo SIAF Web - Modulo Contable.',
            'Contabilidad de Software y Activos Intangibles generados internamente, revisión de su vida útil, deterioro y obsolescencia tecnológica.',
            'Liquidación y transferencia de proyectos de inversión pública, y tratamiento contable de obras paralizadas bajo el marco NICSP.',
            'Toma de Inventario Físicos valorizados y conciliación contable de elementos de Propiedades, Planta y Equipo, Inventarios y Otras Cuentas del Activo, bajo el marco NIC-SP.',
            'Experiencias y buenas prácticas de Gestión Pública en el proceso de transición al marco NIC-SP de Ecuador. Y Mesa de Trabajo caso departamento de Madre de Dios.',
        ],
    },
    {
        number: '03',
        category: 'EJE TEMÁTICO Nº 03:',
        title: 'Gestión para el Desarrollo Sostenible',
        description:
            'Integración de la ética y la sostenibilidad en la toma de decisiones de la gestión pública moderna.',
        image: '/media/imgs/img3.webp',
        icon: Leaf,
        items: [
            'Contabilidad de la Biodiversidad, Recursos Naturales e implicancias del cambio climático hacia la sostenibilidad de las Finanzas Públicas.',
            'Últimas NICSP y desafíos de la contabilidad gubernamental hacia la transparencia, control y el cumplimiento ético en la presentación de rendición de cuentas. (Tema respecto a ética).',
            'Responsabilidad administrativa funcional en la Gestión Pública.',
        ],
    },
];

const pricingCategories = [
    {
        title: 'PLENOS',
        icon: Award,
        description:
            'Contadores Públicos inscritos en su respectivo Colegio Departamental. Participan con todos los derechos y obligaciones.',
        price: 'S/ 300.00',
        benefits: {
            presencial: [
                '12 conferencias magistrales',
                'Credencial',
                'Coffee break',
                'Mochila GUBER',
                'Block de notas GUBER',
                'Folder GUBER',
                'Lapicero',
                'Jueves 23: Noche Madrediosense',
                'Viernes 24: Noche Deportiva',
                'Sábado 25: Almuerzo de Confraternidad',
                'Acceso a Aula Virtual y la información completa',
                'Certificado',
            ],
            virtual: [
                '12 conferencias magistrales',
                'Acceso a Aula Virtual',
                'Certificado',
            ],
        },
    },
    {
        title: 'OBSERVADORES',
        icon: Eye,
        description:
            'Empresarios, profesionales de otras ramas del conocimiento, así como los bachilleres, egresados y otras personas interesadas.',
        price: 'S/ 200.00',
        benefits: {
            presencial: [
                '12 conferencias magistrales',
                'Credencial',
                'Coffee break',
                'Bolsa GUBER',
                'Block de Notas GUBER',
                'Folder GUBER',
                'Lapicero',
                'Jueves 23: Noche Madrediosense',
                'Viernes 24: Noche Deportiva',
                'Acceso a Aula Virtual y la información completa',
                'Certificado',
            ],
            virtual: [
                '12 conferencias magistrales',
                'Acceso a Aula Virtual',
                'Certificado',
            ],
        },
    },
    {
        title: 'ESTUDIANTES',
        icon: GraduationCap,
        description:
            'Que se encuentren cursando estudios de nivel superior en Ciencias Contables y afines.',
        price: 'S/ 100.00',
        benefits: {
            presencial: [
                '12 conferencias magistrales',
                'Credencial',
                'Coffee break',
                'Bolsa GUBER',
                'Block de notas GUBER',
                'Lapicero',
                'Jueves 23: Noche Madrediosense',
                'Viernes 24: Noche Deportiva',
                'Acceso a Aula Virtual y la información completa',
                'Certificado',
            ],
            virtual: [
                '12 conferencias magistrales',
                'Acceso a Aula Virtual',
                'Certificado',
            ],
        },
    },
];

const walletMethod = {
    bank: 'Billetera Digital',
    name: 'Yape / Plin',
    info: [
        {
            label: 'A nombre de',
            value: 'COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS',
        },
        { label: 'Método', value: 'Escanear código QR' },
    ],
    qrImage: '/media/imgs/qr.png',
    colorClass: 'hover:border-[#742284] hover:shadow-[#742284]/20',
    icon: QrCode,
    iconColor: 'text-[#742284]',
};

const bankMethods = [
    {
        bank: 'BBVA Continental',
        name: 'BBVA',
        info: [
            { label: 'Cta. Cte. Soles', value: '0011-0263-0100039835' },
            { label: 'CCI', value: '01126300010003983512' },
        ],
        hoverClass:
            'hover:border-slate-900 hover:shadow-slate-900/10 hover:bg-slate-900/[0.02]',
        iconClass:
            'group-hover:bg-slate-900 group-hover:text-white group-hover:border-slate-900',
        badgeClass: 'group-hover:bg-slate-900/10 group-hover:text-slate-900',
        borderClass: 'group-hover:border-slate-900',
        icon: CreditCard,
    },
    {
        bank: 'Interbank',
        name: 'Interbank',
        info: [
            { label: 'Cta. Cte.', value: '335-300400846-2' },
            { label: 'CCI', value: '003-335-003004008462-73' },
        ],
        hoverClass:
            'hover:border-primary hover:shadow-primary/10 hover:bg-primary/[0.02]',
        iconClass:
            'group-hover:bg-primary group-hover:text-white group-hover:border-primary',
        badgeClass: 'group-hover:bg-primary/10 group-hover:text-primary',
        borderClass: 'group-hover:border-primary',
        icon: CreditCard,
    },
    {
        bank: 'Banco de Crédito',
        name: 'BCP',
        info: [
            { label: 'Cta. Cte.', value: '485-9971744-0-73' },
            { label: 'CCI', value: '002-485-009971744073-11' },
        ],
        hoverClass:
            'hover:border-brand-yellow hover:shadow-brand-yellow/10 hover:bg-brand-yellow/[0.02]',
        iconClass:
            'group-hover:bg-brand-yellow group-hover:text-white group-hover:border-brand-yellow',
        badgeClass:
            'group-hover:bg-brand-yellow/10 group-hover:text-brand-yellow',
        borderClass: 'group-hover:border-brand-yellow',
        icon: CreditCard,
    },
];

const slides = [{ image: '/media/imgs/slider1.png' }];

// Modal States
const isModalOpen = ref(false);
const selectedCategory = ref(null);

const isAxisModalOpen = ref(false);
const selectedAxis = ref(null);

const isSponsorModalOpen = ref(false);
const selectedSponsorLogo = ref<string | null>(null);

const openSponsorModal = (logo: string) => {
    selectedSponsorLogo.value = logo;
    isSponsorModalOpen.value = true;
};

const openModal = (category: any) => {
    selectedCategory.value = category;
    isModalOpen.value = true;
};

const openAxisModal = (axis: any) => {
    selectedAxis.value = axis;
    isAxisModalOpen.value = true;
};
</script>

<template>
    <Head title="Bienvenido a Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-white">
            <div class="embla w-full" ref="emblaRef">
                <div class="flex w-full">
                    <div
                        v-for="(slide, index) in slides"
                        :key="index"
                        class="relative min-w-0 flex-[0_0_100%]"
                    >
                        <img
                            :src="slide.image"
                            alt="Banner"
                            class="h-auto w-full"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Countdown Section -->
        <EventCountdown />

        <!-- About Section -->
        <section id="info" class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <div
                    class="flex flex-col items-center gap-20 text-left lg:flex-row"
                >
                    <div class="w-full lg:w-1/2">
                        <div
                            class="group relative h-0 overflow-hidden rounded-3xl border-2 border-primary/10 pb-[56.25%] shadow-2xl"
                        >
                            <iframe
                                class="absolute top-0 left-0 h-full w-full border-0"
                                src="https://www.youtube.com/embed/0iKVxhabCBA"
                                title="Madre de Dios te saluda"
                                allow="
                                    accelerometer;
                                    autoplay;
                                    clipboard-write;
                                    encrypted-media;
                                    gyroscope;
                                    picture-in-picture;
                                "
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                    <div class="lg:w-1/2 lg:pl-10">
                        <div class="mb-10">
                            <span
                                class="mb-4 block font-heading text-sm font-black tracking-[0.3em] text-brand-yellow uppercase"
                                >¡Bienvenidos!</span
                            >
                            <h2
                                class="mb-6 font-heading text-5xl leading-none font-black tracking-tighter text-slate-900 uppercase"
                            >
                                MADRE DE DIOS <br />
                                <span class="text-4xl text-primary lg:text-6xl"
                                    >TE SALUDA</span
                                >
                            </h2>
                            <div
                                class="h-1.5 w-24 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                            ></div>
                        </div>
                        <p
                            class="mb-6 text-justify font-sans text-lg leading-relaxed text-gray-700"
                        >
                            El Colegio de Contadores Públicos de Madre de Dios y
                            la Junta de Decanos de los Colegios de Contadores
                            del Perú - JDCCPP, invitan a los Contadores
                            Públicos, profesionales, servidores y funcionarios
                            públicos, estudiantes y ciudadanía, regional y
                            nacional, a participar en la
                            <strong
                                class="font-bold tracking-tight text-primary uppercase"
                                >“XI CONVENCIÓN NACIONAL DE CONTABILIDAD
                                GUBERNAMENTAL Y GESTIÓN PÚBLICA – GUBER
                                2026”</strong
                            >
                            a realizarse los días 23, 24 y 25 de abril de 2026
                            en la Capital de la Biodiversidad del Perú.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Material Section (Enhanced Colors ONLY) -->
        <section
            id="material"
            class="border-y border-slate-100 bg-slate-50 py-16"
        >
            <div class="container mx-auto px-4 text-center">
                <div class="mb-12">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                        >Recursos Académicos</span
                    >
                    <h2
                        class="mb-6 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        MATERIAL <span class="text-primary">GUBER</span>
                    </h2>
                    <div
                        class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-xl font-sans text-lg font-medium text-gray-600"
                    >
                        Descarga los documentos informativos de la Convención
                        Guber 2026.
                    </p>
                </div>

                <div
                    class="mx-auto grid max-w-4xl grid-cols-1 gap-12 md:grid-cols-2"
                >
                    <!-- Conoce Guber -->
                    <div class="group">
                        <a
                            href="/media/pdfs/conoce_guber.pdf"
                            target="_blank"
                            class="relative block aspect-[3/4] transform overflow-hidden rounded-3xl border border-black/10 bg-white shadow-2xl transition-all duration-500 group-hover:-translate-y-2"
                        >
                            <img
                                src="/media/imgs/CONOCE-GUBER-2026.png"
                                alt="Conoce Guber 2026"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-primary/10 transition-colors duration-300 group-hover:bg-transparent"
                            ></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3
                                class="mb-2 font-heading text-2xl font-bold text-black uppercase"
                            >
                                Conoce Guber 2026
                            </h3>
                            <p
                                class="mb-6 px-4 font-sans text-sm text-gray-500"
                            >
                                Detalles generales y alcances del evento.
                            </p>
                            <a
                                href="/media/pdfs/conoce_guber.pdf"
                                target="_blank"
                                class="inline-flex items-center gap-2 rounded-xl bg-primary px-8 py-3.5 font-sans text-sm font-bold text-white shadow-lg shadow-primary/30 transition-all duration-300 hover:bg-slate-900"
                            >
                                <BookOpen class="h-4 w-4" /> Descargar
                                Invitación
                            </a>
                        </div>
                    </div>

                    <!-- Programa General -->
                    <div class="group">
                        <a
                            href="/media/pdfs/programa.pdf"
                            target="_blank"
                            class="relative block aspect-[3/4] transform overflow-hidden rounded-3xl border border-black/10 bg-white shadow-2xl transition-all duration-500 group-hover:-translate-y-2"
                        >
                            <img
                                src="/media/imgs/PROGRAMA-GENERAL-GUBER.png"
                                alt="Programa General Guber"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-primary/10 transition-colors duration-300 group-hover:bg-transparent"
                            ></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3
                                class="mb-2 font-heading text-2xl font-bold text-black uppercase"
                            >
                                Programa Guber 2026
                            </h3>
                            <p
                                class="mb-6 px-4 font-sans text-sm text-gray-500"
                            >
                                Cronograma detallado de actividades.
                            </p>
                            <a
                                href="/media/pdfs/programa.pdf"
                                target="_blank"
                                class="inline-flex items-center gap-3 rounded-xl bg-slate-900 px-8 py-3.5 font-sans text-sm font-bold text-white shadow-lg transition-all duration-300 hover:bg-primary"
                            >
                                <DollarSign class="h-4 w-4" /> Descargar
                                Programa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Madre de Dios Section (Strip Style with Improved Text) -->
        <section
            class="relative overflow-hidden border-y border-white/5 bg-primary"
        >
            <div class="flex flex-col items-stretch lg:flex-row">
                <!-- Text Block (Monumental Style kept) -->
                <div
                    class="group relative flex w-full flex-col justify-center overflow-hidden bg-primary px-12 py-16 text-center lg:w-[30%] lg:text-left"
                >
                    <div class="relative z-10">
                        <span
                            class="mb-3 block font-sans text-[10px] font-black tracking-[0.4em] text-white/60 uppercase"
                            >Descubre el Paraíso</span
                        >
                        <h2
                            class="mb-6 font-heading text-4xl leading-[0.8] font-bold tracking-tighter text-white uppercase lg:text-6xl"
                        >
                            MADRE <br />
                            DE DIOS
                        </h2>
                        <div class="mb-6 h-1 w-16 bg-brand-yellow"></div>
                        <p
                            class="font-sans text-[10px] leading-relaxed font-black tracking-[0.3em] text-white uppercase italic"
                        >
                            Capital de la <br />
                            Biodiversidad del Perú
                        </p>
                    </div>
                    <!-- Decorative Background Text -->
                    <span
                        class="pointer-events-none absolute -bottom-6 -left-6 font-heading text-9xl font-black text-black/10 select-none"
                        >MDD</span
                    >
                </div>

                <!-- Gallery Strip (Original style restored) -->
                <div class="flex w-full flex-1">
                    <div
                        v-for="(img, idx) in [
                            '/media/imgs/img1.webp',
                            '/media/imgs/img2.webp',
                            '/media/imgs/img3.webp',
                            '/media/imgs/img4.jpg',
                            '/media/imgs/img5.png',
                            '/media/imgs/img6.jpg',
                        ]"
                        :key="idx"
                        class="group relative aspect-square flex-1 overflow-hidden border-l border-white/5 lg:aspect-auto"
                    >
                        <img
                            :src="img"
                            alt="Madre de Dios"
                            class="h-full w-full transform object-cover grayscale transition-all duration-1000 group-hover:scale-110 group-hover:grayscale-0"
                        />
                        <div
                            class="absolute inset-0 bg-primary/10 transition-colors duration-300 group-hover:bg-transparent"
                        ></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Investment Section -->
        <section
            id="investment"
            class="relative overflow-hidden bg-slate-50 py-24"
        >
            <!-- Decorative Background Elements -->
            <div
                class="absolute top-0 right-0 -mt-20 -mr-20 h-1/3 w-1/3 rounded-full bg-brand-yellow/5 blur-[120px]"
            ></div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 h-1/4 w-1/4 rounded-full bg-primary/5 blur-[100px]"
            ></div>

            <div class="relative z-10 container mx-auto px-4 text-center">
                <div class="mb-20">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.2em] text-brand-yellow uppercase"
                        >Participación y Costos</span
                    >
                    <h2
                        class="mb-6 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        DERECHOS DE <span class="text-primary">INVERSIÓN</span>
                    </h2>
                    <div
                        class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-3xl font-sans text-lg leading-relaxed font-medium text-gray-600"
                    >
                        Asegura tu lugar en la convención más importante de
                        gestión pública a nombre del
                        <br class="hidden md:block" />
                        <strong class="font-bold text-slate-900"
                            >Colegio de Contadores Públicos de Madre de
                            Dios</strong
                        >.
                    </p>
                </div>

                <div
                    class="mx-auto grid max-w-7xl grid-cols-1 gap-8 text-left md:grid-cols-3 lg:gap-12"
                >
                    <div
                        v-for="(category, index) in pricingCategories"
                        :key="index"
                        class="group relative flex flex-col overflow-hidden rounded-[3rem] border border-slate-100 bg-white p-10 shadow-sm transition-all duration-500 hover:-translate-y-4 hover:shadow-2xl lg:p-12"
                        :class="{
                            'z-20 scale-105 ring-4 ring-primary/10':
                                index === 1,
                        }"
                    >
                        <!-- Top Tag for Featured -->
                        <div
                            v-if="index === 1"
                            class="absolute top-0 right-0 z-10 rounded-bl-3xl bg-primary px-8 py-2 text-[10px] font-black tracking-[0.2em] text-white uppercase shadow-lg"
                        >
                            Más solicitado
                        </div>

                        <!-- Card Header -->
                        <div class="relative mb-10">
                            <div
                                class="mb-8 flex h-20 w-20 items-center justify-center rounded-3xl shadow-inner transition-all duration-500 group-hover:scale-110 group-hover:rotate-3"
                                :class="
                                    index === 1
                                        ? 'bg-primary text-white shadow-primary/20'
                                        : 'bg-slate-50 text-primary'
                                "
                            >
                                <component
                                    :is="category.icon"
                                    class="h-10 w-10"
                                />
                            </div>
                            <h3
                                class="mb-4 font-heading text-3xl leading-none font-bold tracking-tighter text-slate-900 uppercase"
                            >
                                {{ category.title }}
                            </h3>
                            <div class="mb-6 h-1 w-12 bg-brand-yellow/30"></div>
                            <p
                                class="min-h-[60px] font-sans text-sm leading-relaxed text-slate-500"
                            >
                                {{ category.description }}
                            </p>
                        </div>

                        <!-- Price Section -->
                        <div
                            class="relative mb-12 border-t border-slate-50 pt-8"
                        >
                            <div class="flex items-baseline gap-2">
                                <span
                                    class="font-heading text-5xl font-black tracking-tighter text-slate-900 lg:text-6xl"
                                    >{{ category.price }}</span
                                >
                                <span
                                    class="font-sans text-xs font-black tracking-widest text-gray-400 uppercase"
                                    >PEN</span
                                >
                            </div>
                            <!-- Background Decoration -->
                            <span
                                class="pointer-events-none absolute -right-2 -bottom-4 font-heading text-7xl font-black text-slate-50 transition-colors select-none group-hover:text-primary/5"
                                >0{{ index + 1 }}</span
                            >
                        </div>

                        <!-- Action Button -->
                        <div class="relative z-10 mt-auto">
                            <button
                                @click="openModal(category)"
                                class="group/btn flex w-full items-center justify-center gap-3 rounded-2xl py-5 font-sans text-[10px] font-black tracking-[0.2em] uppercase shadow-lg transition-all duration-300"
                                :class="
                                    index === 1
                                        ? 'bg-primary text-white shadow-primary/20 hover:bg-slate-900'
                                        : 'bg-slate-900 text-white shadow-slate-900/10 hover:bg-primary'
                                "
                            >
                                <Eye
                                    class="h-4 w-4 transition-transform group-hover/btn:scale-125"
                                />
                                Ver beneficios completos
                            </button>
                        </div>

                        <!-- Subtle background decoration shape -->
                        <div
                            class="absolute -right-10 -bottom-10 -z-10 h-40 w-40 rounded-full bg-slate-50 transition-colors duration-700 group-hover:bg-primary/5"
                        ></div>
                    </div>
                </div>

                <!-- Aditional Info Info -->
                <div
                    class="mt-20 inline-flex items-center gap-4 rounded-2xl border border-slate-100 bg-white px-8 py-4 shadow-sm"
                >
                    <CheckCircle class="h-6 w-6 text-primary" />
                    <p class="font-sans text-sm font-medium text-slate-600">
                        Todos los precios incluyen
                        <span class="font-bold text-slate-900"
                            >Certificación Oficial</span
                        >
                        y acceso a la plataforma virtual.
                    </p>
                </div>
            </div>
        </section>

        <!-- Payment Methods -->
        <section id="payments" class="relative overflow-hidden bg-white py-24">
            <!-- Decorative Pattern -->
            <div
                class="absolute top-1/2 left-0 -ml-32 h-64 w-64 -translate-y-1/2 rounded-full bg-primary/5 blur-3xl"
            ></div>

            <div class="relative z-10 container mx-auto px-4 text-center">
                <div class="mb-20">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.2em] text-brand-yellow uppercase"
                        >Canales Oficiales</span
                    >
                    <h2
                        class="mb-6 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        MEDIOS DE <span class="text-primary">PAGO</span>
                    </h2>
                    <div
                        class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-2xl font-sans text-lg font-medium text-gray-600"
                    >
                        Realiza tu pago de forma segura a través de nuestros
                        canales autorizados por el
                        <br class="hidden md:block" />
                        <strong class="text-slate-900"
                            >Colegio de Contadores Públicos de Madre de
                            Dios</strong
                        >.
                    </p>
                </div>

                <div
                    class="mx-auto flex max-w-6xl flex-col items-stretch gap-10 text-left lg:flex-row lg:gap-16"
                >
                    <!-- Digital Wallet Card -->
                    <div class="flex lg:w-5/12">
                        <div
                            class="group relative flex w-full flex-col items-center justify-between overflow-hidden rounded-[3.5rem] bg-slate-900 p-10 text-center shadow-2xl shadow-slate-900/20 lg:p-12"
                        >
                            <!-- Background Decoration -->
                            <div
                                class="absolute top-0 right-0 h-32 w-32 rounded-bl-full bg-primary/10 transition-all duration-700 group-hover:scale-150"
                            ></div>

                            <div class="relative z-10 w-full">
                                <div
                                    class="mb-10 flex items-center justify-center gap-4"
                                >
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-brand-yellow backdrop-blur-md"
                                    >
                                        <QrCode class="h-8 w-8" />
                                    </div>
                                    <div class="text-left">
                                        <h3
                                            class="font-heading text-3xl leading-none font-bold text-white uppercase"
                                        >
                                            Billetera Digital
                                        </h3>
                                        <p
                                            class="mt-1 font-sans text-[10px] font-black tracking-[0.3em] text-brand-yellow uppercase"
                                        >
                                            Yape / Plin
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="group/qr relative mb-10 rounded-[2.5rem] bg-white p-8 shadow-inner"
                                >
                                    <img
                                        :src="walletMethod.qrImage"
                                        alt="QR"
                                        class="mx-auto h-auto w-full max-w-[240px] transition-transform duration-500 group-hover/qr:scale-105"
                                    />
                                    <div
                                        class="pointer-events-none absolute inset-0 rounded-[2.5rem] border-2 border-primary/20"
                                    ></div>
                                </div>
                            </div>

                            <div
                                class="relative z-10 w-full space-y-6 border-t border-white/10 pt-8"
                            >
                                <div
                                    v-for="(info, idx) in walletMethod.info"
                                    :key="idx"
                                >
                                    <p
                                        class="mb-1 font-sans text-[10px] font-black tracking-widest text-white/40 uppercase"
                                    >
                                        {{ info.label }}
                                    </p>
                                    <p
                                        class="font-sans text-sm font-bold tracking-tight text-white uppercase"
                                    >
                                        {{ info.value }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Methods List -->
                    <div class="flex flex-col gap-6 lg:w-7/12">
                        <div
                            v-for="(method, index) in bankMethods"
                            :key="index"
                            class="group flex flex-1 items-center rounded-[2.5rem] border border-slate-100 bg-slate-50 p-8 transition-all duration-500"
                            :class="method.hoverClass"
                        >
                            <div
                                class="flex w-full flex-col items-center gap-8 md:flex-row md:items-start"
                            >
                                <!-- Bank Icon/Logo Container -->
                                <div
                                    class="flex h-20 w-20 shrink-0 items-center justify-center rounded-[2rem] border border-slate-100 bg-white text-primary shadow-sm transition-all duration-500"
                                    :class="method.iconClass"
                                >
                                    <component
                                        :is="method.icon"
                                        class="h-10 w-10"
                                    />
                                </div>

                                <div
                                    class="w-full flex-1 text-center md:text-left"
                                >
                                    <div
                                        class="mb-6 flex flex-col items-center justify-between gap-2 md:flex-row md:items-start"
                                    >
                                        <div>
                                            <h3
                                                class="font-heading text-2xl leading-none font-bold text-slate-900 uppercase"
                                            >
                                                {{ method.bank }}
                                            </h3>
                                            <p
                                                class="mt-2 font-sans text-[10px] font-black tracking-[0.2em] text-primary uppercase"
                                            >
                                                Banca Corporativa
                                            </p>
                                        </div>
                                        <span
                                            class="rounded-full bg-slate-200 px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 uppercase transition-colors"
                                            :class="method.badgeClass"
                                        >
                                            {{ method.name }}
                                        </span>
                                    </div>

                                    <div
                                        class="grid grid-cols-1 gap-6 md:grid-cols-2"
                                    >
                                        <div
                                            v-for="(info, idx) in method.info"
                                            :key="idx"
                                            class="rounded-2xl border border-slate-100 bg-white p-4 transition-all md:rounded-none md:border-0 md:border-l-4 md:bg-transparent md:p-0 md:pl-6"
                                            :class="method.borderClass"
                                        >
                                            <p
                                                class="mb-1 font-sans text-[9px] font-black tracking-widest text-slate-400 uppercase"
                                            >
                                                {{ info.label }}
                                            </p>
                                            <p
                                                class="font-mono font-sans text-sm font-bold tracking-tight text-slate-950"
                                            >
                                                {{ info.value }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badge -->
                <div
                    class="mt-20 flex items-center justify-center gap-8 opacity-40 grayscale transition-all duration-1000 hover:opacity-100 hover:grayscale-0"
                >
                    <div class="h-px w-20 bg-slate-200"></div>
                    <span
                        class="text-[10px] font-black tracking-[0.4em] text-slate-400 uppercase"
                        >Transacción 100% Protegida</span
                    >
                    <div class="h-px w-20 bg-slate-200"></div>
                </div>
            </div>
        </section>

        <!-- Motto Section -->
        <section class="group relative overflow-hidden bg-slate-900 py-12">
            <div
                class="absolute top-0 left-0 h-full w-full bg-primary/5 opacity-0 transition-opacity duration-1000 group-hover:opacity-100"
            ></div>
            <div class="relative z-10 container mx-auto px-4 text-center">
                <div class="mx-auto max-w-5xl">
                    <Quote
                        class="mx-auto mb-4 h-10 w-10 text-brand-yellow opacity-20 transition-all group-hover:opacity-100"
                    />
                    <h2
                        class="font-heading text-2xl leading-tight font-bold tracking-widest text-white uppercase opacity-30 transition-all group-hover:opacity-100 md:text-3xl"
                    >
                        "La modernización de la gestión pública hacia la
                        adopción de las
                        <span class="text-brand-yellow">NICSP</span> para el
                        desarrollo sostenible en la creación del
                        <span class="text-brand-yellow">valor público</span> en
                        el Perú"
                    </h2>
                    <div
                        class="mx-auto mt-6 h-1 w-24 scale-x-50 transform rounded-full bg-gradient-to-r from-primary to-brand-yellow opacity-0 transition-all group-hover:scale-x-150 group-hover:opacity-100"
                    ></div>
                </div>
            </div>
        </section>

        <!-- Speakers Carousel -->
        <SpeakersCarousel />

        <!-- Topics Section (TEMARIO) -->
        <section
            id="topics"
            class="overflow-visible border-t border-gray-100 bg-white py-24"
        >
            <div class="container mx-auto px-4">
                <div class="mb-20 text-center">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                        >Contenido Académico</span
                    >
                    <h2
                        class="mb-6 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        TEMARIO <span class="text-primary">GUBER</span>
                    </h2>
                    <div
                        class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-4xl font-sans text-lg leading-relaxed font-medium text-gray-600 italic"
                    >
                        “La modernización de la gestión pública hacia la
                        adopción de las NICSP para el desarrollo sostenible en
                        la creación del valor público en el Perú”
                    </p>
                </div>

                <div class="relative flex flex-col lg:flex-row">
                    <!-- Sidebar -->
                    <div
                        class="relative flex flex-col justify-between rounded-l-[3rem] border-r-4 border-brand-yellow bg-slate-900 p-12 text-white lg:w-[30%]"
                    >
                        <div class="sticky top-32">
                            <span
                                class="mb-4 block font-sans text-xs font-black tracking-[0.2em] text-brand-yellow uppercase"
                                >Ejes Temáticos</span
                            >
                            <h2
                                class="mb-8 font-heading text-5xl leading-none font-bold tracking-tighter uppercase"
                            >
                                GUBER 2026
                            </h2>
                            <div
                                class="mb-10 h-1.5 w-16 rounded-full bg-brand-yellow"
                            ></div>
                            <p
                                class="text-justify font-sans text-sm leading-relaxed font-medium text-white/60 italic"
                            >
                                Desarrollo académico integral diseñado para la
                                excelencia en la administración pública peruana.
                            </p>
                        </div>
                        <BarChart3
                            class="absolute -right-10 -bottom-10 h-48 w-48 -rotate-12 transform text-white/5"
                        />
                    </div>

                    <!-- Content (Axes - Flat/Clean Style) -->
                    <div
                        class="flex flex-col gap-24 rounded-r-[3rem] border border-l-0 border-slate-100 bg-white p-12 md:p-16 lg:w-[70%]"
                    >
                        <div
                            v-for="(axis, index) in thematicAxes"
                            :key="index"
                            class="group flex flex-col items-center gap-12 md:flex-row"
                            :class="{ 'md:flex-row-reverse': index % 2 !== 0 }"
                        >
                            <div class="w-full md:w-1/2">
                                <div
                                    class="relative aspect-[16/10] overflow-hidden rounded-2xl shadow-md transition-all duration-500 group-hover:shadow-xl"
                                >
                                    <img
                                        :src="axis.image"
                                        :alt="axis.title"
                                        class="h-full w-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                    />
                                    <div
                                        class="absolute inset-0 bg-primary/10 transition-colors duration-500 group-hover:bg-transparent"
                                    ></div>
                                    <div
                                        class="absolute right-4 bottom-4 flex h-10 w-10 items-center justify-center rounded-xl bg-white/90 text-primary shadow-sm backdrop-blur-sm"
                                    >
                                        <component
                                            :is="axis.icon"
                                            class="h-5 w-5"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="w-full text-left md:w-1/2">
                                <div class="mb-4 flex items-center gap-3">
                                    <span
                                        class="font-sans text-sm font-bold tracking-widest text-primary"
                                        >{{ axis.number }}</span
                                    >
                                    <div
                                        class="h-px w-8 bg-brand-yellow/50"
                                    ></div>
                                    <span
                                        class="font-sans text-[10px] font-bold tracking-[0.3em] text-gray-400 uppercase"
                                        >Eje Principal</span
                                    >
                                </div>
                                <h3
                                    class="mb-6 font-heading text-2xl leading-tight font-bold text-slate-900 uppercase transition-colors group-hover:text-primary"
                                >
                                    {{ axis.title }}
                                </h3>
                                <p
                                    class="mb-8 text-justify font-sans text-sm leading-relaxed text-gray-500"
                                >
                                    {{ axis.description }}
                                </p>
                                <button
                                    @click="openAxisModal(axis)"
                                    class="group/btn inline-flex items-center gap-3 rounded-xl bg-primary px-6 py-3 font-sans text-[10px] font-bold tracking-widest text-white uppercase shadow-lg transition-all duration-300 hover:bg-slate-900"
                                >
                                    Ver Temas Específicos
                                    <ArrowRight
                                        class="h-4 w-4 transform transition-transform group-hover/btn:translate-x-1"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Normativa Section -->
        <section
            id="reglamentos"
            class="border-t border-gray-100 bg-slate-50 py-24"
        >
            <div class="container mx-auto px-4 text-center">
                <div class="mb-16">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.2em] text-brand-yellow uppercase"
                        >Marco Legal y Académico</span
                    >
                    <h2
                        class="mb-6 font-heading text-4xl font-bold tracking-tight text-black uppercase lg:text-6xl"
                    >
                        NORMATIVA Y
                        <span class="text-primary">REGLAMENTOS</span>
                    </h2>
                    <div
                        class="mx-auto mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-xl font-sans text-lg font-medium text-gray-600"
                    >
                        Descarga los lineamientos oficiales que rigen la
                        Convención Guber 2026.
                    </p>
                </div>

                <div
                    class="mx-auto grid max-w-4xl grid-cols-1 gap-12 md:grid-cols-2"
                >
                    <!-- Bases de Investigación -->
                    <div class="group">
                        <a
                            href="/media/pdfs/reglamento-in estigacion.pdf"
                            target="_blank"
                            class="relative block aspect-[3/4] transform overflow-hidden rounded-[2.5rem] border border-black/10 bg-white shadow-2xl transition-all duration-500 group-hover:-translate-y-2"
                        >
                            <img
                                src="/media/imgs/REGLAMENTO-GUBER-01.png"
                                alt="Bases de Investigación"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-primary/10 transition-colors duration-300 group-hover:bg-transparent"
                            ></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3
                                class="mb-2 font-heading text-2xl font-bold text-black uppercase"
                            >
                                Bases de Investigación
                            </h3>
                            <p
                                class="mb-6 px-4 font-sans text-sm text-gray-500"
                            >
                                Requisitos para la presentación de trabajos.
                            </p>
                            <a
                                href="/media/pdfs/reglamento-in estigacion.pdf"
                                target="_blank"
                                class="inline-flex items-center gap-3 rounded-xl bg-primary px-8 py-3.5 font-sans text-sm font-bold text-white shadow-lg shadow-primary/30 transition-all duration-300 hover:bg-slate-900"
                            >
                                <FlaskConical class="h-4 w-4" /> Descargar Bases
                                (PDF)
                            </a>
                        </div>
                    </div>

                    <!-- Reglamento General -->
                    <div class="group">
                        <a
                            href="/media/pdfs/reglamento-convencion.pdf"
                            target="_blank"
                            class="relative block aspect-[3/4] transform overflow-hidden rounded-[2.5rem] border border-black/10 bg-white shadow-2xl transition-all duration-500 group-hover:-translate-y-2"
                        >
                            <img
                                src="/media/imgs/REGLAMENTO-GUBER-02.png"
                                alt="Reglamento General"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-primary/10 transition-colors duration-300 group-hover:bg-transparent"
                            ></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3
                                class="mb-2 font-heading text-2xl font-bold text-black uppercase"
                            >
                                Reglamento Guber 2026
                            </h3>
                            <p
                                class="mb-6 px-4 font-sans text-sm text-gray-500"
                            >
                                Normas generales de participación y convivencia.
                            </p>
                            <a
                                href="/media/pdfs/reglamento-convencion.pdf"
                                target="_blank"
                                class="inline-flex items-center gap-3 rounded-xl bg-slate-900 px-8 py-3.5 font-sans text-sm font-bold text-white shadow-lg transition-all duration-300 hover:bg-primary"
                            >
                                <FileText class="h-4 w-4" /> Descargar
                                Reglamento (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Research Papers Section -->
        <ResearchPapers />

        <!-- Tourist Information Section -->
        <section
            id="tourism"
            class="group relative overflow-hidden border-t border-gray-100 bg-white py-16"
        >
            <!-- Background Image Watermark -->
            <div
                class="pointer-events-none absolute inset-0 z-0 opacity-15 transition-transform duration-1000 group-hover:scale-105"
            >
                <img
                    src="/media/imgs/img5.png"
                    alt="Madre de Dios Nature"
                    class="h-full w-full object-cover"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-b from-white via-transparent to-white"
                ></div>
            </div>

            <!-- Background Decoration -->
            <div
                class="absolute top-0 right-0 -mt-32 -mr-32 h-64 w-64 rounded-full bg-primary/5 blur-3xl"
            ></div>

            <div class="relative z-10 container mx-auto px-4 text-center">
                <div class="mb-12">
                    <span
                        class="mb-3 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                        >Sugerencias Guber 2026</span
                    >
                    <h2
                        class="mb-4 font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-5xl"
                    >
                        INFORMACIÓN <span class="text-primary">TURÍSTICA</span>
                    </h2>
                    <div
                        class="mx-auto mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-2xl font-sans text-base leading-relaxed font-medium text-gray-500"
                    >
                        Explora la biodiversidad y la hospitalidad de la Capital
                        de la Biodiversidad del Perú. Hemos preparado estas
                        guías para facilitar tu estadía.
                    </p>
                </div>

                <div
                    class="mx-auto grid max-w-5xl grid-cols-1 gap-8 text-center md:grid-cols-2 lg:gap-12"
                >
                    <!-- Tourist Destinations Card -->
                    <div
                        class="group/card relative flex flex-col overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl lg:p-10"
                    >
                        <!-- Decorative Shape -->
                        <div
                            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-primary/5 transition-transform duration-700 group-hover/card:scale-150"
                        ></div>

                        <div class="relative z-10 mb-6">
                            <!-- Image Container -->
                            <div
                                class="mb-8 h-60 w-full overflow-hidden rounded-3xl border border-slate-100 shadow-inner transition-all duration-500 group-hover/card:shadow-lg"
                            >
                                <img
                                    src="/media/imgs/img2.webp"
                                    alt="Destinos Turísticos"
                                    class="h-full w-full object-cover object-center transition-transform duration-1000 group-hover/card:scale-110"
                                />
                            </div>

                            <h3
                                class="mb-3 font-heading text-2xl leading-none font-bold text-slate-900 uppercase"
                            >
                                Destinos Turísticos
                            </h3>
                            <div
                                class="mx-auto mb-4 h-1 w-10 rounded-full bg-brand-yellow"
                            ></div>
                            <p
                                class="font-sans text-sm leading-relaxed text-slate-500"
                            >
                                Descubre los atractivos naturales más
                                impresionantes de la región, desde la Reserva
                                Nacional Tambopata hasta el Lago Sandoval.
                            </p>
                        </div>

                        <div class="relative z-10 mt-auto flex justify-center">
                            <a
                                href="/media/pdfs/lugares-turisticos.pdf"
                                target="_blank"
                                class="group/btn inline-flex items-center gap-3 rounded-xl bg-slate-900 px-8 py-4 text-[10px] font-bold tracking-widest text-white uppercase shadow-lg transition-all duration-300 hover:bg-primary"
                            >
                                <FileDown
                                    class="h-4 w-4 transition-transform group-hover/btn:-translate-y-1"
                                />
                                Ver Guía de Destinos
                            </a>
                        </div>
                    </div>

                    <!-- Recommended Hotels Card -->
                    <div
                        class="group/card relative flex flex-col overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl lg:p-10"
                    >
                        <!-- Decorative Shape -->
                        <div
                            class="absolute -top-10 -right-10 h-32 w-32 rounded-full bg-brand-yellow/5 transition-transform duration-700 group-hover/card:scale-150"
                        ></div>

                        <div class="relative z-10 mb-6">
                            <!-- Image Container - Fine-tuned position to show plaza -->
                            <div
                                class="mb-8 h-60 w-full overflow-hidden rounded-3xl border border-slate-100 shadow-inner transition-all duration-500 group-hover/card:shadow-lg"
                            >
                                <img
                                    src="/media/imgs/img7.jpeg"
                                    alt="Hoteles Sugeridos"
                                    class="h-full w-full object-cover object-[center_95%] transition-transform duration-1000 group-hover/card:scale-110"
                                />
                            </div>

                            <h3
                                class="mb-3 font-heading text-2xl leading-none font-bold text-slate-900 uppercase"
                            >
                                Hoteles Sugeridos
                            </h3>
                            <div
                                class="mx-auto mb-4 h-1 w-10 rounded-full bg-primary"
                            ></div>
                            <p
                                class="font-sans text-sm leading-relaxed text-slate-500"
                            >
                                Consulta nuestra lista de establecimientos
                                recomendados con tarifas especiales para los
                                participantes de la GUBER 2026.
                            </p>
                        </div>

                        <div class="relative z-10 mt-auto flex justify-center">
                            <a
                                href="/media/pdfs/hoteles.pdf"
                                target="_blank"
                                class="group/btn inline-flex items-center gap-3 rounded-xl bg-primary px-8 py-4 text-[10px] font-bold tracking-widest text-white uppercase shadow-lg transition-all duration-300 hover:bg-slate-900"
                            >
                                <FileDown
                                    class="h-4 w-4 transition-transform group-hover/btn:-translate-y-1"
                                />
                                Ver Lista de Hoteles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Photo Gallery Section -->
        <section
            id="gallery"
            class="overflow-hidden border-t border-gray-100 bg-slate-50 py-24"
        >
            <div class="container mx-auto px-4 text-center">
                <div class="mb-12">
                    <span
                        class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                        >Nuestro Registro Visual</span
                    >
                    <h2
                        class="font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        GALERÍA DE <span class="text-primary">FOTOS</span>
                    </h2>
                    <div
                        class="mx-auto mt-6 mb-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                    <p
                        class="mx-auto max-w-2xl font-sans text-lg font-medium text-slate-500 italic lg:text-xl"
                    >
                        "Explora los momentos más memorables de la XI Convención
                        Nacional de Contabilidad Gubernamental y Gestión
                        Pública"
                    </p>
                </div>

                <!-- Softer & Elegant Rectangular Button -->
                <div class="mt-8 flex justify-center">
                    <Link
                        href="/galeria"
                        class="group inline-flex items-center gap-5 rounded-[2rem] border border-primary/20 bg-white px-12 py-5 text-xs font-bold tracking-[0.2em] text-slate-900 uppercase shadow-sm transition-all duration-500 hover:border-primary hover:bg-primary/[0.02] hover:shadow-2xl"
                    >
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary transition-all duration-500 group-hover:bg-primary group-hover:text-white"
                        >
                            <Images class="h-6 w-6" />
                        </div>
                        <span class="font-sans">Explorar Galería Completa</span>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section
            class="relative flex items-center justify-center overflow-hidden bg-gray-900 py-48"
        >
            <div class="absolute inset-0 z-0">
                <iframe
                    src="https://maps.google.com/maps?q=Universidad+Nacional+Amazonica+de+Madre+de+Dios&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="100%"
                    style="
                        border: 0;
                        filter: grayscale(100%) invert(90%) contrast(80%);
                    "
                    allowfullscreen=""
                    loading="lazy"
                ></iframe>
            </div>
            <div
                class="absolute inset-0 z-10 bg-black/60 backdrop-blur-[2px]"
            ></div>
            <div class="relative z-20 container mx-auto px-4 text-center">
                <span
                    class="mb-4 block font-sans text-xs font-black tracking-[0.3em] text-brand-yellow uppercase"
                    >Ubicación del Evento</span
                >
                <h2
                    class="mb-8 font-heading text-4xl leading-none font-bold tracking-tighter text-white uppercase drop-shadow-lg lg:text-6xl"
                >
                    ¿CÓMO <span class="text-primary">LLEGAR?</span>
                </h2>
                <div
                    class="mx-auto mb-12 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                ></div>
                <a
                    href="https://maps.google.com/?q=Universidad+Nacional+Amazonica+de+Madre+de+Dios"
                    target="_blank"
                    class="group inline-flex items-center gap-4 rounded-full bg-brand-yellow px-10 py-5 font-sans text-lg font-bold text-white shadow-[0_0_30px_rgba(188,128,32,0.4)] transition-all hover:scale-105"
                >
                    <MapPin class="h-6 w-6 animate-bounce" /> UBÍCANOS EN GOOGLE
                    MAPS
                </a>
            </div>
        </section>
        <!-- Sponsors Section -->
        <section
            id="sponsors"
            class="overflow-hidden border-t border-gray-100 bg-slate-50 py-20"
        >
            <div class="container mx-auto px-4 text-center">
                <div class="mb-16">
                    <h2
                        class="font-heading text-4xl font-bold tracking-tight text-slate-900 uppercase lg:text-6xl"
                    >
                        NUESTROS <span class="text-primary">AUSPICIADORES</span>
                    </h2>
                    <div
                        class="mx-auto mt-8 h-1.5 w-32 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                </div>

                <div class="embla overflow-hidden" ref="sponsorsRef">
                    <div class="flex items-center">
                        <div
                            v-for="(logo, index) in sponsorsList"
                            :key="index"
                            class="min-w-0 flex-[0_0_50%] px-4 sm:flex-[0_0_33%] md:flex-[0_0_25%] lg:flex-[0_0_20%]"
                        >
                            <div
                                @click="openSponsorModal(logo)"
                                class="group/logo flex h-32 transform cursor-pointer items-center justify-center transition-all duration-500 hover:scale-110"
                            >
                                <img
                                    :src="`/media/imgs/logos/${logo}`"
                                    :alt="`Sponsor ${index + 1}`"
                                    class="max-h-20 w-auto max-w-[180px] object-contain drop-shadow-sm filter"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modals -->
        <BenefitsModal
            :is-open="isModalOpen"
            :category="selectedCategory"
            @close="isModalOpen = false"
        />
        <AxisModal
            :is-open="isAxisModalOpen"
            :axis="selectedAxis"
            @close="isAxisModalOpen = false"
        />

        <!-- Sponsor Logo Modal -->
        <Dialog v-model:open="isSponsorModalOpen">
            <DialogContent
                class="w-[90vw] max-w-[95vw] overflow-hidden rounded-[2rem] border-0 bg-white p-0 sm:max-w-4xl"
            >
                <div
                    v-if="selectedSponsorLogo"
                    class="flex max-h-[90vh] flex-col p-10"
                >
                    <VisuallyHidden>
                        <DialogTitle>Auspiciador</DialogTitle>
                        <DialogDescription
                            >Logo del Auspiciador</DialogDescription
                        >
                    </VisuallyHidden>

                    <div
                        class="flex items-center justify-center overflow-y-auto"
                    >
                        <img
                            :src="`/media/imgs/logos/${selectedSponsorLogo}`"
                            alt="Logo Auspiciador"
                            class="h-auto max-h-[80vh] w-full object-contain"
                        />
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    </LandingLayout>
</template>
