<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useActiveUrl } from '@/composables/useActiveUrl';
import { type NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();

const { urlIsActive } = useActiveUrl();
</script>

<template>
    <SidebarGroup class="px-2 py-4">
        <SidebarGroupLabel class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-2 px-4">Administración</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton
                    as-child
                    :is-active="urlIsActive(item.href)"
                    :tooltip="item.title"
                    class="hover:bg-white/5 hover:text-white text-slate-400 py-6 px-4 transition-all rounded-xl data-[active=true]:bg-primary data-[active=true]:text-white data-[active=true]:shadow-lg data-[active=true]:shadow-primary/20"
                >
                    <Link :href="item.href" class="flex items-center gap-3">
                        <component :is="item.icon" class="size-5" />
                        <span class="text-xs font-bold uppercase tracking-widest">{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
