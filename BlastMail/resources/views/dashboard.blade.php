<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Subscribers -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
                    <div class="p-3 bg-indigo-100 dark:bg-indigo-900/40 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Subscribers') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($subscribersCount) }}</p>
                    </div>
                </div>

                <!-- Total Lists -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/40 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Email Lists') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($listsCount) }}</p>
                    </div>
                </div>

                <!-- Total Campaigns -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/40 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Campaigns') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($campaignsCount) }}</p>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Subscriber Growth') }}</h3>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Last 15 Days') }}</span>
                </div>
                <div class="h-72">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Campaigns -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Recent Campaigns') }}</h3>
                        <a href="{{ route('campaigns.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">{{ __('View All') }}</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400">
                                    <th class="px-6 py-3 font-medium">{{ __('Name') }}</th>
                                    <th class="px-6 py-3 font-medium">{{ __('List') }}</th>
                                    <th class="px-6 py-3 font-medium text-right">{{ __('Date') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($recentCampaigns as $campaign)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('campaigns.show', $campaign) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                {{ $campaign->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $campaign->emailList->title ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-right text-gray-500 dark:text-gray-400">{{ $campaign->created_at->format('M d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400 italic">
                                            {{ __('No campaigns yet.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Subscribers -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Recent Subscribers') }}</h3>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('Last 5 added') }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400">
                                    <th class="px-6 py-3 font-medium">{{ __('Subscriber') }}</th>
                                    <th class="px-6 py-3 font-medium">{{ __('List') }}</th>
                                    <th class="px-6 py-3 font-medium text-right">{{ __('Joined') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($recentSubscribers as $subscriber)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-900 dark:text-white">{{ $subscriber->name }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $subscriber->email }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $subscriber->emailList->title ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-right text-gray-500 dark:text-gray-400 text-xs">{{ $subscriber->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400 italic">
                                            {{ __('No subscribers yet.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('growthChart').getContext('2d');
            const isDarkMode = document.documentElement.classList.contains('dark');
            
            const textColor = isDarkMode ? '#9ca3af' : '#6b7280';
            const gridColor = isDarkMode ? 'rgba(75, 85, 99, 0.2)' : 'rgba(229, 231, 235, 0.5)';

            const data = @json($growthData);
            const labels = data.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('{{ app()->getLocale() }}', { month: 'short', day: 'numeric' });
            });
            const values = data.map(item => item.aggregate);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.length > 0 ? labels : {!! json_encode(array_map(fn($i) => now()->subDays(15-$i)->format('M d'), range(0, 15))) !!},
                    datasets: [{
                        label: '{{ __('New Subscribers') }}',
                        data: values.length > 0 ? values : Array(16).fill(0),
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#6366f1',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: isDarkMode ? '#1f2937' : '#ffffff',
                            titleColor: isDarkMode ? '#f3f4f6' : '#111827',
                            bodyColor: isDarkMode ? '#d1d5db' : '#374151',
                            borderColor: gridColor,
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                color: textColor,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: gridColor,
                                borderDash: [4, 4],
                            },
                            ticks: {
                                color: textColor,
                                font: {
                                    size: 11
                                },
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>
    @endpush
</x-layouts.app>
