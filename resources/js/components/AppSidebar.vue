<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    Building2,
    Image as ImageIcon,
    Users,
} from 'lucide-vue-next';

import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';

import AppLogo from './AppLogo.vue';

import { dashboard } from '@/routes';

const mainNavItems: NavItem[] = [
    {
        title: 'Participantes',
        href: '/participants',
        icon: Users,
    },
    {
        title: 'Corp. Participantes',
        href: '/corporate-participants',
        icon: Building2,
    },
    {
        title: 'Fotos',
        href: '/photos',
        icon: ImageIcon,
    },
    {
        title: 'Ponencias',
        href: '/ponencias',
        icon: BookOpen,
    },
];

const footerNavItems: NavItem[] = [];
</script>

<template>
    <Sidebar
        collapsible="icon"
        variant="inset"
        class="border-r border-white/5 bg-slate-950 text-slate-200"
    >
        <SidebarHeader class="border-b border-white/5 bg-slate-950 py-4">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton
                        size="lg"
                        as-child
                        class="text-white transition-all hover:bg-white/5"
                    >
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="bg-slate-950">
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter class="border-t border-white/5 bg-slate-950">
            <NavFooter :items="footerNavItems" />
            <NavUser class="hover:bg-white/5" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
