<script setup lang="ts">
import { Head, useForm, router } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { Users, Building2, CreditCard, Upload, CheckCircle, Trash2, Plus, AlertCircle, MapPin, Loader2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';
import axios from 'axios';

defineProps<{
    canRegister?: boolean;
}>();

const numberOfParticipants = ref(2); // Default to min
const maxParticipants = 20;
const minParticipants = 2;
const searchingStates = ref<boolean[]>([]); // Track searching state per index
const showSuccessModal = ref(false);

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
    'COLEGIO DE CONTADORES PÚBLICOS DE UCAYALI'
];

const categories = ['Estudiante', 'Profesional', 'Público General'];
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
    }>
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
                ruc: ''
            });
        }
    } else if (targetCount < currentCount) {
        form.participants.splice(targetCount);
    }
};

// Watch for changes in number of participants
watch(numberOfParticipants, () => {
    if (numberOfParticipants.value < minParticipants) numberOfParticipants.value = minParticipants;
    if (numberOfParticipants.value > maxParticipants) numberOfParticipants.value = maxParticipants;
    initializeParticipants();
}, { immediate: true });

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
        <div class="bg-gray-50 min-h-screen py-20">
            <div class="container mx-auto px-4 max-w-6xl">
                
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">
                        INSCRIPCIÓN <span class="text-primary">CORPORATIVA</span>
                    </h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Registro para delegaciones, empresas e instituciones (Mínimo 2 participantes).
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Form Section -->
                    <div class="lg:col-span-2 space-y-8">

                        <!-- Number of Participants Control -->
                        <div class="bg-white rounded-2xl shadow p-6 border border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Número de Participantes</h3>
                                <p class="text-xs text-primary font-medium">Mínimo 2 participantes.</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <button @click="numberOfParticipants--" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 disabled:opacity-50" :disabled="numberOfParticipants <= minParticipants">-</button>
                                <span class="text-2xl font-bold w-12 text-center">{{ numberOfParticipants }}</span>
                                <button @click="numberOfParticipants++" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 disabled:opacity-50" :disabled="numberOfParticipants >= maxParticipants">+</button>
                            </div>
                        </div>
                        
                        <!-- Unified Payment & Company Info -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                            <div class="bg-primary/5 px-8 py-6 border-b border-primary/10 flex items-center gap-4">
                                <div class="p-3 bg-white rounded-full shadow-sm text-primary">
                                    <Building2 class="w-6 h-6" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Facturación y Pago Unificado</h2>
                                    <p class="text-sm text-gray-500">Datos del depósito global para la delegación</p>
                                </div>
                            </div>

                            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Global Company Info -->
                                <div class="space-y-2 md:col-span-2">
                                    <label for="razon_social" class="text-sm font-medium text-gray-700">Razón Social / Institución (Referencia Grupo) *</label>
                                    <input id="razon_social" v-model="form.razon_social" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                                    <p v-if="form.errors.razon_social" class="text-red-500 text-xs">{{ form.errors.razon_social }}</p>
                                </div>

                                <!-- Payment Info -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Código de Operación *</label>
                                    <input v-model="form.codigo_pago" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="N° Operación" />
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Voucher de Pago (Único) *</label>
                                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-2 text-center hover:border-primary transition-colors bg-gray-50 h-[46px] flex items-center justify-center">
                                        <input type="file" @input="form.foto_voucher = $event.target.files[0]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" />
                                        <div class="flex items-center gap-2 pointer-events-none truncate px-2">
                                            <Upload class="w-4 h-4 text-gray-400" />
                                            <span class="text-xs text-primary font-bold truncate" v-if="form.foto_voucher">{{ form.foto_voucher.name }}</span>
                                            <span class="text-xs text-gray-500" v-else>Subir Voucher</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Participants List -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                            <div class="bg-gray-50 px-8 py-6 border-b border-gray-200 flex items-center gap-4">
                                <div class="p-3 bg-white rounded-full shadow-sm text-gray-600">
                                    <Users class="w-6 h-6" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Lista de Participantes</h2>
                                    <p class="text-sm text-gray-500">Ingrese los datos de cada asistente</p>
                                </div>
                            </div>

                            <div class="p-8 space-y-12">
                                <div v-for="(participant, index) in form.participants" :key="index" class="relative bg-gray-50 rounded-xl p-6 border border-gray-200 shadow-sm">
                                    <div class="absolute -top-3 -left-3 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold shadow-md z-10">
                                        {{ index + 1 }}
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        
                                        <!-- Row 1 -->
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">DNI *</label>
                                            <div class="relative">
                                                <input v-model="participant.dni" @input="searchDni(index)" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="DNI" maxlength="8" />
                                                <div v-if="searchingStates[index]" class="absolute right-3 top-1/2 -translate-y-1/2">
                                                    <Loader2 class="w-4 h-4 text-primary animate-spin" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Nombres *</label>
                                            <input v-model="participant.nombres" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="Nombres" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Apellidos *</label>
                                            <input v-model="participant.apellidos" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="Apellidos" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Email *</label>
                                            <input v-model="participant.email" type="email" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="Email personal" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Celular *</label>
                                            <input v-model="participant.celular" type="tel" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="Celular" />
                                        </div>

                                        <!-- Section: Location -->
                                        <div class="md:col-span-2 border-b border-gray-200 pb-2 mb-2 mt-4">
                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1">
                                                <MapPin class="w-3 h-3" /> Ubicación
                                            </h4>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Departamento</label>
                                            <input v-model="participant.departamento" type="text" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Provincia</label>
                                            <input v-model="participant.provincia" type="text" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Distrito</label>
                                            <input v-model="participant.distrito" type="text" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Dirección *</label>
                                            <input v-model="participant.direccion" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm" placeholder="Dirección exacta" />
                                        </div>

                                        <!-- Section: Professional Info -->
                                        <div class="md:col-span-2 border-b border-gray-200 pb-2 mb-2 mt-4">
                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Datos Profesionales</h4>
                                        </div>

                                        <div class="space-y-1 md:col-span-2">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Colegio Departamental</label>
                                            <select v-model="participant.colegio_departamental" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm bg-white">
                                                <option value="" disabled>Seleccione una opción</option>
                                                <option v-for="college in professionalColleges" :key="college" :value="college">{{ college }}</option>
                                            </select>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Categoría *</label>
                                            <select v-model="participant.categoria" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm bg-white">
                                                <option value="" disabled>Seleccione</option>
                                                <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
                                            </select>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Modalidad *</label>
                                            <select v-model="participant.modalidad" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm bg-white">
                                                <option v-for="mod in modalities" :key="mod" :value="mod">{{ mod }}</option>
                                            </select>
                                        </div>

                                        <!-- Section: Individual Invoice -->
                                        <div class="md:col-span-2 border-b border-gray-200 pb-2 mb-2 mt-4 bg-gray-100/50 p-2 rounded">
                                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Comprobante Individual</h4>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Tipo Comprobante</label>
                                            <select v-model="participant.tipo_comprobante" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-primary outline-none text-sm bg-white">
                                                <option v-for="type in individualReceiptTypes" :key="type" :value="type">{{ type }}</option>
                                            </select>
                                        </div>

                                        <div v-if="participant.tipo_comprobante === 'Factura'" class="space-y-1 md:col-span-2">
                                            <label class="text-xs font-bold text-primary uppercase animate-pulse">RUC *</label>
                                            <input v-model="participant.ruc" type="text" class="w-full px-3 py-2 rounded border border-primary ring-1 ring-primary/20 focus:border-primary outline-none text-sm bg-white" placeholder="Ingrese RUC" />
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Final Submit Action -->
                            <div class="bg-gray-50 p-6 border-t border-gray-200 flex justify-end gap-4">
                                <Link href="/inscripciones" class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition-colors">
                                    Cancelar
                                </Link>
                                <button @click="submit" :disabled="form.processing" class="px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                                    <span v-if="form.processing">Enviando...</span>
                                    <span v-else>Registrar Delegación</span>
                                    <CheckCircle v-if="!form.processing" class="w-5 h-5" />
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Sidebar Info -->
                    <div class="lg:col-span-1 space-y-6">
                        
                        <!-- Important Info -->
                        <div class="bg-red-50 rounded-2xl border border-red-100 p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-white text-red-600 rounded-lg shadow-sm">
                                    <AlertCircle class="w-5 h-5" />
                                </div>
                                <h3 class="text-lg font-bold text-red-900">Información Importante</h3>
                            </div>
                            <ul class="space-y-3 text-sm text-red-800">
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    <span class="font-bold">Mínimo 2 participantes</span>.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Pago unificado para toda la delegación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Si requiere factura por participante, seleccione la opción y complete el RUC.
                                </li>
                            </ul>
                        </div>

                        <!-- Payment Methods -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="bg-primary px-6 py-4 flex items-center gap-3">
                                <div class="p-2 bg-white/20 text-white rounded-lg backdrop-blur-sm">
                                    <CreditCard class="w-6 h-6" />
                                </div>
                                <h3 class="text-lg font-bold text-white">MEDIOS DE PAGO</h3>
                            </div>

                            <div class="p-6 space-y-6">
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-primary rounded-full"></span>
                                        Billetera Digital (Yape/Plin)
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <p>A nombre de: <span class="font-semibold text-gray-800">COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS</span></p>
                                        <div class="bg-gray-100 rounded-lg p-4 flex flex-col items-center justify-center">
                                            <img src="/media/imgs/qr.png" alt="QR de Pago" class="w-32 h-32 object-cover rounded-lg mb-2 opacity-50" />
                                            <p class="inline-flex items-center gap-1 text-primary font-medium text-xs">
                                                <Upload class="w-3 h-3" /> Escanear QR
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-primary rounded-full"></span>
                                        Banco Continental (BBVA)
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <div class="bg-primary/5 p-3 rounded-lg border border-primary/10">
                                            <p class="text-xs text-primary uppercase tracking-wide mb-1">Cuenta Corriente Soles</p>
                                            <p class="font-mono font-bold text-gray-900 text-base">0011-0263-0100039835</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Código de Cuenta Interbancaria</p>
                                            <p class="font-mono font-medium text-gray-800 text-sm">01126300010003983512</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-[#059c5b] rounded-full"></span>
                                        Interbank
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <div class="bg-[#059c5b]/5 p-3 rounded-lg border border-[#059c5b]/20">
                                            <p class="text-xs text-[#059c5b] uppercase tracking-wide mb-1">Cuenta Corriente</p>
                                            <p class="font-mono font-bold text-[#059c5b] text-base">335-300400846-2</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Código de Cuenta Interbancaria</p>
                                            <p class="font-mono font-medium text-gray-800 text-sm">003-335-003004008462-73</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-[#002a8d] rounded-full"></span>
                                        Banco de Crédito (BCP)
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <div class="bg-[#002a8d]/5 p-3 rounded-lg border border-[#002a8d]/20">
                                            <p class="text-xs text-[#002a8d] uppercase tracking-wide mb-1">Cuenta Corriente</p>
                                            <p class="font-mono font-bold text-[#002a8d] text-base">485-9971744-0-73</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Código de Cuenta Interbancaria</p>
                                            <p class="font-mono font-medium text-gray-800 text-sm">002-485-009971744073-11</p>
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
        <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-in fade-in duration-200">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform scale-100 animate-in zoom-in-95 duration-200">
                <div class="bg-green-600 p-6 flex flex-col items-center justify-center text-white">
                    <div class="bg-white/20 p-4 rounded-full mb-4">
                        <CheckCircle class="w-12 h-12 text-white" />
                    </div>
                    <h3 class="text-2xl font-black text-center">¡INSCRIPCIÓN EXITOSA!</h3>
                </div>
                <div class="p-8 text-center">
                    <p class="text-gray-600 mb-8 text-lg">
                        El registro de la delegación se ha completado correctamente. Hemos recibido los datos y la constancia de pago.
                    </p>
                    <button @click="closeSuccessModal" class="w-full py-3.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>