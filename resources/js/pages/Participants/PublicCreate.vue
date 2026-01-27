<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { User, Mail, Phone, MapPin, Building, CreditCard, Upload, CheckCircle, AlertCircle } from 'lucide-vue-next';

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
    foto_voucher: null as File | null,
});

const submit = () => {
    form.post('/inscripcion-individual', {
        onSuccess: () => {
            form.reset();
            // You might want to show a success message or redirect to a thank you page
            alert('¡Inscripción realizada con éxito!');
        },
    });
};

const categories = ['Estudiante', 'Profesional', 'Público General'];
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
    'COLEGIO DE CONTADORES PÚBLICOS DE UCAYALI'
];
</script>

<template>
    <Head title="Inscripción Individual - Guber 2026" />

    <LandingLayout :can-register="canRegister">
        <div class="bg-gray-50 min-h-screen py-20">
            <div class="container mx-auto px-4 max-w-6xl">

                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">
                        Inscripción <span class="text-primary">Individual</span>
                    </h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Completa el formulario para registrar tu participación en la XI Convención Nacional Guber 2026.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Form Section -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                        <div class="bg-primary/5 px-8 py-6 border-b border-primary/10 flex items-center gap-4">
                            <div class="p-3 bg-white rounded-full shadow-sm text-primary">
                                <User class="w-6 h-6" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Datos del Participante</h2>
                                <p class="text-sm text-gray-500">Información personal y de contacto</p>
                            </div>
                        </div>

                        <form @submit.prevent="submit" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Info -->
                            <div class="md:col-span-2">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Información Personal</h3>
                            </div>

                            <div class="space-y-2">
                                <label for="dni" class="text-sm font-medium text-gray-700">DNI *</label>
                                <input id="dni" v-model="form.dni" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Número de DNI" />
                                <p v-if="form.errors.dni" class="text-red-500 text-xs">{{ form.errors.dni }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium text-gray-700">Correo Electrónico *</label>
                                <input id="email" v-model="form.email" type="email" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="ejemplo@correo.com" />
                                <p v-if="form.errors.email" class="text-red-500 text-xs">{{ form.errors.email }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="nombres" class="text-sm font-medium text-gray-700">Nombres *</label>
                                <input id="nombres" v-model="form.nombres" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                                <p v-if="form.errors.nombres" class="text-red-500 text-xs">{{ form.errors.nombres }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="apellidos" class="text-sm font-medium text-gray-700">Apellidos *</label>
                                <input id="apellidos" v-model="form.apellidos" type="text" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                                <p v-if="form.errors.apellidos" class="text-red-500 text-xs">{{ form.errors.apellidos }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="celular" class="text-sm font-medium text-gray-700">Celular *</label>
                                <input id="celular" v-model="form.celular" type="tel" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                                <p v-if="form.errors.celular" class="text-red-500 text-xs">{{ form.errors.celular }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="colegio" class="text-sm font-medium text-gray-700">Colegio Departamental</label>
                                <select id="colegio" v-model="form.colegio_departamental" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-white">
                                    <option value="" disabled>Seleccione su colegio</option>
                                    <option v-for="college in professionalColleges" :key="college" :value="college">{{ college }}</option>
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Ubicación</h3>
                            </div>

                            <div class="space-y-2">
                                <label for="departamento" class="text-sm font-medium text-gray-700">Departamento</label>
                                <input id="departamento" v-model="form.departamento" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                            </div>

                            <div class="space-y-2">
                                <label for="provincia" class="text-sm font-medium text-gray-700">Provincia</label>
                                <input id="provincia" v-model="form.provincia" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                            </div>

                            <div class="space-y-2">
                                <label for="distrito" class="text-sm font-medium text-gray-700">Distrito</label>
                                <input id="distrito" v-model="form.distrito" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                            </div>

                            <div class="space-y-2">
                                <label for="direccion" class="text-sm font-medium text-gray-700">Dirección Actual</label>
                                <input id="direccion" v-model="form.direccion_actual" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                            </div>

                            <!-- Event Details -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Datos de Inscripción</h3>
                            </div>

                            <div class="space-y-2">
                                <label for="categoria" class="text-sm font-medium text-gray-700">Categoría *</label>
                                <select id="categoria" v-model="form.categoria_participante" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-white">
                                    <option value="" disabled>Seleccione una opción</option>
                                    <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
                                </select>
                                <p v-if="form.errors.categoria_participante" class="text-red-500 text-xs">{{ form.errors.categoria_participante }}</p>
                            </div>

                            <div class="space-y-2">
                                <label for="modalidad" class="text-sm font-medium text-gray-700">Modalidad *</label>
                                <select id="modalidad" v-model="form.modalidad_participante" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-white">
                                    <option value="" disabled>Seleccione una opción</option>
                                    <option v-for="mod in modalities" :key="mod" :value="mod">{{ mod }}</option>
                                </select>
                            </div>

                            <!-- Payment -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Pago</h3>
                            </div>

                            <div class="space-y-2">
                                <label for="codigo_pago" class="text-sm font-medium text-gray-700">Código de Operación / Pago</label>
                                <input id="codigo_pago" v-model="form.codigo_pago" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                                <p class="text-[10px] text-gray-400 font-medium italic">El código de pago es el número de operación del Yape o transferencia bancaria.</p>
                            </div>

                            <div class="space-y-2">
                                <label for="tipo_comprobante" class="text-sm font-medium text-gray-700">Tipo de Comprobante</label>
                                <select id="tipo_comprobante" v-model="form.tipo_comprobante" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-white">
                                    <option value="" disabled>Seleccione una opción</option>
                                    <option v-for="type in receiptTypes" :key="type" :value="type">{{ type }}</option>
                                </select>
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label for="voucher" class="text-sm font-medium text-gray-700">Foto del Voucher (Opcional)</label>
                                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary transition-colors bg-gray-50">
                                    <input type="file" id="voucher" @input="form.foto_voucher = $event.target.files[0]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" />
                                    <div class="flex flex-col items-center gap-2 pointer-events-none">
                                        <Upload class="w-8 h-8 text-gray-400" />
                                        <span class="text-sm text-gray-500" v-if="!form.foto_voucher">Arrastra tu archivo aquí o haz clic para seleccionar</span>
                                        <span class="text-sm text-primary font-bold" v-else>{{ form.foto_voucher.name }}</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400">Formatos permitidos: JPG, PNG. Máx 2MB.</p>
                            </div>

                            <!-- Actions -->
                            <div class="md:col-span-2 mt-8 pt-4 border-t flex justify-end gap-4">
                                <Link href="/inscripciones" class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors">
                                    Cancelar
                                </Link>
                                <button type="submit" :disabled="form.processing" class="px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                                    <span v-if="form.processing">Procesando...</span>
                                    <span v-else>Completar Inscripción</span>
                                    <CheckCircle v-if="!form.processing" class="w-5 h-5" />
                                </button>
                            </div>
                        </form>
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
                                    El DNI debe tener 8 dígitos válidos.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    El correo electrónico debe ser válido y único.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    El Colegio Departamental es opcional si no pertenece a ninguno.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Seleccione correctamente su tipo y modalidad de participación.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Para factura es obligatorio el RUC (consulte previamente).
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-400 rounded-full shrink-0"></span>
                                    Suba una imagen clara del voucher para validar su pago.
                                </li>
                                <li class="flex items-start gap-2 font-bold">
                                    <span class="mt-1.5 w-1.5 h-1.5 bg-red-600 rounded-full shrink-0"></span>
                                    El código de pago es el número de operación del Yape o transferencia bancaria.
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
                                El <span class="font-black underline">código de pago</span> solicitado en el formulario es el <span class="font-black">número de operación</span> que figura en su comprobante de Yape, Plin o transferencia bancaria.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </LandingLayout>
</template>
