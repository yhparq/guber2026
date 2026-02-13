<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Users, Building2, GraduationCap, Image as ImageIcon } from 'lucide-vue-next';

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
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';

import AppLogo from './AppLogo.vue';

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
    <Sidebar collapsible="icon" variant="inset" class="bg-slate-950 text-slate-200 border-r border-white/5">
        <SidebarHeader class="bg-slate-950 border-b border-white/5 py-4">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child class="hover:bg-white/5 text-white transition-all">
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

        <SidebarFooter class="bg-slate-950 border-t border-white/5">
            <NavFooter :items="footerNavItems" />
            <NavUser class="hover:bg-white/5" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
