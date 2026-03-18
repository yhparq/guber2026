<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';

import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Panel de Administración"
        description="Ingresa tus credenciales para acceder al sistema"
    >
        <Head title="Iniciar Sesión" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-primary"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="space-y-5">
                <div class="space-y-2">
                    <Label
                        for="email"
                        class="text-sm font-bold tracking-wide text-slate-700 uppercase"
                        >Correo Electrónico</Label
                    >
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="correo@ejemplo.com"
                        class="h-12 rounded-xl border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-primary"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <Label
                            for="password"
                            class="text-sm font-bold tracking-wide text-slate-700 uppercase"
                            >Contraseña</Label
                        >
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-xs font-bold text-primary transition-colors hover:text-slate-900"
                            :tabindex="5"
                        >
                            ¿Olvidaste tu contraseña?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="h-12 rounded-xl border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-primary focus:ring-primary"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label
                        for="remember"
                        class="flex cursor-pointer items-center gap-3"
                    >
                        <Checkbox
                            id="remember"
                            name="remember"
                            :tabindex="3"
                            class="rounded-md border-slate-300 data-[state=checked]:border-primary data-[state=checked]:bg-primary"
                        />
                        <span class="text-sm font-medium text-slate-600"
                            >Recordarme</span
                        >
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-2 h-12 w-full rounded-xl bg-primary text-sm font-bold tracking-widest uppercase shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-slate-900 hover:shadow-xl"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="mr-2" />
                    <span v-if="processing">Ingresando...</span>
                    <span v-else>Iniciar Sesión</span>
                </Button>
            </div>

            <div
                class="border-t border-slate-100 pt-4 text-center text-sm text-slate-500"
                v-if="canRegister"
            >
                <span>¿No tienes una cuenta?</span>
                <TextLink
                    :href="register()"
                    :tabindex="5"
                    class="ml-1 font-bold text-primary hover:text-slate-900"
                    >Regístrate aquí</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
