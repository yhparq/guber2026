<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="relative flex min-h-svh items-center justify-center overflow-hidden"
    >
        <!-- Background with gradient and pattern -->
        <div class="absolute inset-0 bg-slate-900">
            <!-- Decorative gradient orbs -->
            <div
                class="absolute top-0 right-0 h-[500px] w-[500px] translate-x-1/2 -translate-y-1/2 rounded-full bg-primary/10 blur-[120px]"
            ></div>
            <div
                class="absolute bottom-0 left-0 h-[400px] w-[400px] -translate-x-1/2 translate-y-1/2 rounded-full bg-brand-yellow/10 blur-[100px]"
            ></div>
            <!-- Subtle grid pattern -->
            <div
                class="absolute inset-0 opacity-[0.03]"
                style="
                    background-image: radial-gradient(
                        circle,
                        #fff 1px,
                        transparent 1px
                    );
                    background-size: 30px 30px;
                "
            ></div>
        </div>

        <div class="relative w-full max-w-md px-6 py-12">
            <!-- Logo Section -->
            <div class="mb-10 text-center">
                <Link href="/" class="group inline-flex items-center gap-3">
                    <div
                        class="rounded-xl bg-white p-2 shadow-lg transition-transform duration-300 group-hover:rotate-6"
                    >
                        <img
                            src="/media/imgs/logo1.png"
                            alt="Guber Logo"
                            class="h-12 w-auto"
                        />
                    </div>
                    <div class="flex flex-col items-start leading-none">
                        <span
                            class="font-heading text-3xl font-black tracking-tighter text-white"
                            >GUBER</span
                        >
                        <span
                            class="text-xs font-black tracking-[0.4em] text-brand-yellow uppercase"
                            >2026</span
                        >
                    </div>
                </Link>
            </div>

            <!-- Card -->
            <div
                class="rounded-[3rem] border-t-8 border-brand-yellow bg-white p-8 shadow-2xl md:p-10"
            >
                <!-- Title -->
                <div class="mb-8 text-center">
                    <h1
                        class="font-heading text-2xl font-black tracking-tight text-slate-900 uppercase"
                    >
                        {{ title }}
                    </h1>
                    <p class="mt-2 text-sm font-medium text-slate-500">
                        {{ description }}
                    </p>
                    <div
                        class="mx-auto mt-4 h-1 w-16 rounded-full bg-gradient-to-r from-primary to-brand-yellow"
                    ></div>
                </div>

                <slot />
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs font-medium text-slate-500">
                    XI Convención Nacional de Contabilidad Gubernamental y
                    Gestión Pública
                </p>
            </div>
        </div>
    </div>
</template>
