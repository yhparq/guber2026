<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}>();
</script>

<template>
    <div
        v-if="links.length > 3"
        class="flex items-center justify-between border-t border-slate-100 bg-white px-6 py-4"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <Link
                v-if="links[0].url"
                :href="links[0].url"
                class="relative inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition-colors hover:bg-slate-50"
            >
                Anterior
            </Link>
            <Link
                v-if="links[links.length - 1].url"
                :href="links[links.length - 1].url"
                class="relative ml-3 inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition-colors hover:bg-slate-50"
            >
                Siguiente
            </Link>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
            <nav
                class="relative z-0 inline-flex -space-x-px rounded-2xl bg-slate-50 p-1 shadow-sm"
                aria-label="Pagination"
            >
                <template v-for="(link, key) in links" :key="key">
                    <div
                        v-if="link.url === null"
                        class="relative inline-flex cursor-default items-center border border-transparent px-4 py-2 text-xs font-black tracking-widest text-slate-300 uppercase"
                        v-html="link.label"
                    />
                    <Link
                        v-else
                        :href="link.url"
                        class="relative inline-flex items-center rounded-xl px-4 py-2 text-xs font-black tracking-widest uppercase transition-all"
                        :class="
                            link.active
                                ? 'z-10 bg-primary text-white shadow-lg shadow-primary/20'
                                : 'text-slate-500 hover:bg-white hover:text-primary'
                        "
                        v-html="link.label"
                    />
                </template>
            </nav>
        </div>
    </div>
</template>
