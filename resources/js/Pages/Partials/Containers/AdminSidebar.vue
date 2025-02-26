<script setup lang="ts">
import NavMain from '@/registry/new-york/block/Sidebar07/components/NavMain.vue'
import NavUser from '@/registry/new-york/block/Sidebar07/components/NavUser.vue'
import TeamSwitcher from '@/registry/new-york/block/Sidebar07/components/TeamSwitcher.vue'
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader, type SidebarProps,
    SidebarRail,
} from '@/registry/new-york/ui/sidebar'
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

import {
    AudioWaveform,
    BookOpen,
    Bot,
    Command,
    Frame,
    GalleryVerticalEnd,
    Map,
    PieChart,
    Settings2,
    SquareTerminal,
} from 'lucide-vue-next'

const page = usePage();
const user = computed(() => page.props[0].auth.user);

const props = defineProps({
    collapsible: {
        type: String,
        default: 'icon',
    },
});

const props = withDefaults(defineProps<SidebarProps>(), {
    collapsible: 'icon',
})

// This is sample data.
const data = {
    user: {
        name: props.user.full_name,
        email: props.user.email,
        avatar: '/avatars/shadcn.jpg',
    },
    teams: [
        {
            name: 'Pixelware',
            logo: GalleryVerticalEnd,
            plan: 'Enterprise',
        },
        {
            name: 'Acme Corp.',
            logo: AudioWaveform,
            plan: 'Startup',
        },
        {
            name: 'Evil Corp.',
            logo: Command,
            plan: 'Free',
        },
    ],
    navMain: [
        {
            title: 'Invoicing',
            url: '#',
            icon: SquareTerminal,
            isActive: true,
            items: [
                {
                    title: 'Overview',
                    url: '#',
                },
                {
                    title: 'History',
                    url: '#',
                },
                {
                    title: 'Settings',
                    url: '#',
                },
            ],
        },
        {
            title: 'Logging',
            url: '#',
            icon: Bot,
            items: [
                {
                    title: 'Overview',
                    url: '#',
                },
                {
                    title: 'History',
                    url: '#',
                },
                {
                    title: 'Settings',
                    url: '#',
                },
            ],
        },
        {
            title: 'Companies',
            url: '#',
            icon: BookOpen,
            items: [
                {
                    title: 'Overview',
                    url: '#',
                },
            ],
        },
        {
            title: 'Settings',
            url: '#',
            icon: Settings2,
            items: [
                {
                    title: 'General',
                    url: '#',
                },
                {
                    title: 'Team',
                    url: '#',
                },
                {
                    title: 'Billing',
                    url: '#',
                },
                {
                    title: 'Limits',
                    url: '#',
                },
            ],
        },
    ]
}
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <TeamSwitcher :teams="data.teams" />
        </SidebarHeader>
        <SidebarContent>
            <NavMain :items="data.navMain" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser :user="data.user" />
        </SidebarFooter>
        <SidebarRail />
    </Sidebar>
</template>
