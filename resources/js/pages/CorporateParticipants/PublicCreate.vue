<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import {
    AlertCircle,
    Award,
    Building2,
    CheckCircle,
    CreditCard,
    Loader2,
    MapPin,
    Upload,
    Users,
} from 'lucide-vue-next';
import { ref, watch } from 'vue';

import CategoriesModal from '@/components/CategoriesModal.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';

defineProps<{
    canRegister?: boolean;
}>();

const numberOfParticipants = ref(5); // Default to min
const maxParticipants = 20;
const minParticipants = 5;
const searchingStates = ref<boolean[]>([]); // Track searching state per index
const showSuccessModal = ref(false);
const showCategoriesModal = ref(false);

const professionalColleges = [
    'NO PERTENEZCO A NINGÚN COLEGIO DEPARTAMENTAL',
    'COLEGIO DE CONTADORES PÚBLICOS DE PUNO',
    'COLEGIO DE CONTADORES PÚBLICOS DE ANCASH',
    'COLEGIO DE CONTADORES PÚBLICOS DE AMAZONAS',
    'COLEGIO DE CONTADORES PÚBLICOS DE APURIMAC',
    'COLEGIO DE CONTADORES PÚBLICOS DE AREQUIPA',
    'COLEGIO DE CONTADORES PÚBLICOS DE AYACUCHO',
    'COLEGIO DE CONTADORES PÚBLICOS DE CAJAMARCA',
    'COLEGIO DE CONTADORES PÚBLICOS DE CALLAO',
    'COLEGIO DE CONTADORES PÚBLICOS DE CUSCO',
    'COLEGIO DE CONTADORES PÚBLICOS DE HUANCAVELICA',
    'COLEGIO DE CONTADORES PÚBLICOS DE HUÁNUCO',
    'COLEGIO DE CONTADORES PÚBLICOS DE ICA',
    'COLEGIO DE CONTADORES PÚBLICOS DE JUNÍN',
    'COLEGIO DE CONTADORES PÚBLICOS DE LA LIBERTAD',
    'COLEGIO DE CONTADORES PÚBLICOS DE LAMBAYEQUE',
    'COLEGIO DE CONTADORES PÚBLICOS DE LIMA',
    'COLEGIO DE CONTADORES PÚBLICOS DE LORETO',
    'COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS',
    'COLEGIO DE CONTADORES PÚBLICOS DE MOQUEGUA',
    'COLEGIO DE CONTADORES PÚBLICOS DE PASCO',
    'COLEGIO DE CONTADORES PÚBLICOS DE PIURA',
    'COLEGIO DE CONTADORES PÚBLICOS DE SAN MARTÍN',
    'COLEGIO DE CONTADORES PÚBLICOS DE TACNA',
    'COLEGIO DE CONTADORES PÚBLICOS DE TUMBES',
    'COLEGIO DE CONTADORES PÚBLICOS DE UCAYALI',
];

const categories = ['PLENOS', 'OBSERVADORES', 'ESTUDIANTES'];
const modalities = ['Presencial', 'Virtual'];
const receiptTypes = ['Factura', 'Boleta'];
const individualReceiptTypes = ['Boleta', 'Factura'];

const form = useForm({
    razon_social: '', // Global Company Name (Optional/Reference if individual invoices used)
    codigo_pago: '',
    tipo_comprobante: 'Factura', // Global Receipt Type
    foto_voucher: null as File | null,
    participants: [] as Array<{
        dni: string;
        nombres: string;
        apellidos: string;
        email: string;
        celular: string;

        // Location
        departamento: string;
        provincia: string;
        distrito: string;
        direccion: string;

        colegio_departamental: string;
        categoria: string;
        modalidad: string;

        // Individual Invoice Details
        tipo_comprobante: string; // 'Boleta' or 'Factura'
        ruc: string; // Only if Factura
    }>,
});

// Initialize participants array
const initializeParticipants = () => {
    const currentCount = form.participants.length;
    const targetCount = numberOfParticipants.value;

    if (targetCount > currentCount) {
        for (let i = 0; i < targetCount - currentCount; i++) {
            form.participants.push({
                dni: '',
                nombres: '',
                apellidos: '',
                email: '',
                celular: '',
                departamento: '',
                provincia: '',
                distrito: '',
                direccion: '',
                colegio_departamental: '',
                categoria: '',
                modalidad: 'Presencial',
                tipo_comprobante: 'Boleta',
                ruc: '',
            });
            searchingStates.value.push(false);
        }
    } else if (targetCount < currentCount) {
        form.participants.splice(targetCount);
        searchingStates.value.splice(targetCount);
    }
};

// Watch for changes in number of participants
watch(
    numberOfParticipants,
    () => {
        if (numberOfParticipants.value < minParticipants)
            numberOfParticipants.value = minParticipants;
        if (numberOfParticipants.value > maxParticipants)
            numberOfParticipants.value = maxParticipants;
        initializeParticipants();
    },
    { immediate: true },
);

const searchDni = async (index: number) => {
    const dni = form.participants[index].dni;
    if (dni && dni.length === 8) {
        searchingStates.value[index] = true;
        try {
            const response = await axios.get(`/api/dni/${dni}`);
            if (response.data && response.data.success) {
                const data = response.data.data;
                form.participants[index].nombres = data.nombres;
                form.participants[index].apellidos = `${data.apellido_paterno} ${data.apellido_materno}`;
            }
        } catch (error) {
            console.error('Error buscando DNI:', error);
        } finally {
            searchingStates.value[index] = false;
        }
    }
};

const submit = () => {
    form.post('/inscripcion-corporativa', {
        onSuccess: () => {
            form.reset();
            showSuccessModal.value = true;
        },
    });
};

const closeSuccessModal = () => {
    showSuccessModal.value = false;
    router.visit('/inscripciones');
};
</script>

<template>
    <Head title="Inscripción Corporativa - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="min-h-screen bg-gray-50 py-20">
            <div class="container mx-auto max-w-6xl px-4">
                <div class="mb-12 text-center">
                    <h1
                        class="mb-4 text-3xl font-black text-gray-900 md:text-4xl"
                    >
                        INSCRIPCIÓN
                        <span class="text-primary">CORPORATIVA</span>
                    </h1>
                    <p class="mx-auto max-w-2xl text-gray-600">
                        Registro para delegaciones, empresas e instituciones
                        (Mínimo 5 participantes).
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Form Section -->
                    <div class="space-y-8 lg:col-span-2">
                        <!-- Number of Participants Control -->
                        <div
                            class="flex items-center justify-between rounded-2xl border border-gray-100 bg-white p-6 shadow"
                        >
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Número de Participantes
                                </h3>
                                <p class="text-xs font-medium text-primary">
                                    Mínimo 5 participantes.
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <button
                                    @click="numberOfParticipants--"
                                    class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 hover:bg-gray-50 disabled:opacity-50"
                                    :disabled="
                                        numberOfParticipants <= minParticipants
                                    "
                                >
                                    -
                                </button>
                                <span
                                    class="w-12 text-center text-2xl font-bold"
                                    >{{ numberOfParticipants }}</span
                                >
                                <button
                                    @click="numberOfParticipants++"
                                    class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 hover:bg-gray-50 disabled:opacity-50"
                                    :disabled="
                                        numberOfParticipants >= maxParticipants
                                    "
                                >
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Unified Payment & Company Info -->
                        <div
                            class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl"
                        >
                            <div
                                class="flex items-center gap-4 border-b border-primary/10 bg-primary/5 px-8 py-6"
                            >
                                <div
                                    class="rounded-full bg-white p-3 text-primary shadow-sm"
                                >
                                    <Building2 class="h-6 w-6" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        Facturación y Pago Unificado
                                    </h2>
                                    <p class="text-sm text-gray-500">
                                        Datos del depósito global para la
                                        delegación
                                    </p>
                                </div>
                            </div>

                            <div
                                class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2"
                            >
                                <!-- Global Company Info -->
                                <div class="space-y-2 md:col-span-2">
                                    <label
                                        for="razon_social"
                                        class="text-sm font-medium text-gray-700"
                                        >Razón Social / Institución (Referencia
                                        Grupo) *</label
                                    >
                                    <input
                                        id="razon_social"
                                        v-model="form.razon_social"
                                        type="text"
                                        required
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                    />
                                    <p
                                        v-if="form.errors.razon_social"
                                        class="text-xs text-red-500"
                                    >
                                        {{ form.errors.razon_social }}
                                    </p>
                                </div>

                                <!-- Payment Info -->
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-medium text-gray-700"
                                        >Código de Operación *</label
                                    >
                                    <input
                                        v-model="form.codigo_pago"
                                        type="text"
                                        required
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-primary"
                                        placeholder="N° Operación"
                                    />
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-medium text-gray-700"
                                        >Voucher de Pago (Único) *</label
                                    >
                                    <div
                                        class="relative flex h-[46px] items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-2 text-center transition-colors hover:border-primary"
                                    >
                                        <input
                                            type="file"
                                            @input="
                                                form.foto_voucher =
                                                    $event.target.files[0]
                                            "
                                            class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                            accept="image/*"
                                        />
                                        <div
                                            class="pointer-events-none flex items-center gap-2 truncate px-2"
                                        >
                                            <Upload
                                                class="h-4 w-4 text-gray-400"
                                            />
                                            <span
                                                class="truncate text-xs font-bold text-primary"
                                                v-if="form.foto_voucher"
                                                >{{
                                                    form.foto_voucher.name
                                                }}</span
                                            >
                                            <span
                                                class="text-xs text-gray-500"
                                                v-else
                                                >Subir Voucher</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Participants List -->
                        <div
                            class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl"
                        >
                            <div
                                class="flex items-center gap-4 border-b border-gray-200 bg-gray-50 px-8 py-6"
                            >
                                <div
                                    class="rounded-full bg-white p-3 text-gray-600 shadow-sm"
                                >
                                    <Users class="h-6 w-6" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        Lista de Participantes
                                    </h2>
                                    <p class="text-sm text-gray-500">
                                        Ingrese los datos de cada asistente
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-12 p-8">
                                <div
                                    v-for="(
                                        participant, index
                                    ) in form.participants"
                                    :key="index"
                                    class="relative rounded-xl border border-gray-200 bg-gray-50 p-6 shadow-sm"
                                >
                                    <div
                                        class="absolute -top-3 -left-3 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-primary font-bold text-white shadow-md"
                                    >
                                        {{ index + 1 }}
                                    </div>

                                    <div
                                        class="mt-2 grid grid-cols-1 gap-4 md:grid-cols-2"
                                    >
                                        <!-- Row 1 -->
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >DNI *</label
                                            >
                                            <div class="relative">
                                                <input
                                                    v-model="participant.dni"
                                                    @input="searchDni(index)"
                                                    type="text"
                                                    required
                                                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                    placeholder="DNI"
                                                    maxlength="8"
                                                />
                                                <div
                                                    v-if="
                                                        searchingStates[index]
                                                    "
                                                    class="absolute top-1/2 right-3 -translate-y-1/2"
                                                >
                                                    <Loader2
                                                        class="h-4 w-4 animate-spin text-primary"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Nombres *</label
                                            >
                                            <input
                                                v-model="participant.nombres"
                                                type="text"
                                                required
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                placeholder="Nombres"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Apellidos *</label
                                            >
                                            <input
                                                v-model="participant.apellidos"
                                                type="text"
                                                required
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                placeholder="Apellidos"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Email *</label
                                            >
                                            <input
                                                v-model="participant.email"
                                                type="email"
                                                required
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                placeholder="Email personal"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Celular *</label
                                            >
                                            <input
                                                v-model="participant.celular"
                                                type="tel"
                                                required
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                placeholder="Celular"
                                            />
                                        </div>

                                        <!-- Section: Location -->
                                        <div
                                            class="mt-4 mb-2 border-b border-gray-200 pb-2 md:col-span-2"
                                        >
                                            <h4
                                                class="flex items-center gap-1 text-xs font-bold tracking-wider text-gray-400 uppercase"
                                            >
                                                <MapPin class="h-3 w-3" />
                                                Ubicación
                                            </h4>
                                        </div>

                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Departamento</label
                                            >
                                            <input
                                                v-model="
                                                    participant.departamento
                                                "
                                                type="text"
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Provincia</label
                                            >
                                            <input
                                                v-model="participant.provincia"
                                                type="text"
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Distrito</label
                                            >
                                            <input
                                                v-model="participant.distrito"
                                                type="text"
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Dirección *</label
                                            >
                                            <input
                                                v-model="participant.direccion"
                                                type="text"
                                                required
                                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm outline-none focus:border-primary"
                                                placeholder="Dirección exacta"
                                            />
                                        </div>

                                        <!-- Section: Professional Info -->
                                        <div
                                            class="mt-4 mb-2 border-b border-gray-200 pb-2 md:col-span-2"
                                        >
                                            <h4
                                                class="text-xs font-bold tracking-wider text-gray-400 uppercase"
                                            >
                                                Datos Profesionales
                                            </h4>
                                        </div>

                                        <div class="space-y-1 md:col-span-2">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Colegio Departamental</label
                                            >
                                            <select
                                                v-model="
                                                    participant.colegio_departamental
                                                "
                                                class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-sm outline-none focus:border-primary"
                                            >
                                                <option value="" disabled>
                                                    Seleccione una opción
                                                </option>
                                                <option
                                                    v-for="college in professionalColleges"
                                                    :key="college"
                                                    :value="college"
                                                >
                                                    {{ college }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Categoría *</label
                                            >
                                            <select
                                                v-model="participant.categoria"
                                                class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-sm outline-none focus:border-primary"
                                            >
                                                <option value="" disabled>
                                                    Seleccione
                                                </option>
                                                <option
                                                    v-for="cat in categories"
                                                    :key="cat"
                                                    :value="cat"
                                                >
                                                    {{ cat }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Modalidad *</label
                                            >
                                            <select
                                                v-model="participant.modalidad"
                                                class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-sm outline-none focus:border-primary"
                                            >
                                                <option
                                                    v-for="mod in modalities"
                                                    :key="mod"
                                                    :value="mod"
                                                >
                                                    {{ mod }}
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Section: Individual Invoice -->
                                        <div
                                            class="mt-4 mb-2 rounded border-b border-gray-200 bg-gray-100/50 p-2 pb-2 md:col-span-2"
                                        >
                                            <h4
                                                class="text-xs font-bold tracking-wider text-gray-700 uppercase"
                                            >
                                                Comprobante Individual
                                            </h4>
                                        </div>

                                        <div class="space-y-1">
                                            <label
                                                class="text-xs font-bold text-gray-500 uppercase"
                                                >Tipo Comprobante</label
                                            >
                                            <select
                                                v-model="
                                                    participant.tipo_comprobante
                                                "
                                                class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-sm outline-none focus:border-primary"
                                            >
                                                <option
                                                    v-for="type in individualReceiptTypes"
                                                    :key="type"
                                                    :value="type"
                                                >
                                                    {{ type }}
                                                </option>
                                            </select>
                                        </div>

                                        <div
                                            v-if="
                                                participant.tipo_comprobante ===
                                                'Factura'
                                            "
                                            class="space-y-1 md:col-span-2"
                                        >
                                            <label
                                                class="animate-pulse text-xs font-bold text-primary uppercase"
                                                >RUC *</label
                                            >
                                            <input
                                                v-model="participant.ruc"
                                                type="text"
                                                class="w-full rounded border border-primary bg-white px-3 py-2 text-sm ring-1 ring-primary/20 outline-none focus:border-primary"
                                                placeholder="Ingrese RUC"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Final Submit Action -->
                            <div
                                class="flex justify-end gap-4 border-t border-gray-200 bg-gray-50 p-6"
                            >
                                <Link
                                    href="/inscripciones"
                                    class="rounded-lg border border-gray-300 px-6 py-3 font-bold text-gray-700 transition-colors hover:bg-gray-100"
                                >
                                    Cancelar
                                </Link>
                                <button
                                    @click="submit"
                                    :disabled="form.processing"
                                    class="flex items-center gap-2 rounded-lg bg-primary px-8 py-3 font-bold text-white shadow-lg transition-colors hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    <span v-if="form.processing"
                                        >Enviando...</span
                                    >
                                    <span v-else>Registrar Delegación</span>
                                    <CheckCircle
                                        v-if="!form.processing"
                                        class="h-5 w-5"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="space-y-6 lg:col-span-1">
                        <!-- Important Info -->
                        <div
                            class="rounded-2xl border border-red-100 bg-red-50 p-6"
                        >
                            <div class="mb-4 flex items-center gap-3">
                                <div
                                    class="rounded-lg bg-white p-2 text-red-600 shadow-sm"
                                >
                                    <AlertCircle class="h-5 w-5" />
                                </div>
                                <h3 class="text-lg font-bold text-red-900">
                                    Información Importante
                                </h3>
                            </div>
                            <ul class="space-y-3 text-sm text-red-800">
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    <span class="font-bold"
                                        >Mínimo 5 participantes</span
                                    >.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    Pago unificado para toda la delegación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    Si requiere factura por participante,
                                    seleccione la opción y complete el RUC.
                                </li>
                            </ul>
                        </div>

                        <button
                            type="button"
                            @click="showCategoriesModal = true"
                            class="group flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-primary bg-white py-3.5 font-bold text-primary shadow-sm transition-all duration-300 hover:bg-primary hover:text-white"
                        >
                            <Award
                                class="h-5 w-5 transition-transform group-hover:scale-110"
                            />
                            Ver Beneficios por Categoría
                        </button>

                        <!-- Payment Methods -->
                        <div
                            class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
                        >
                            <div
                                class="flex items-center gap-3 bg-primary px-6 py-4"
                            >
                                <div
                                    class="rounded-lg bg-white/20 p-2 text-white backdrop-blur-sm"
                                >
                                    <CreditCard class="h-6 w-6" />
                                </div>
                                <h3 class="text-lg font-bold text-white">
                                    MEDIOS DE PAGO
                                </h3>
                            </div>

                            <div class="space-y-6 p-6">
                                <div>
                                    <h4
                                        class="mb-3 flex items-center gap-2 font-bold text-gray-800"
                                    >
                                        <span
                                            class="h-2 w-2 rounded-full bg-primary"
                                        ></span>
                                        Billetera Digital (Yape/Plin)
                                    </h4>
                                    <div
                                        class="space-y-2 pl-4 text-sm text-gray-600"
                                    >
                                        <p>
                                            A nombre de:
                                            <span
                                                class="font-semibold text-gray-800"
                                                >COLEGIO DE CONTADORES PÚBLICOS
                                                DE MADRE DE DIOS</span
                                            >
                                        </p>
                                        <div
                                            class="flex flex-col items-center justify-center rounded-lg bg-gray-100 p-4"
                                        >
                                            <img
                                                src="/media/imgs/qr.png"
                                                alt="QR de Pago"
                                                class="mb-2 h-32 w-32 rounded-lg object-cover opacity-50"
                                            />
                                            <p
                                                class="inline-flex items-center gap-1 text-xs font-medium text-primary"
                                            >
                                                <Upload class="h-3 w-3" />
                                                Escanear QR
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4
                                        class="mb-3 flex items-center gap-2 font-bold text-gray-800"
                                    >
                                        <span
                                            class="h-2 w-2 rounded-full bg-primary"
                                        ></span>
                                        Banco Continental (BBVA)
                                    </h4>
                                    <div
                                        class="space-y-2 pl-4 text-sm text-gray-600"
                                    >
                                        <div
                                            class="rounded-lg border border-primary/10 bg-primary/5 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-primary uppercase"
                                            >
                                                Cuenta Corriente Soles
                                            </p>
                                            <p
                                                class="font-mono text-base font-bold text-gray-900"
                                            >
                                                0011-0263-0100039835
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-lg border border-gray-100 bg-gray-50 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-gray-400 uppercase"
                                            >
                                                Código de Cuenta Interbancaria
                                            </p>
                                            <p
                                                class="font-mono text-sm font-medium text-gray-800"
                                            >
                                                01126300010003983512
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4
                                        class="mb-3 flex items-center gap-2 font-bold text-gray-800"
                                    >
                                        <span
                                            class="h-2 w-2 rounded-full bg-[#059c5b]"
                                        ></span>
                                        Interbank
                                    </h4>
                                    <div
                                        class="space-y-2 pl-4 text-sm text-gray-600"
                                    >
                                        <div
                                            class="rounded-lg border border-[#059c5b]/20 bg-[#059c5b]/5 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-[#059c5b] uppercase"
                                            >
                                                Cuenta Corriente
                                            </p>
                                            <p
                                                class="font-mono text-base font-bold text-[#059c5b]"
                                            >
                                                335-300400846-2
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-lg border border-gray-100 bg-gray-50 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-gray-400 uppercase"
                                            >
                                                Código de Cuenta Interbancaria
                                            </p>
                                            <p
                                                class="font-mono text-sm font-medium text-gray-800"
                                            >
                                                003-335-003004008462-73
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4
                                        class="mb-3 flex items-center gap-2 font-bold text-gray-800"
                                    >
                                        <span
                                            class="h-2 w-2 rounded-full bg-[#002a8d]"
                                        ></span>
                                        Banco de Crédito (BCP)
                                    </h4>
                                    <div
                                        class="space-y-2 pl-4 text-sm text-gray-600"
                                    >
                                        <div
                                            class="rounded-lg border border-[#002a8d]/20 bg-[#002a8d]/5 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-[#002a8d] uppercase"
                                            >
                                                Cuenta Corriente
                                            </p>
                                            <p
                                                class="font-mono text-base font-bold text-[#002a8d]"
                                            >
                                                485-9971744-0-73
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-lg border border-gray-100 bg-gray-50 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-gray-400 uppercase"
                                            >
                                                Código de Cuenta Interbancaria
                                            </p>
                                            <p
                                                class="font-mono text-sm font-medium text-gray-800"
                                            >
                                                002-485-009971744073-11
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div
            v-if="showSuccessModal"
            class="fixed inset-0 z-50 flex animate-in items-center justify-center bg-black/50 p-4 backdrop-blur-sm duration-200 fade-in"
        >
            <div
                class="w-full max-w-md scale-100 transform animate-in overflow-hidden rounded-3xl bg-white shadow-2xl duration-200 zoom-in-95"
            >
                <div
                    class="flex flex-col items-center justify-center bg-green-600 p-6 text-white"
                >
                    <div class="mb-4 rounded-full bg-white/20 p-4">
                        <CheckCircle class="h-12 w-12 text-white" />
                    </div>
                    <h3 class="text-center text-2xl font-black">
                        ¡INSCRIPCIÓN EXITOSA!
                    </h3>
                </div>
                <div class="p-8 text-center">
                    <p class="mb-8 text-lg text-gray-600">
                        El registro de la delegación se ha completado
                        correctamente. Hemos recibido los datos y la constancia
                        de pago.
                    </p>
                    <button
                        @click="closeSuccessModal"
                        class="w-full transform rounded-xl bg-green-600 py-3.5 font-bold text-white shadow-lg transition-colors hover:-translate-y-0.5 hover:bg-green-700 hover:shadow-xl"
                    >
                        Aceptar
                    </button>
                </div>
            </div>
        </div>

        <CategoriesModal
            :is-open="showCategoriesModal"
            @close="showCategoriesModal = false"
        />
    </LandingLayout>
</template>
