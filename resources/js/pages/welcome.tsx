import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Warehouse Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-blue-900">
                {/* Header */}
                <header className="relative z-10">
                    <nav className="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
                        <div className="flex items-center gap-3">
                            <div className="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                                <span className="text-white font-bold text-lg">📦</span>
                            </div>
                            <span className="text-xl font-bold text-gray-900 dark:text-white">
                                Warehouse Pro
                            </span>
                        </div>
                        
                        <div className="flex items-center gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="text-sm font-semibold leading-6 text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                    >
                                        Get Started
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <main className="relative">
                    <div className="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
                        <div className="mx-auto max-w-2xl text-center">
                            <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl dark:text-white">
                                📦 Warehouse Management
                                <span className="text-blue-600"> Made Simple</span>
                            </h1>
                            <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                                Complete warehouse management solution with real-time inventory tracking, 
                                automated stock alerts, and comprehensive reporting. Perfect for businesses 
                                of all sizes.
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-x-6">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                    >
                                        Go to Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('register')}
                                            className="rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                        >
                                            Start Free Trial
                                        </Link>
                                        <Link
                                            href={route('login')}
                                            className="text-base font-semibold leading-7 text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400"
                                        >
                                            Sign In <span aria-hidden="true">→</span>
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Features Section */}
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:text-center">
                            <h2 className="text-base font-semibold leading-7 text-blue-600">Everything you need</h2>
                            <p className="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                Powerful warehouse management features
                            </p>
                        </div>
                        <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                            <dl className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">📊</span>
                                        </div>
                                        Real-time Dashboard
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Monitor total stock, low stock alerts, and recent transactions at a glance with our comprehensive dashboard.</p>
                                    </dd>
                                </div>
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">📋</span>
                                        </div>
                                        Inventory Management
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Complete product and category management with auto-generated codes and stock level tracking.</p>
                                    </dd>
                                </div>
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">📈</span>
                                        </div>
                                        Smart Reports
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Generate detailed stock reports and transaction history with PDF export capabilities.</p>
                                    </dd>
                                </div>
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">📦</span>
                                        </div>
                                        Goods Management
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Track incoming and outgoing goods with automatic stock updates and supplier information.</p>
                                    </dd>
                                </div>
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">🚚</span>
                                        </div>
                                        Delivery Orders
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Generate delivery orders and track shipping status with customer information management.</p>
                                    </dd>
                                </div>
                                <div className="flex flex-col">
                                    <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                        <div className="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600">
                                            <span className="text-white text-lg">🧾</span>
                                        </div>
                                        Invoice Generation
                                    </dt>
                                    <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                                        <p className="flex-auto">Create professional invoices linked to sales with customer details and printable PDF format.</p>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    {/* CTA Section */}
                    <div className="mx-auto mt-32 max-w-7xl px-6 sm:mt-40 lg:px-8">
                        <div className="mx-auto max-w-2xl text-center">
                            <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                Ready to streamline your warehouse?
                            </h2>
                            <p className="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600 dark:text-gray-300">
                                Join thousands of businesses using our warehouse management system to optimize their operations.
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-x-6">
                                {!auth.user && (
                                    <>
                                        <Link
                                            href={route('register')}
                                            className="rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                        >
                                            Get started today
                                        </Link>
                                        <Link
                                            href={route('login')}
                                            className="text-base font-semibold leading-7 text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400"
                                        >
                                            Already have an account? <span aria-hidden="true">→</span>
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="mt-32 border-t border-gray-900/10 py-16 dark:border-gray-700">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="text-center">
                            <p className="text-sm leading-5 text-gray-500 dark:text-gray-400">
                                Built with Laravel + React for modern warehouse management
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}