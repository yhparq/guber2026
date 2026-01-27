<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import emblaCarouselVue from 'embla-carousel-vue';
import Autoplay from 'embla-carousel-autoplay';
import LandingLayout from '@/layouts/LandingLayout.vue';
import SpeakersCarousel from '@/components/SpeakersCarousel.vue';
import BenefitsModal from '@/components/BenefitsModal.vue';
import { Calendar, MapPin, Clock, Users, BookOpen, DollarSign, CheckCircle, Award, Eye, GraduationCap, CreditCard, QrCode } from 'lucide-vue-next';

defineProps<{
    canRegister: boolean;
}>();

const [emblaRef] = emblaCarouselVue({ loop: true }, [Autoplay({ delay: 4000 })]);

// Event Details
const eventDetails = {
    title: "I CONVENCIÓN NACIONAL GUBER 2026",
    subtitle: "Innovación y Excelencia en la Gestión Pública y Corporativa",
    date: "24, 25 y 26 de Julio, 2026",
    location: "Auditorio Principal, Lima - Perú"
};

const thematicAxes = [
    {
        category: "Modernización de la Administración Financiera del Sector Público",
        image: "https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000&auto=format&fit=crop",
        items: [
            "Planeamiento estratégico en el Sector Público: Los Programas Presupuestales y su asociación con el cumplimiento de los ODS 2023.",
            "Modernización de la Gestión de la Inversión Pública y su articulación con los planes de desarrollo territorial hacia la creación de valor público.",
            "Nueva Ley de Contrataciones, modificaciones y su incidencia en la Programación Multianual de Bienes Servicios y Obras.",
            "Nuevas operaciones de tesorería gubernamental y ultimas disposiciones emitidas por la DGTP y su aplicación en el nuevo SIAF WEB."
        ]
    },
    {
        category: "Contabilidad Gubernamental y Adopción plena del marco NIC- SP",
        image: "https://images.unsplash.com/photo-1554224154-26032ffc0d07?q=80&w=1000&auto=format&fit=crop",
        items: [
            "Modernización del Sistema Nacional de Contabilidad hacia la adopción de plenas del marco de las NIC-SP y nuevo SIAF Web - Modulo Contable.",
            "Contabilidad de Software y Activos Intangibles generados internamente, revisión de su vida útil, deterioro y obsolescencia tecnológica.",
            "Liquidación y transferencia de proyectos de inversión pública, y tratamiento contable de obras paralizadas bajo el marco NICSP.",
            "Toma de Inventario Físicos valorizados y conciliación contable de elementos de Propiedades, Planta y Equipo, Inventarios y Otras Cuentas del Activo, bajo el marco NIC-SP.",
            "Experiencias y buenas prácticas de Gestión Pública en el proceso de transición al marco NIC-SP de Ecuador. Y Mesa de Trabajo caso departamento de Madre de Dios."
        ]
    },
    {
        category: "Gestión para el Desarrollo Sostenible",
        image: "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=1000&auto=format&fit=crop",
        items: [
            "Contabilidad de la Biodiversidad, Recursos Naturales e Implicancias del cambio climático hacia la sostenibilidad de las Finanzas Públicas.",
            "Últimas NICSP y desafíos de la contabilidad gubernamental hacia la transparencia, control y el cumplimiento ético en la presentación de rendición de cuentas. (Tema respecto a ética)",
            "Responsabilidad administrativa funcional en la Gestión Pública."
        ]
    }
];

const slides = [
    { image: "https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" },
    { image: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop" },
    { image: "https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=2070&auto=format&fit=crop" },
];

const isModalOpen = ref(false);
const selectedCategory = ref(null);

const openModal = (category: any) => {
    selectedCategory.value = category;
    isModalOpen.value = true;
};

const pricingCategories = [
    {
        title: "PLENOS",
        icon: Award,
        description: "Contadores Públicos inscritos en su respectivo Colegio Departamental. Participan con todos los derechos y obligaciones.",
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
        description: "Empresarios, profesionales de otras ramas del conocimiento, así como los bachilleres, egresados y otras personas interesadas.",
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
        description: "Que se encuentren cursando estudios de nivel superior en Ciencias Contables y afines.",
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

const walletMethod = {
    bank: "Billetera Digital",
    name: "Yape / Plin",
    info: [
        { label: "A nombre de", value: "COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS" },
        { label: "Método", value: "Escanear código QR" }
    ],
    qrImage: "/media/imgs/qr.png",
    colorClass: "hover:border-[#742284] hover:shadow-[#742284]/20",
    icon: QrCode,
    iconColor: "text-[#742284]"
};

const bankMethods = [
    {
        bank: "BBVA Continental",
        name: "BBVA",
        info: [
            { label: "Cta. Cte. Soles", value: "0011-0263-0100039835" },
            { label: "CCI", value: "01126300010003983512" }
        ],
        colorClass: "hover:border-[#1973B8] hover:shadow-[#1973B8]/20",
        icon: CreditCard,
        iconColor: "text-[#1973B8]"
    },
    {
        bank: "Interbank",
        name: "Interbank",
        info: [
            { label: "Cta. Cte.", value: "335-300400846-2" },
            { label: "CCI", value: "003-335-003004008462-73" }
        ],
        colorClass: "hover:border-[#059c5b] hover:shadow-[#059c5b]/20",
        icon: CreditCard,
        iconColor: "text-[#059c5b]"
    },
    {
        bank: "Banco de Crédito",
        name: "BCP",
        info: [
            { label: "Cta. Cte.", value: "485-9971744-0-73" },
            { label: "CCI", value: "002-485-009971744073-11" }
        ],
        colorClass: "hover:border-[#002a8d] hover:shadow-[#002a8d]/20",
        icon: CreditCard,
        iconColor: "text-[#002a8d]"
    }
];
</script>

<template>
    <Head title="Bienvenido a Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <!-- Hero Section with Carousel Banners -->
        <section class="relative bg-white min-h-[40vh] md:min-h-[70vh] overflow-hidden flex items-center justify-center">
            <!-- Carousel Container -->
            <div class="absolute inset-0 z-0 embla h-full w-full" ref="emblaRef">
                <div class="flex h-full w-full">
                    <div v-for="(slide, index) in slides" :key="index" class="flex-[0_0_100%] min-w-0 h-full relative">
                        <img :src="slide.image" :alt="'Banner ' + index" class="w-full h-full object-cover" />
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="info" class="py-40 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-6 max-w-5xl mx-auto">XI CONVENCIÓN NACIONAL DE CONTABILIDAD GUBERNAMENTAL Y GESTIÓN PÚBLICA – GUBER 2026</h2>
                    <div class="w-24 h-1.5 bg-primary rounded-full mx-auto"></div>
                </div>
                
                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <div class="lg:w-1/2 w-full">
                        <div class="relative pb-[56.25%] h-0 rounded-2xl shadow-2xl overflow-hidden border border-black">
                            <iframe
                                class="absolute top-0 left-0 w-full h-full border-0"
                                src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                                title="Guber 2026 Presentation"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                    <div class="lg:w-1/2 lg:pl-10">
                        <p class="text-lg text-black mb-6 leading-relaxed text-justify">
                            El Colegio de Contadores Públicos de Madre de Dios y la Junta de Decanos de los Colegios de Contadores del Perú - JDCCPP, invitan a los Contadores Públicos, profesionales, servidores y funcionarios públicos, estudiantes y ciudadanía, regional y nacional, a participar en la <strong class="text-primary">“XI CONVENCIÓN NACIONAL DE CONTABILIDAD GUBERNAMENTAL Y GESTIÓN PÚBLICA – GUBER 2026”</strong> a realizarse los días 23, 24 y 25 de abril de 2026.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Material Audita Section -->
        <section id="material" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4">MATERIAL GUBER</h2>
                    <div class="w-20 h-1.5 bg-primary rounded-full mx-auto mb-6"></div>
                    <p class="text-black max-w-xl mx-auto">Descarga los documentos oficiales y normativas de la Convención Guber 2026.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                    <!-- Reglamento Banner -->
                    <div class="group">
                        <a href="/media/pdfs/reglamento.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/10">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070&auto=format&fit=crop" alt="Reglamento" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2">Conoce Guber 2026</h3>
                            <p class="text-black text-sm mb-6 px-4">Infórmate sobre los detalles del evento.</p>
                            <a href="/media/pdfs/reglamento.pdf" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-full font-bold text-sm transition-all duration-300 shadow-sm">
                                <BookOpen class="w-4 h-4" />
                                Descargar Conoce Guber (PDF)
                            </a>
                        </div>
                    </div>

                    <!-- Invitación Banner -->
                    <div class="group">
                        <a href="/media/pdfs/invitacion.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/10">
                            <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=2074&auto=format&fit=crop" alt="Invitación" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2">Programa Guber 2026</h3>
                            <p class="text-black text-sm mb-6 px-4">Descarga el cronograma oficial de actividades.</p>
                            <a href="/media/pdfs/invitacion.pdf" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-full font-bold text-sm transition-all duration-300 shadow-sm">
                                <DollarSign class="w-4 h-4" />
                                Descargar Programa (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Madre de Dios Banner Section -->
        <section class="bg-primary overflow-hidden border-y border-white/10">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Text Area -->
                <div class="w-full lg:w-[35%] px-12 py-12 text-center flex flex-col justify-center border-b lg:border-b-0 lg:border-r border-white/10">
                    <h2 class="text-4xl font-heading font-black text-white uppercase tracking-[0.2em] leading-tight">
                        MADRE DE DIOS
                    </h2>
                    <p class="text-white text-[10px] md:text-xs font-bold italic tracking-[0.3em] uppercase mt-2">
                        Capital de la Biodiversidad
                    </p>
                </div>
                
                <!-- Images Strip -->
                <div class="flex-1 flex w-full">
                    <div v-for="(img, idx) in [
                        '/media/imgs/img1.webp',
                        '/media/imgs/img2.webp',
                        '/media/imgs/img3.webp',
                        '/media/imgs/img4.jpg',
                        '/media/imgs/img5.png',
                        '/media/imgs/img6.jpg'
                    ]" :key="idx" class="flex-1 relative group aspect-square overflow-hidden border-l border-white/5">
                        <img 
                            :src="img" 
                            alt="Madre de Dios" 
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 transform group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Topics Section -->
        <section id="topics" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4">EJES TEMÁTICOS</h2>
                    <div class="w-24 h-1.5 bg-primary rounded-full mx-auto mb-8"></div>
                    <p class="text-xl font-medium text-black max-w-4xl mx-auto italic">
                        “La modernización de la gestión pública hacia la adopción de las NICSP para el desarrollo sostenible en la creación del valor público en el Perú”
                    </p>
                </div>

                <div class="flex flex-col gap-12">
                    <!-- Loop through axes -->
                    <div v-for="(axis, index) in thematicAxes" :key="index" class="flex flex-col lg:flex-row bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 group hover:shadow-2xl transition-all duration-300">
                        
                        <!-- Green Div (Left) -->
                        <div class="lg:w-1/4 bg-primary p-8 flex flex-col justify-center relative overflow-hidden">
                            <!-- Decorative circle/pattern -->
                            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                            <h3 class="text-2xl font-heading font-bold text-white relative z-10 leading-tight">
                                {{ axis.category }}
                            </h3>
                            <div class="mt-4 w-12 h-1 bg-brand-yellow relative z-10"></div>
                        </div>

                        <!-- Content (Middle) -->
                        <div class="lg:w-1/2 p-8 flex flex-col justify-center">
                            <ul class="space-y-4">
                                <li v-for="(item, idx) in axis.items" :key="idx" class="flex items-start gap-3">
                                    <div class="mt-1.5 min-w-[6px] h-1.5 rounded-full bg-primary"></div>
                                    <span class="text-black text-sm leading-relaxed">{{ item }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Image (Right) -->
                        <div class="lg:w-1/4 relative min-h-[200px]">
                            <img :src="axis.image" :alt="axis.category" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-gradient-to-l from-transparent to-black/10 lg:to-transparent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Speakers Carousel Section -->
        <SpeakersCarousel />

        <!-- Pricing Section -->
        <section id="investment" class="py-20 bg-brand-yellow relative overflow-hidden">
            <!-- Background Texture -->
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold mb-4 text-black">INVERSIÓN</h2>
                    <div class="w-24 h-1.5 bg-black rounded-full mx-auto mb-6"></div>
                    <p class="text-black/80 max-w-2xl mx-auto font-medium">
                        Los derechos de inscripción se abonarán en cuenta corriente a nombre del COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div v-for="(category, index) in pricingCategories" :key="index" class="bg-black rounded-3xl p-8 border border-white/10 hover:border-white transition-all hover:-translate-y-2 relative flex flex-col shadow-2xl group">
                        <!-- Icon Header -->
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                            <component :is="category.icon" class="w-8 h-8 text-white" />
                        </div>

                        <h3 class="text-3xl font-heading font-bold text-white mb-3">{{ category.title }}</h3>
                        <p class="text-gray-400 text-sm mb-8 leading-relaxed min-h-[60px]">
                            {{ category.description }}
                        </p>

                        <!-- Price (Placeholder or Actual) -->
                        <div class="mb-8">
                            <span class="text-4xl font-heading font-bold text-brand-yellow">{{ category.price }}</span>
                        </div>

                        <!-- Action -->
                        <button 
                            @click="openModal(category)"
                            class="w-full py-4 rounded-xl font-bold bg-white text-black hover:bg-primary hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group/btn"
                        >
                            Ver Beneficios
                            <Eye class="w-4 h-4 group-hover/btn:scale-110 transition-transform" />
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment Methods Section -->
        <section id="payments" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4 uppercase">Medios de Pago</h2>
                    <div class="w-24 h-1.5 bg-primary rounded-full mx-auto"></div>
                </div>

                <div class="flex flex-col lg:flex-row gap-6 max-w-6xl mx-auto items-stretch">
                    <!-- Left: Wallet (QR Card) -->
                    <div class="lg:w-1/2 flex">
                        <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-200 w-full transition-all duration-300 group hover:border-[#742284] flex flex-col items-center text-center justify-between">
                            <div class="w-full">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-[#742284]/10 transition-colors">
                                        <QrCode class="w-6 h-6 text-[#742284]" />
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-xl text-black leading-tight">{{ walletMethod.bank }}</h3>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">{{ walletMethod.name }}</p>
                                    </div>
                                </div>

                                <!-- QR Image -->
                                <div class="mb-8 p-6 bg-gray-50 rounded-3xl flex items-center justify-center border-2 border-dashed border-gray-200 group-hover:border-[#742284]/30 max-w-[260px] mx-auto w-full">
                                    <img :src="walletMethod.qrImage" alt="QR de Pago" class="w-full h-auto rounded-xl shadow-sm" />
                                </div>
                            </div>

                            <div class="space-y-4 w-full">
                                <div v-for="(info, idx) in walletMethod.info" :key="idx" class="text-center">
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">{{ info.label }}</p>
                                    <p class="text-sm font-bold text-black leading-tight">{{ info.value }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Banks (Vertical Stack) -->
                    <div class="lg:w-1/2 flex flex-col gap-4">
                        <div v-for="(method, index) in bankMethods" :key="index" 
                            class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 transition-all duration-300 group flex-1 flex items-center"
                            :class="method.colorClass"
                        >
                            <div class="flex items-center gap-6 w-full">
                                <!-- Bank Icon -->
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-white group-hover:shadow-md transition-all shrink-0">
                                    <CreditCard class="w-6 h-6" :class="method.iconColor" />
                                </div>
                                
                                <!-- Bank Info -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-bold text-base text-black leading-tight">{{ method.bank }}</h3>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase">{{ method.name }}</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div v-for="(info, idx) in method.info" :key="idx" class="border-l-2 border-gray-100 pl-3 group-hover:border-current transition-colors">
                                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider">{{ info.label }}</p>
                                            <p class="text-xs font-bold text-black font-mono mt-0.5">{{ info.value }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section (Placeholder) -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-heading font-bold text-black mb-8">Ubicación</h2>
                <div class="bg-white w-full h-96 rounded-xl flex items-center justify-center border-2 border-black">
                    <p class="text-black flex items-center gap-2">
                        <MapPin class="w-6 h-6" />
                        Mapa de Google Maps aquí (Lima, Perú)
                    </p>
                </div>
            </div>
        </section>

        <!-- Benefits Modal -->
        <BenefitsModal :is-open="isModalOpen" :category="selectedCategory" @close="isModalOpen = false" />
    </LandingLayout>
</template>