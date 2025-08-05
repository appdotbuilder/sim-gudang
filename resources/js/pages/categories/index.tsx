import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Category {
    id: number;
    name: string;
    description: string | null;
    code: string;
    products_count: number;
    created_at: string;
    updated_at: string;
}

interface Props {
    categories: {
        data: Category[];
        current_page: number;
        per_page: number;
        total: number;
        last_page: number;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Categories',
        href: '/categories',
    },
];

export default function CategoriesIndex({ categories }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Categories" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">🏷️ Categories</h1>
                        <p className="text-gray-600 dark:text-gray-400">Organize your products by categories</p>
                    </div>
                    <Link
                        href="/categories/create"
                        className="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
                    >
                        Add Category
                    </Link>
                </div>

                {/* Categories Grid */}
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {categories.data.length > 0 ? (
                        categories.data.map((category) => (
                            <div key={category.id} className="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                                <div className="p-6">
                                    <div className="flex items-start justify-between">
                                        <div className="flex-1">
                                            <div className="flex items-center mb-2">
                                                <span className="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mr-2">
                                                    {category.code}
                                                </span>
                                                <span className="text-sm text-gray-500 dark:text-gray-400">
                                                    {category.products_count} products
                                                </span>
                                            </div>
                                            <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                                {category.name}
                                            </h3>
                                            {category.description && (
                                                <p className="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                                    {category.description}
                                                </p>
                                            )}
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                Created {formatDate(category.created_at)}
                                            </p>
                                        </div>
                                    </div>
                                    <div className="mt-4 flex justify-end space-x-2">
                                        <Link
                                            href={`/categories/${category.id}`}
                                            className="text-sm text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium"
                                        >
                                            View
                                        </Link>
                                        <Link
                                            href={`/categories/${category.id}/edit`}
                                            className="text-sm text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 font-medium"
                                        >
                                            Edit
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="col-span-full">
                            <div className="text-center py-12">
                                <div className="text-6xl mb-4">📂</div>
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">No categories found</h3>
                                <p className="text-gray-600 dark:text-gray-400 mb-4">Get started by creating your first category</p>
                                <Link
                                    href="/categories/create"
                                    className="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
                                >
                                    Create Category
                                </Link>
                            </div>
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {categories.data.length > 0 && categories.last_page > 1 && (
                    <div className="bg-white dark:bg-gray-800 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div className="flex items-center justify-between">
                            <div className="text-sm text-gray-700 dark:text-gray-300">
                                Showing {((categories.current_page - 1) * categories.per_page) + 1} to {Math.min(categories.current_page * categories.per_page, categories.total)} of {categories.total} results
                            </div>
                            <div className="flex space-x-1">
                                {categories.links.map((link, index) => (
                                    <div key={index}>
                                        {link.url ? (
                                            <Link
                                                href={link.url}
                                                className={`px-3 py-2 text-sm font-medium rounded-md ${
                                                    link.active
                                                        ? 'bg-blue-600 text-white'
                                                        : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-600'
                                                }`}
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        ) : (
                                            <span
                                                className="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-600 cursor-not-allowed"
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        )}
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}