<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { Users, Building2, CreditCard, Upload, CheckCircle, Trash2, Plus, AlertCircle } from 'lucide-vue-next';
import { ref, watch } from 'vue';

defineProps<{
    canRegister?: boolean;
}>();

const numberOfParticipants = ref(3);
const maxParticipants = 20;
const minParticipants = 3;

const form = useForm({
    razon_social: '',
    ruc: '',
    direccion: '',
    email_contacto: '',
    celular_contacto: '',
    codigo_pago: '',
    tipo_comprobante: 'Factura',
    foto_voucher: null as File | null,
    participants: [] as Array<{
        dni: string;
        nombres: string;
        apellidos: string;
        email: string;
        celular: string;
        categoria: string;
        modalidad: string;
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
                categoria: 'Corporativo',
                modalidad: 'Presencial',
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
            alert('¡Inscripción corporativa realizada con éxito!');
        },
    });
};

const modalities = ['Presencial', 'Virtual'];
const receiptTypes = ['Factura', 'Boleta'];

</script>

<template>
    <Head title="Inscripción Corporativa - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="bg-gray-50 min-h-screen py-20">
            <div class="container mx-auto px-4 max-w-6xl">
                
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">
                        Inscripción <span class="text-blue-600">Corporativa</span>
                    </h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Registro para delegaciones, empresas e instituciones (Mínimo 3 participantes).
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Form Section -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Company Info & Settings -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                            <div class="bg-blue-600/5 px-8 py-6 border-b border-blue-600/10 flex items-center gap-4">
                                <div class="p-3 bg-white rounded-full shadow-sm text-blue-600">
                                    <Building2 class="w-6 h-6" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Datos de la Institución</h2>
                                    <p class="text-sm text-gray-500">Información de facturación y contacto principal</p>
                                </div>
                            </div>

                            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-sm font-medium text-gray-700">Número de Participantes</label>
                                    <div class="flex items-center gap-4">
                                        <button @click="numberOfParticipants--" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 disabled:opacity-50" :disabled="numberOfParticipants <= minParticipants">-</button>
                                        <span class="text-2xl font-bold w-12 text-center">{{ numberOfParticipants }}</span>
                                        <button @click="numberOfParticipants++" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 disabled:opacity-50" :disabled="numberOfParticipants >= maxParticipants">+</button>
                                    </div>
                                    <p class="text-xs text-blue-600 font-medium">Mínimo 3 participantes para tarifa corporativa.</p>
                                </div>

                                <div class="space-y-2">
                                    <label for="ruc" class="text-sm font-medium text-gray-700">RUC *</label>
                                    <input id="ruc" v-model="form.ruc" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all" />
                                    <p v-if="form.errors.ruc" class="text-red-500 text-xs">{{ form.errors.ruc }}</p>
                                </div>

                                <div class="space-y-2">
                                    <label for="razon_social" class="text-sm font-medium text-gray-700">Razón Social / Institución *</label>
                                    <input id="razon_social" v-model="form.razon_social" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all" />
                                    <p v-if="form.errors.razon_social" class="text-red-500 text-xs">{{ form.errors.razon_social }}</p>
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <label for="direccion" class="text-sm font-medium text-gray-700">Dirección Fiscal</label>
                                    <input id="direccion" v-model="form.direccion" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all" />
                                </div>

                                <div class="space-y-2">
                                    <label for="email_contacto" class="text-sm font-medium text-gray-700">Email de Contacto *</label>
                                    <input id="email_contacto" v-model="form.email_contacto" type="email" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all" />
                                </div>

                                <div class="space-y-2">
                                    <label for="celular_contacto" class="text-sm font-medium text-gray-700">Celular de Contacto *</label>
                                    <input id="celular_contacto" v-model="form.celular_contacto" type="tel" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all" />
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

                            <div class="p-8 space-y-8">
                                <div v-for="(participant, index) in form.participants" :key="index" class="relative bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <div class="absolute -top-3 -left-3 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold shadow-md">
                                        {{ index + 1 }}
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">DNI</label>
                                            <input v-model="participant.dni" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm" placeholder="DNI" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Nombres</label>
                                            <input v-model="participant.nombres" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm" placeholder="Nombres" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Apellidos</label>
                                            <input v-model="participant.apellidos" type="text" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm" placeholder="Apellidos" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Email</label>
                                            <input v-model="participant.email" type="email" required class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm" placeholder="Email personal" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Celular</label>
                                            <input v-model="participant.celular" type="tel" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm" placeholder="Celular" />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-bold text-gray-500 uppercase">Modalidad</label>
                                            <select v-model="participant.modalidad" class="w-full px-3 py-2 rounded border border-gray-300 focus:border-blue-600 outline-none text-sm bg-white">
                                                <option v-for="mod in modalities" :key="mod" :value="mod">{{ mod }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Submission -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Detalles del Pago Unificado</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Código de Operación</label>
                                    <input v-model="form.codigo_pago" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 outline-none" />
                                    <p class="text-[10px] text-gray-400 font-medium italic">Número de operación del depósito global.</p>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Tipo de Comprobante</label>
                                    <select v-model="form.tipo_comprobante" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-600 outline-none bg-white">
                                        <option v-for="type in receiptTypes" :key="type" :value="type">{{ type }}</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Voucher de Pago (Único)</label>
                                    <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-600 transition-colors bg-gray-50">
                                        <input type="file" @input="form.foto_voucher = $event.target.files[0]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" />
                                        <div class="flex flex-col items-center gap-2 pointer-events-none">
                                            <Upload class="w-8 h-8 text-gray-400" />
                                            <span class="text-sm text-gray-500" v-if="!form.foto_voucher">Subir imagen del voucher global</span>
                                            <span class="text-sm text-blue-600 font-bold" v-else>{{ form.foto_voucher.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end gap-4">
                                <Link href="/inscripciones" class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors">
                                    Cancelar
                                </Link>
                                <button @click="submit" :disabled="form.processing" class="px-8 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
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
                                    <span class="font-bold">Mínimo 3 participantes</span> para acceder a la tarifa corporativa.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Se requiere un solo pago por el monto total de la delegación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    El RUC y Razón Social son obligatorios para la facturación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Asegúrese de ingresar correctamente los correos de cada participante para el envío de credenciales.
                                </li>
                            </ul>
                        </div>

                        <!-- Payment Methods -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="bg-blue-600 px-6 py-4 flex items-center gap-3">
                                <div class="p-2 bg-white/20 text-white rounded-lg backdrop-blur-sm">
                                    <CreditCard class="w-6 h-6" />
                                </div>
                                <h3 class="text-lg font-bold text-white">MEDIOS DE PAGO</h3>
                            </div>

                            <div class="p-6 space-y-6">
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                        Billetera Digital (Yape/Plin)
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <p>A nombre de: <span class="font-semibold text-gray-800">COLEGIO DE CONTADORES PÚBLICOS DE MADRE DE DIOS</span></p>
                                        <div class="bg-gray-100 rounded-lg p-4 flex flex-col items-center justify-center">
                                            <img src="/media/imgs/qr.png" alt="QR de Pago" class="w-32 h-32 object-cover rounded-lg mb-2 opacity-50" />
                                            <p class="inline-flex items-center gap-1 text-blue-600 font-medium text-xs">
                                                <Upload class="w-3 h-3" /> Escanear QR
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                        Banco Continental (BBVA)
                                    </h4>
                                    <div class="pl-4 text-sm text-gray-600 space-y-2">
                                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                                            <p class="text-xs text-blue-500 uppercase tracking-wide mb-1">Cuenta Corriente Soles</p>
                                            <p class="font-mono font-bold text-blue-900 text-base">0011-0263-0100039835</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Código de Cuenta Interbancaria</p>
                                            <p class="font-mono font-medium text-gray-800 text-sm">01126300010003983512</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orange Note Box -->
                        <div class="bg-orange-50 rounded-2xl border border-orange-200 p-6 shadow-sm">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-white text-orange-600 rounded-lg shadow-sm">
                                    <AlertCircle class="w-5 h-5" />
                                </div>
                                <h3 class="text-lg font-bold text-orange-900">Nota Importante</h3>
                            </div>
                            <p class="text-sm text-orange-800 leading-relaxed font-medium">
                                El <span class="font-black underline">código de pago</span> debe ser el número de operación único que cubra el monto total de todos los inscritos.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
