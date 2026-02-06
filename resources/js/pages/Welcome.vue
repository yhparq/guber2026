<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import emblaCarouselVue from 'embla-carousel-vue';
import Autoplay from 'embla-carousel-autoplay';
import LandingLayout from '@/layouts/LandingLayout.vue';
import SpeakersCarousel from '@/components/SpeakersCarousel.vue';
import BenefitsModal from '@/components/BenefitsModal.vue';
import AxisModal from '@/components/AxisModal.vue';
import ResearchPapers from '@/components/ResearchPapers.vue';
import EventCountdown from '@/components/EventCountdown.vue';
import { Calendar, MapPin, Clock, Users, BookOpen, DollarSign, CheckCircle, Award, Eye, GraduationCap, CreditCard, QrCode, Quote, User, ChevronRight, BarChart3, Calculator, Leaf, ArrowRight, FileText, FileDown, FlaskConical } from 'lucide-vue-next';

defineProps<{
    canRegister: boolean;
}>();

const [emblaRef] = emblaCarouselVue({ loop: true }, [Autoplay({ delay: 4000 })]);
const [topicsRef] = emblaCarouselVue(
    { 
        loop: true, 
        align: 'start', 
        slidesToScroll: 1,
        breakpoints: {
            '(min-width: 768px)': { slidesToScroll: 2 },
            '(min-width: 1024px)': { slidesToScroll: 3 }
        }
    }, 
    [Autoplay({ delay: 5000, stopOnInteraction: false })]
);

const thematicAxes = [
    {
        number: "01",
        category: "EJE TEMÁTICO Nº 01:",
        title: "Modernización de la Administración Financiera del Sector Público",
        description: "Enfoque en el planeamiento estratégico y la optimización de los recursos públicos bajo la nueva normativa.",
        image: "https://images.unsplash.com/photo-1454165833767-027ffea9e778?q=80&w=1000&auto=format&fit=crop",
        icon: BarChart3,
        items: [
            "Planeamiento estratégico en el Sector Público: Los Programas Presupuestales y su asociación con el cumplimiento de los ODS 2023.",
            "Modernización de la Gestión de la Inversión Pública y su articulación con los planes de desarrollo territorial hacia la creación de valor público.",
            "Nueva Ley de Contrataciones, modificaciones y su incidencia en la Programación Multianual de Bienes Servicios y Obras.",
            "Nuevas operaciones de tesorería gubernamental y últimas disposiciones emitidas por la DGTP y su aplicación en el nuevo SIAF WEB."
        ]
    },
    {
        number: "02",
        category: "EJE TEMÁTICO Nº 02:",
        title: "Contabilidad Gubernamental y Adopción plena del marco NIC-SP",
        description: "Transición hacia estándares internacionales de contabilidad para una rendición de cuentas transparente.",
        image: "https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=1000&auto=format&fit=crop",
        icon: Calculator,
        items: [
            "Modernización del Sistema Nacional de Contabilidad hacia la adopción de plenas del marco de las NIC-SP y nuevo SIAF Web - Modulo Contable.",
            "Contabilidad de Software y Activos Intangibles generados internamente, revisión de su vida útil, deterioro y obsolescencia tecnológica.",
            "Liquidación y transferencia de proyectos de inversión pública, y tratamiento contable de obras paralizadas bajo el marco NICSP.",
            "Toma de Inventario Físicos valorizados y conciliación contable de elementos de Propiedades, Planta y Equipo, Inventarios y Otras Cuentas del Activo, bajo el marco NIC-SP.",
            "Experiencias y buenas prácticas de Gestión Pública en el proceso de transición al marco NIC-SP de Ecuador. Y Mesa de Trabajo caso departamento de Madre de Dios."
        ]
    },
    {
        number: "03",
        category: "EJE TEMÁTICO Nº 03:",
        title: "Gestión para el Desarrollo Sostenible",
        description: "Integración de la ética y la sostenibilidad en la toma de decisiones de la gestión pública moderna.",
        image: "https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1000&auto=format&fit=crop",
        icon: Leaf,
        items: [
            "Contabilidad de la Biodiversidad, Recursos Naturales e implicancias del cambio climático hacia la sostenibilidad de las Finanzas Públicas.",
            "Últimas NICSP y desafíos de la contabilidad gubernamental hacia la transparencia, control y el cumplimiento ético en la presentación de rendición de cuentas. (Tema respecto a ética).",
            "Responsabilidad administrativa funcional en la Gestión Pública."
        ]
    }
];

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

const slides = [
    { image: "/media/imgs/slider1.png" },
];

// Modal States
const isModalOpen = ref(false);
const selectedCategory = ref(null);

const isAxisModalOpen = ref(false);
const selectedAxis = ref(null);

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
        <section class="relative bg-white overflow-hidden">
            <div class="embla w-full" ref="emblaRef">
                <div class="flex w-full">
                    <div v-for="(slide, index) in slides" :key="index" class="flex-[0_0_100%] min-w-0 relative">
                        <img :src="slide.image" alt="Banner" class="w-full h-auto" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Countdown Section -->
        <EventCountdown />

        <!-- About Section -->
        <section id="info" class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center">
                <div class="flex flex-col lg:flex-row items-center gap-20 text-left">
                    <div class="lg:w-1/2 w-full">
                        <div class="relative pb-[56.25%] h-0 rounded-3xl shadow-2xl overflow-hidden border-2 border-primary/10 group">
                            <iframe
                                class="absolute top-0 left-0 w-full h-full border-0"
                                src="https://www.youtube.com/embed/0iKVxhabCBA"
                                title="Madre de Dios te saluda"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                    <div class="lg:w-1/2 lg:pl-10">
                        <div class="mb-10">
                            <span class="text-brand-yellow font-heading font-black uppercase tracking-[0.3em] text-sm block mb-4">¡Bienvenidos!</span>
                            <h2 class="text-5xl font-heading font-black text-slate-900 uppercase leading-none tracking-tighter mb-6">
                                MADRE DE DIOS <br>
                                <span class="text-primary text-4xl lg:text-6xl">TE SALUDA</span>
                            </h2>
                            <div class="w-24 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full"></div>
                        </div>
                        <p class="text-lg text-gray-700 mb-6 leading-relaxed text-justify font-sans">
                            El Colegio de Contadores Públicos de Madre de Dios y la Junta de Decanos de los Colegios de Contadores del Perú - JDCCPP, invitan a los Contadores Públicos, profesionales, servidores y funcionarios públicos, estudiantes y ciudadanía, regional y nacional, a participar en la <strong class="text-primary font-bold uppercase tracking-tight">“XI CONVENCIÓN NACIONAL DE CONTABILIDAD GUBERNAMENTAL Y GESTIÓN PÚBLICA – GUBER 2026”</strong> a realizarse los días 23, 24 y 25 de abril de 2026 en la Capital de la Biodiversidad del Perú.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Material Section (Enhanced Colors ONLY) -->
        <section id="material" class="py-16 bg-slate-50 border-y border-slate-100">
            <div class="container mx-auto px-4 text-center">
                <div class="mb-12">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4 uppercase">MATERIAL GUBER</h2>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-6"></div>
                    <p class="text-lg text-gray-600 max-w-xl mx-auto font-medium font-sans">Descarga los documentos informativos de la Convención Guber 2026.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                    <!-- Conoce Guber -->
                    <div class="group">
                        <a href="/media/pdfs/invitacion.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/10 bg-white">
                            <img src="/media/imgs/CONOCE-GUBER-2026.png" alt="Conoce Guber 2026" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2 uppercase">Conoce Guber 2026</h3>
                            <p class="text-gray-500 text-sm mb-6 px-4 font-sans">Detalles generales y alcances del evento.</p>
                            <a href="/media/pdfs/invitacion.pdf" target="_blank" class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary text-white hover:bg-slate-900 rounded-xl font-bold text-sm transition-all duration-300 shadow-lg shadow-primary/30 font-sans">
                                <BookOpen class="w-4 h-4" /> Descargar Invitación
                            </a>
                        </div>
                    </div>

                    <!-- Programa General -->
                    <div class="group">
                        <a href="/media/pdfs/programa.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/10 bg-white">
                            <img src="/media/imgs/PROGRAMA-GENERAL-GUBER.png" alt="Programa General Guber" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2 uppercase">Programa Guber 2026</h3>
                            <p class="text-gray-500 text-sm mb-6 px-4 font-sans">Cronograma detallado de actividades.</p>
                            <a href="/media/pdfs/programa.pdf" target="_blank" class="inline-flex items-center gap-3 px-8 py-3.5 bg-slate-900 text-white hover:bg-primary rounded-xl font-bold text-sm transition-all duration-300 shadow-lg font-sans">
                                <DollarSign class="w-4 h-4" /> Descargar Programa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Madre de Dios Section (Strip Style with Improved Text) -->
        <section class="bg-primary overflow-hidden relative border-y border-white/5">
            <div class="flex flex-col lg:flex-row items-stretch">
                <!-- Text Block (Monumental Style kept) -->
                <div class="w-full lg:w-[30%] px-12 py-16 text-center lg:text-left flex flex-col justify-center bg-primary relative overflow-hidden group">
                    <div class="relative z-10">
                        <span class="text-white/60 font-heading font-bold uppercase tracking-[0.4em] text-[10px] mb-3 block">Descubre el Paraíso</span>
                        <h2 class="text-5xl lg:text-6xl font-heading font-black text-white uppercase leading-[0.8] mb-6 tracking-tighter">
                            MADRE <br> DE DIOS
                        </h2>
                        <div class="w-16 h-1 bg-brand-yellow mb-6"></div>
                        <p class="text-white text-[10px] font-sans font-black italic tracking-[0.3em] uppercase leading-relaxed">
                            Capital de la <br> Biodiversidad del Perú
                        </p>
                    </div>
                    <!-- Decorative Background Text -->
                    <span class="absolute -bottom-6 -left-6 text-9xl font-heading font-black text-black/10 select-none pointer-events-none">MDD</span>
                </div>

                <!-- Gallery Strip (Original style restored) -->
                <div class="flex-1 flex w-full">
                    <div v-for="(img, idx) in ['/media/imgs/img1.webp', '/media/imgs/img2.webp', '/media/imgs/img3.webp', '/media/imgs/img4.jpg', '/media/imgs/img5.png', '/media/imgs/img6.jpg']" 
                        :key="idx" 
                        class="flex-1 relative group aspect-square lg:aspect-auto overflow-hidden border-l border-white/5"
                    >
                        <img :src="img" alt="Madre de Dios" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 transform group-hover:scale-110" />
                        <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Investment Section -->
        <section id="investment" class="py-24 bg-slate-50 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-brand-yellow/5 blur-[120px] rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-primary/5 blur-[100px] rounded-full -ml-20 -mb-20"></div>
            <div class="container mx-auto px-4 relative z-10 text-center">
                <div class="mb-16">
                    <h2 class="text-4xl font-heading font-bold mb-4 text-black uppercase">DERECHOS DE INVERSIÓN</h2>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto font-medium font-sans">
                        Asegura tu lugar en la convención más importante de gestión pública a nombre del <span class="text-primary font-bold">Colegio de Contadores Públicos de Madre de Dios</span>.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto text-left">
                    <div v-for="(category, index) in pricingCategories" :key="index" class="group relative bg-white rounded-[2.5rem] p-10 shadow-xl border border-slate-100 transition-all duration-500 hover:-translate-y-3 flex flex-col" :class="{ 'ring-2 ring-primary scale-105 md:scale-110 z-20': index === 1 }">
                        <div v-if="index === 1" class="absolute -top-5 left-1/2 -translate-x-1/2 bg-primary text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg uppercase tracking-wider font-sans">Más solicitado</div>
                        <div class="mb-8">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-transform duration-500 group-hover:scale-110" :class="index === 1 ? 'bg-primary text-white' : 'bg-slate-50 text-primary'">
                                <component :is="category.icon" class="w-8 h-8" />
                            </div>
                            <h3 class="text-2xl font-heading font-bold text-slate-900 mb-4 uppercase">{{ category.title }}</h3>
                            <p class="text-slate-500 font-sans text-sm leading-relaxed min-h-[60px]">{{ category.description }}</p>
                        </div>
                        <div class="mb-10 pt-6 border-t border-slate-100">
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-heading font-black text-slate-900">{{ category.price }}</span>
                                <span class="text-gray-400 font-sans font-medium uppercase">PEN</span>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <button @click="openModal(category)" class="w-full py-4 rounded-2xl font-bold font-sans transition-all duration-300 flex items-center justify-center gap-3 bg-slate-900 text-white hover:bg-slate-800" :class="{ 'bg-primary hover:bg-primary/90': index === 1 }">
                                <Eye class="w-5 h-5" /> Ver beneficios completos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment Methods -->
        <section id="payments" class="py-24 bg-white">
            <div class="container mx-auto px-4 text-center">
                <div class="mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4 uppercase">Medios de Pago</h2>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                    <p class="text-lg text-gray-600 max-w-xl mx-auto font-medium font-sans">Realiza tu pago de forma segura a través de nuestros canales oficiales.</p>
                </div>
                <div class="flex flex-col lg:flex-row gap-8 max-w-6xl mx-auto items-stretch text-left">
                    <div class="lg:w-1/2 flex">
                        <div class="bg-slate-50 p-8 rounded-[2rem] shadow-sm border border-slate-100 w-full flex flex-col items-center text-center justify-between transition-all hover:shadow-lg">
                            <div class="w-full">
                                <div class="flex items-center gap-4 mb-8">
                                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-sm text-primary"><QrCode class="w-7 h-7" /></div>
                                    <div class="text-left"><h3 class="font-heading font-bold text-2xl text-slate-900 leading-tight uppercase">Billetera Digital</h3><p class="text-xs text-gray-400 font-bold font-sans uppercase">Yape / Plin</p></div>
                                </div>
                                <div class="mb-8 p-6 bg-white rounded-3xl flex items-center justify-center border border-slate-100 max-w-[280px] mx-auto w-full"><img :src="walletMethod.qrImage" alt="QR" class="w-full h-auto" /></div>
                            </div>
                            <div class="space-y-4 w-full pt-6 border-t border-slate-200">
                                <div v-for="(info, idx) in walletMethod.info" :key="idx"><p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider font-sans">{{ info.label }}</p><p class="text-sm font-bold text-slate-900 uppercase font-sans">{{ info.value }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 flex flex-col gap-4">
                        <div v-for="(method, index) in bankMethods" :key="index" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex-1 flex items-center group hover:shadow-lg transition-all">
                            <div class="flex items-center gap-6 w-full">
                                <div class="w-14 h-14 rounded-xl bg-slate-50 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500"><CreditCard class="w-7 h-7" /></div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3"><h3 class="font-heading font-bold text-xl text-slate-900 leading-tight uppercase">{{ method.bank }}</h3><span class="text-[10px] font-sans text-gray-400 font-bold uppercase">{{ method.name }}</span></div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                                        <div v-for="(info, idx) in method.info" :key="idx" class="border-l-2 border-slate-100 pl-4 group-hover:border-primary transition-colors"><p class="text-[9px] font-sans text-gray-400 font-bold uppercase tracking-wider font-sans">{{ info.label }}</p><p class="text-xs font-sans font-bold text-slate-900 font-mono">{{ info.value }}</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Motto Section -->
        <section class="py-12 bg-slate-900 relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-full bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
            <div class="container mx-auto px-4 relative z-10 text-center">
                <div class="max-w-5xl mx-auto">
                    <Quote class="w-10 h-10 text-brand-yellow mx-auto mb-4 opacity-20 group-hover:opacity-100 transition-all" />
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-white uppercase leading-tight tracking-widest opacity-30 group-hover:opacity-100 transition-all">
                        "La modernización de la gestión pública hacia la adopción de las <span class="text-brand-yellow">NICSP</span> para el desarrollo sostenible en la creación del <span class="text-brand-yellow">valor público</span> en el Perú"
                    </h2>
                    <div class="mt-6 w-24 h-1 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto transform scale-x-50 opacity-0 group-hover:opacity-100 group-hover:scale-x-150 transition-all"></div>
                </div>
            </div>
        </section>

        <!-- Speakers Carousel -->
        <SpeakersCarousel />

        <!-- Topics Section (TEMARIO) -->
        <section id="topics" class="py-24 bg-white overflow-visible border-t border-gray-100">
            <div class="container mx-auto px-4">
                <div class="text-center mb-20">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4 uppercase tracking-tight leading-none">TEMARIO</h2>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-8"></div>
                    <p class="text-lg text-gray-600 max-w-4xl mx-auto font-medium font-sans italic leading-relaxed">
                        “La modernización de la gestión pública hacia la adopción de las NICSP para el desarrollo sostenible en la creación del valor público en el Perú”
                    </p>
                </div>

                <div class="flex flex-col lg:flex-row relative">
                    <!-- Sidebar -->
                    <div class="lg:w-[30%] bg-slate-900 p-12 text-white flex flex-col justify-between relative border-r-4 border-brand-yellow rounded-l-[3rem]">
                        <div class="sticky top-32">
                            <span class="text-brand-yellow font-black tracking-[0.2em] text-xs uppercase block mb-4 font-sans">Ejes Temáticos</span>
                            <h2 class="text-5xl font-heading font-bold uppercase leading-none mb-8 tracking-tighter">GUBER 2026</h2>
                            <div class="w-16 h-1.5 bg-brand-yellow rounded-full mb-10"></div>
                            <p class="text-white/60 font-sans font-medium leading-relaxed italic text-sm text-justify">
                                Desarrollo académico integral diseñado para la excelencia en la administración pública peruana.
                            </p>
                        </div>
                        <BarChart3 class="absolute -bottom-10 -right-10 w-48 h-48 text-white/5 transform -rotate-12" />
                    </div>

                    <!-- Content (Axes - Flat/Clean Style) -->
                    <div class="lg:w-[70%] bg-white p-12 md:p-16 flex flex-col gap-24 border border-l-0 border-slate-100 rounded-r-[3rem]">
                        <div v-for="(axis, index) in thematicAxes" :key="index" 
                            class="flex flex-col md:flex-row gap-12 items-center group"
                            :class="{ 'md:flex-row-reverse': index % 2 !== 0 }"
                        >
                            <div class="w-full md:w-1/2">
                                <div class="aspect-[16/10] overflow-hidden rounded-2xl relative shadow-md group-hover:shadow-xl transition-all duration-500">
                                    <img :src="axis.image" :alt="axis.title" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" />
                                    <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-500"></div>
                                    <div class="absolute bottom-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-xl flex items-center justify-center text-primary shadow-sm">
                                        <component :is="axis.icon" class="w-5 h-5" />
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 text-left">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-primary font-bold text-sm font-sans tracking-widest">{{ axis.number }}</span>
                                    <div class="h-px w-8 bg-brand-yellow/50"></div>
                                    <span class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.3em] font-sans">Eje Principal</span>
                                </div>
                                <h3 class="text-2xl font-heading font-bold text-slate-900 uppercase leading-tight mb-6 group-hover:text-primary transition-colors">{{ axis.title }}</h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-8 font-sans text-justify">{{ axis.description }}</p>
                                <button @click="openAxisModal(axis)" class="inline-flex items-center gap-3 px-6 py-3 bg-primary text-white rounded-xl font-bold text-[10px] uppercase tracking-widest shadow-lg hover:bg-slate-900 transition-all duration-300 group/btn font-sans">
                                    Ver Temas Específicos <ArrowRight class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Normativa Section -->
        <section id="normativa" class="py-24 bg-slate-50 border-t border-gray-100">
            <div class="container mx-auto px-4 text-center">
                <div class="mb-16">
                    <h2 class="text-4xl font-heading font-bold text-black mb-4 uppercase">NORMATIVA Y REGLAMENTOS</h2>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-6"></div>
                    <p class="text-lg text-gray-600 max-w-xl mx-auto font-medium font-sans">Descarga los reglamentos oficiales de la Convención Guber 2026.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                    <div class="group">
                        <a href="/media/pdfs/reglamento.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/5 bg-white">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070&auto=format&fit=crop" alt="Reglamento" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2 uppercase">Reglamento Guber 2026</h3>
                            <p class="text-gray-500 text-sm mb-6 px-4 font-sans">Normas generales de participación.</p>
                            <a href="/media/pdfs/reglamento.pdf" target="_blank" class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-full font-bold text-sm transition-all duration-300 shadow-sm font-sans">
                                <FileText class="w-4 h-4" /> Descargar Reglamento (PDF)
                            </a>
                        </div>
                    </div>

                    <div class="group">
                        <a href="/media/pdfs/reglamento_investigacion.pdf" target="_blank" class="block relative overflow-hidden rounded-3xl shadow-xl transition-all duration-500 transform group-hover:-translate-y-2 aspect-[3/4] border border-black/5 bg-white">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=2070&auto=format&fit=crop" alt="Investigación" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </a>
                        <div class="mt-8 text-center">
                            <h3 class="text-2xl font-heading font-bold text-black mb-2 uppercase">Trabajos de Investigación</h3>
                            <p class="text-gray-500 text-sm mb-6 px-4 font-sans">Bases para la presentación de ponencias.</p>
                            <a href="/media/pdfs/reglamento_investigacion.pdf" target="_blank" class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-full font-bold text-sm transition-all duration-300 shadow-sm font-sans">
                                <FlaskConical class="w-4 h-4" /> Descargar Bases (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Research Papers Section -->
        <ResearchPapers />

        <!-- Map Section -->
        <section class="relative py-48 bg-gray-900 overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <iframe src="https://maps.google.com/maps?q=Universidad+Nacional+Amazonica+de+Madre+de+Dios&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0; filter: grayscale(100%) invert(90%) contrast(80%);" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="absolute inset-0 bg-black/60 z-10 backdrop-blur-[2px]"></div>
            <div class="relative z-20 text-center container mx-auto px-4">
                <h2 class="text-4xl font-heading font-bold text-white mb-8 drop-shadow-lg uppercase tracking-wider leading-none">¿CÓMO LLEGAR?</h2>
                <div class="w-32 h-1.5 bg-gradient-to-r from-primary to-brand-yellow rounded-full mx-auto mb-12"></div>
                <a href="https://maps.google.com/?q=Universidad+Nacional+Amazonica+de+Madre+de+Dios" target="_blank" class="inline-flex items-center gap-4 bg-brand-yellow text-white px-10 py-5 rounded-full font-bold text-lg shadow-[0_0_30px_rgba(188,128,32,0.4)] hover:scale-105 transition-all group font-sans">
                    <MapPin class="w-6 h-6 animate-bounce" /> UBÍCANOS EN GOOGLE MAPS
                </a>
            </div>
        </section>

        <!-- Modals -->
        <BenefitsModal :is-open="isModalOpen" :category="selectedCategory" @close="isModalOpen = false" />
        <AxisModal :is-open="isAxisModalOpen" :axis="selectedAxis" @close="isAxisModalOpen = false" />
    </LandingLayout>
</template>