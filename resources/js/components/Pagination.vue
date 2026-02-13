<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

defineProps<{
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}>();
</script>

<template>
    <div v-if="links.length > 3" class="flex items-center justify-between px-6 py-4 bg-white border-t border-slate-100">
        <div class="flex-1 flex justify-between sm:hidden">
            <Link 
                v-if="links[0].url" 
                :href="links[0].url" 
                class="relative inline-flex items-center px-4 py-2 border border-slate-200 text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-colors"
            >
                Anterior
            </Link>
            <Link 
                v-if="links[links.length - 1].url" 
                :href="links[links.length - 1].url" 
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-slate-200 text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 transition-colors"
            >
                Siguiente
            </Link>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
            <nav class="relative z-0 inline-flex rounded-2xl shadow-sm -space-x-px bg-slate-50 p-1" aria-label="Pagination">
                <template v-for="(link, key) in links" :key="key">
                    <div v-if="link.url === null" 
                        class="relative inline-flex items-center px-4 py-2 border border-transparent text-xs font-black uppercase tracking-widest text-slate-300 cursor-default"
                        v-html="link.label"
                    />
                    <Link v-else
                        :href="link.url"
                        class="relative inline-flex items-center px-4 py-2 text-xs font-black uppercase tracking-widest transition-all rounded-xl"
                        :class="link.active 
                            ? 'z-10 bg-primary text-white shadow-lg shadow-primary/20' 
                            : 'text-slate-500 hover:bg-white hover:text-primary'"
                        v-html="link.label"
                    />
                </template>
            </nav>
        </div>
    </div>
</template>
