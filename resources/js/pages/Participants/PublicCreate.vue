<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import {
    AlertCircle,
    Award,
    CheckCircle,
    CreditCard,
    Loader2,
    Upload,
    User,
} from 'lucide-vue-next';
import { ref, watch } from 'vue';

import CategoriesModal from '@/components/CategoriesModal.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';

defineProps<{
    canRegister?: boolean;
}>();

const form = useForm({
    dni: '',
    nombres: '',
    apellidos: '',
    email: '',
    celular: '',
    colegio_departamental: '',
    departamento: '',
    provincia: '',
    distrito: '',
    direccion_actual: '',
    categoria_participante: '',
    modalidad_participante: '',
    codigo_pago: '',
    tipo_comprobante: '',
    ruc: '',
    razon_social: '',
    foto_voucher: null as File | null,
});

const isSearchingDni = ref(false);
const showSuccessModal = ref(false);
const showCategoriesModal = ref(false);

watch(
    () => form.dni,
    async (newDni) => {
        if (newDni && newDni.length === 8) {
            isSearchingDni.value = true;
            try {
                const response = await axios.get(`/api/dni/${newDni}`);
                if (response.data && response.data.success) {
                    const data = response.data.data;
                    form.nombres = data.nombres;
                    form.apellidos = `${data.apellido_paterno} ${data.apellido_materno}`;
                }
            } catch (error) {
                console.error('Error buscando DNI:', error);
            } finally {
                isSearchingDni.value = false;
            }
        }
    },
);

const submit = () => {
    form.post('/inscripcion-individual', {
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

const categories = ['PLENOS', 'OBSERVADORES', 'ESTUDIANTES'];
const modalities = ['Presencial', 'Virtual'];
const receiptTypes = ['Boleta', 'Factura'];
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
</script>

<template>
    <Head title="Inscripción Individual - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="min-h-screen bg-gray-50 py-20">
            <div class="container mx-auto max-w-6xl px-4">
                <div class="mb-12 text-center">
                    <h1
                        class="mb-4 text-3xl font-black text-gray-900 md:text-4xl"
                    >
                        INSCRIPCIÓN <span class="text-primary">INDIVIDUAL</span>
                    </h1>
                    <p class="mx-auto max-w-2xl text-gray-600">
                        Completa el formulario para registrar tu participación
                        en la XI Convención Nacional Guber 2026.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Form Section -->
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl lg:col-span-2"
                    >
                        <div
                            class="flex items-center gap-4 border-b border-primary/10 bg-primary/5 px-8 py-6"
                        >
                            <div
                                class="rounded-full bg-white p-3 text-primary shadow-sm"
                            >
                                <User class="h-6 w-6" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">
                                    Datos del Participante
                                </h2>
                                <p class="text-sm text-gray-500">
                                    Información personal y de contacto
                                </p>
                            </div>
                        </div>

                        <form
                            @submit.prevent="submit"
                            class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2"
                        >
                            <!-- Personal Info -->
                            <div class="md:col-span-2">
                                <h3
                                    class="mb-4 border-b pb-2 text-sm font-bold tracking-wider text-gray-400 uppercase"
                                >
                                    Información Personal
                                </h3>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="dni"
                                    class="text-sm font-medium text-gray-700"
                                    >DNI *</label
                                >
                                <div class="relative">
                                    <input
                                        id="dni"
                                        v-model="form.dni"
                                        type="text"
                                        required
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                        placeholder="Número de DNI"
                                        maxlength="8"
                                    />
                                    <div
                                        v-if="isSearchingDni"
                                        class="absolute top-1/2 right-3 -translate-y-1/2"
                                    >
                                        <Loader2
                                            class="h-5 w-5 animate-spin text-primary"
                                        />
                                    </div>
                                </div>
                                <p
                                    v-if="form.errors.dni"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.dni }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="email"
                                    class="text-sm font-medium text-gray-700"
                                    >Correo Electrónico *</label
                                >
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                    placeholder="ejemplo@correo.com"
                                />
                                <p
                                    v-if="form.errors.email"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.email }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="nombres"
                                    class="text-sm font-medium text-gray-700"
                                    >Nombres *</label
                                >
                                <input
                                    id="nombres"
                                    v-model="form.nombres"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                                <p
                                    v-if="form.errors.nombres"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.nombres }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="apellidos"
                                    class="text-sm font-medium text-gray-700"
                                    >Apellidos *</label
                                >
                                <input
                                    id="apellidos"
                                    v-model="form.apellidos"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                                <p
                                    v-if="form.errors.apellidos"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.apellidos }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="celular"
                                    class="text-sm font-medium text-gray-700"
                                    >Celular *</label
                                >
                                <input
                                    id="celular"
                                    v-model="form.celular"
                                    type="tel"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                                <p
                                    v-if="form.errors.celular"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.celular }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="colegio"
                                    class="text-sm font-medium text-gray-700"
                                    >Colegio Departamental</label
                                >
                                <select
                                    id="colegio"
                                    v-model="form.colegio_departamental"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                >
                                    <option value="" disabled>
                                        Seleccione su colegio
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

                            <!-- Location -->
                            <div class="mt-4 md:col-span-2">
                                <h3
                                    class="mb-4 border-b pb-2 text-sm font-bold tracking-wider text-gray-400 uppercase"
                                >
                                    Ubicación
                                </h3>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="departamento"
                                    class="text-sm font-medium text-gray-700"
                                    >Departamento</label
                                >
                                <input
                                    id="departamento"
                                    v-model="form.departamento"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="provincia"
                                    class="text-sm font-medium text-gray-700"
                                    >Provincia</label
                                >
                                <input
                                    id="provincia"
                                    v-model="form.provincia"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="distrito"
                                    class="text-sm font-medium text-gray-700"
                                    >Distrito</label
                                >
                                <input
                                    id="distrito"
                                    v-model="form.distrito"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="direccion"
                                    class="text-sm font-medium text-gray-700"
                                    >Dirección Actual</label
                                >
                                <input
                                    id="direccion"
                                    v-model="form.direccion_actual"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                            </div>

                            <!-- Event Details -->
                            <div class="mt-4 md:col-span-2">
                                <h3
                                    class="mb-4 border-b pb-2 text-sm font-bold tracking-wider text-gray-400 uppercase"
                                >
                                    Datos de Inscripción
                                </h3>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="categoria"
                                    class="text-sm font-medium text-gray-700"
                                    >Categoría *</label
                                >
                                <select
                                    id="categoria"
                                    v-model="form.categoria_participante"
                                    required
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                >
                                    <option value="" disabled>
                                        Seleccione una opción
                                    </option>
                                    <option
                                        v-for="cat in categories"
                                        :key="cat"
                                        :value="cat"
                                    >
                                        {{ cat }}
                                    </option>
                                </select>
                                <p
                                    v-if="form.errors.categoria_participante"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.categoria_participante }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="modalidad"
                                    class="text-sm font-medium text-gray-700"
                                    >Modalidad *</label
                                >
                                <select
                                    id="modalidad"
                                    v-model="form.modalidad_participante"
                                    required
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                >
                                    <option value="" disabled>
                                        Seleccione una opción
                                    </option>
                                    <option
                                        v-for="mod in modalities"
                                        :key="mod"
                                        :value="mod"
                                    >
                                        {{ mod }}
                                    </option>
                                </select>
                            </div>

                            <!-- Payment -->
                            <div class="mt-4 md:col-span-2">
                                <h3
                                    class="mb-4 border-b pb-2 text-sm font-bold tracking-wider text-gray-400 uppercase"
                                >
                                    Pago
                                </h3>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="codigo_pago"
                                    class="text-sm font-medium text-gray-700"
                                    >Código de Operación / Pago</label
                                >
                                <input
                                    id="codigo_pago"
                                    v-model="form.codigo_pago"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                />
                                <p
                                    class="text-[10px] font-medium text-gray-400 italic"
                                >
                                    El código de pago es el número de operación
                                    del Yape o transferencia bancaria.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    for="tipo_comprobante"
                                    class="text-sm font-medium text-gray-700"
                                    >Tipo de Comprobante</label
                                >
                                <select
                                    id="tipo_comprobante"
                                    v-model="form.tipo_comprobante"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                >
                                    <option value="" disabled>
                                        Seleccione una opción
                                    </option>
                                    <option
                                        v-for="type in receiptTypes"
                                        :key="type"
                                        :value="type"
                                    >
                                        {{ type }}
                                    </option>
                                </select>
                            </div>

                            <div
                                v-if="form.tipo_comprobante === 'Factura'"
                                class="space-y-2"
                            >
                                <label
                                    for="ruc"
                                    class="text-sm font-medium text-gray-700"
                                    >RUC *</label
                                >
                                <input
                                    id="ruc"
                                    v-model="form.ruc"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                    placeholder="Ingrese su RUC"
                                />
                                <p
                                    v-if="form.errors.ruc"
                                    class="text-xs text-red-500"
                                >
                                    {{ form.errors.ruc }}
                                </p>
                            </div>

                            <div
                                v-if="form.tipo_comprobante === 'Factura'"
                                class="space-y-2"
                            >
                                <label
                                    for="razon_social"
                                    class="text-sm font-medium text-gray-700"
                                    >Razón Social *</label
                                >
                                <input
                                    id="razon_social"
                                    v-model="form.razon_social"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 transition-all outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                                    placeholder="Razón Social para la factura"
                                />
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label
                                    for="voucher"
                                    class="text-sm font-medium text-gray-700"
                                    >Foto del Voucher (Opcional)</label
                                >
                                <div
                                    class="relative rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-6 text-center transition-colors hover:border-primary"
                                >
                                    <input
                                        type="file"
                                        id="voucher"
                                        @input="
                                            form.foto_voucher =
                                                $event.target.files[0]
                                        "
                                        class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                        accept="image/*"
                                    />
                                    <div
                                        class="pointer-events-none flex flex-col items-center gap-2"
                                    >
                                        <Upload class="h-8 w-8 text-gray-400" />
                                        <span
                                            class="text-sm text-gray-500"
                                            v-if="!form.foto_voucher"
                                            >Arrastra tu archivo aquí o haz clic
                                            para seleccionar</span
                                        >
                                        <span
                                            class="text-sm font-bold text-primary"
                                            v-else
                                            >{{ form.foto_voucher.name }}</span
                                        >
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400">
                                    Formatos permitidos: JPG, PNG. Máx 2MB.
                                </p>
                            </div>

                            <!-- Actions -->
                            <div
                                class="mt-8 flex justify-end gap-4 border-t pt-4 md:col-span-2"
                            >
                                <Link
                                    href="/inscripciones"
                                    class="rounded-lg border border-gray-300 px-6 py-3 font-bold text-gray-700 transition-colors hover:bg-gray-50"
                                >
                                    Cancelar
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="flex items-center gap-2 rounded-lg bg-primary px-8 py-3 font-bold text-white shadow-lg transition-colors hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    <span v-if="form.processing"
                                        >Procesando...</span
                                    >
                                    <span v-else>Completar Inscripción</span>
                                    <CheckCircle
                                        v-if="!form.processing"
                                        class="h-5 w-5"
                                    />
                                </button>
                            </div>
                        </form>
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
                                    El DNI debe tener 8 dígitos válidos.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    El correo electrónico debe ser válido y
                                    único.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    El Colegio Departamental es opcional si no
                                    pertenece a ninguno.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    Seleccione correctamente su tipo y modalidad
                                    de participación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    Para factura es obligatorio el RUC (consulte
                                    previamente).
                                </li>
                                <li class="flex items-start gap-2">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                    ></span>
                                    Suba una imagen clara del voucher para
                                    validar su pago.
                                </li>
                                <li class="flex items-start gap-2 font-bold">
                                    <span
                                        class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-600"
                                    ></span>
                                    El código de pago es el número de operación
                                    del Yape o transferencia bancaria.
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
                                            class="h-2 w-2 rounded-full bg-blue-600"
                                        ></span>
                                        Banco Continental (BBVA)
                                    </h4>
                                    <div
                                        class="space-y-2 pl-4 text-sm text-gray-600"
                                    >
                                        <div
                                            class="rounded-lg border border-blue-100 bg-blue-50 p-3"
                                        >
                                            <p
                                                class="mb-1 text-xs tracking-wide text-blue-500 uppercase"
                                            >
                                                Cuenta Corriente Soles
                                            </p>
                                            <p
                                                class="font-mono text-base font-bold text-blue-900"
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

                        <!-- Orange Note Box -->
                        <div
                            class="rounded-2xl border border-orange-200 bg-orange-50 p-6 shadow-sm"
                        >
                            <div class="mb-3 flex items-center gap-3">
                                <div
                                    class="rounded-lg bg-white p-2 text-orange-600 shadow-sm"
                                >
                                    <AlertCircle class="h-5 w-5" />
                                </div>
                                <h3 class="text-lg font-bold text-orange-900">
                                    Nota Importante
                                </h3>
                            </div>
                            <p
                                class="text-sm leading-relaxed font-medium text-orange-800"
                            >
                                El
                                <span class="font-black underline"
                                    >código de pago</span
                                >
                                solicitado en el formulario es el
                                <span class="font-black"
                                    >número de operación</span
                                >
                                que figura en su comprobante de Yape, Plin o
                                transferencia bancaria.
                            </p>
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
                        Tu registro se ha completado correctamente. Hemos
                        recibido tus datos y constancia de pago.
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
