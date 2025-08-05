import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { BookOpen, Folder, LayoutGrid, Package, Tag, TrendingUp, TrendingDown } from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Products',
        href: '/products',
        icon: Package,
        items: [
            {
                title: 'All Products',
                href: '/products',
            },
            {
                title: 'Add Product',
                href: '/products/create',
            },
        ],
    },
    {
        title: 'Categories',
        href: '/categories',
        icon: Tag,
        items: [
            {
                title: 'All Categories',
                href: '/categories',
            },
            {
                title: 'Add Category',
                href: '/categories/create',
            },
        ],
    },
    {
        title: 'Incoming Goods',
        href: '/incoming-goods',
        icon: TrendingUp,
        items: [
            {
                title: 'All Incoming',
                href: '/incoming-goods',
            },
            {
                title: 'Add Incoming',
                href: '/incoming-goods/create',
            },
        ],
    },
    {
        title: 'Outgoing Goods',
        href: '/outgoing-goods',
        icon: TrendingDown,
        items: [
            {
                title: 'All Outgoing',
                href: '/outgoing-goods',
            },
            {
                title: 'Add Outgoing',
                href: '/outgoing-goods/create',
            },
        ],
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/react-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#react',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
