<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Campaign Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('campaigns.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Back') }}
                </a>
                <a href="{{ route('campaigns.edit', $campaign) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Edit Campaign') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            
            <!-- Campaign Setup Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Setup Details') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Name') }}</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $campaign->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Subject') }}</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $campaign->subject }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Email List') }}</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $campaign->emailList->title ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Scheduled For') }}</p>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $campaign->send_at ? $campaign->send_at->format('M d, Y H:i') : 'Not scheduled' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Tracking') }}</p>
                            <div class="flex gap-4">
                                <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-700 px-2 py-1 text-xs font-medium text-gray-600 dark:text-gray-300 ring-1 ring-inset ring-gray-500/10">
                                    {{ $campaign->track_click ? 'Clicks: On' : 'Clicks: Off' }}
                                </span>
                                <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-700 px-2 py-1 text-xs font-medium text-gray-600 dark:text-gray-300 ring-1 ring-inset ring-gray-500/10">
                                    {{ $campaign->track_open ? 'Opens: On' : 'Opens: Off' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Body Preview (Accordion) -->
            <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <button @click="open = !open" class="w-full flex items-center justify-between p-6 focus:outline-none transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <div class="flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Email Content Preview') }}</h3>
                    </div>
                    <svg :class="open ? 'rotate-180' : ''" class="h-5 w-5 text-gray-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse x-cloak>
                    <div class="p-6 pt-0">
                        <div class="prose max-w-none border rounded-md p-6 bg-white text-gray-900 border-gray-200 shadow-inner">
                            {!! $campaign->body !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tracking Dashboard (Tabs) -->
            <div x-data="{ activeTab: 'stats' }" class="space-y-4">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8" aria-label="Tracking Sections">
                        <button @click="activeTab = 'stats'" 
                            :class="activeTab === 'stats' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            {{ __('Statistics') }}
                        </button>
                        <button @click="activeTab = 'opened'" 
                            :class="activeTab === 'opened' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 0 1 .89-1.664l7-4.666a2 2 0 0 1 2.22 0l7 4.666A2 2 0 0 1 21 10.07V19M3 19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2M3 19l6.75-4.5M21 19l-6.75-4.5m0 0a2 2 0 0 0-2.5 0l-1.5 1a2 2 0 0 1-2.5 0l-1.5-1A2 2 0 0 0 6.75 14.5M15 14.5V21M9 14.5V21" />
                            </svg>
                            {{ __('Opened') }}
                             <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300">{{ $campaign->statistics['total_openings'] }}</span>
                        </button>
                        <button @click="activeTab = 'clicked'" 
                            :class="activeTab === 'clicked' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                            {{ __('Clicked') }}
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">{{ $campaign->statistics['total_clicks'] }}</span>
                        </button>
                    </nav>
                </div>

                <!-- Tab Content: Statistics -->
                <div x-show="activeTab === 'stats'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                    <!-- Stats Overview Top Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Total Sent') }}</span>
                            <span class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($campaign->statistics['sent']) }}</span>
                        </div>
                        
                        <div class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Opened') }}</span>
                            <div class="flex items-baseline gap-2">
                                <span class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($campaign->statistics['total_openings']) }}</span>
                                <span class="text-sm font-medium text-green-500">{{ $campaign->statistics['open_rate'] }}%</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Clicked') }}</span>
                            <div class="flex items-baseline gap-2">
                                <span class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($campaign->statistics['total_clicks']) }}</span>
                                <span class="text-sm font-medium text-green-500">{{ $campaign->statistics['click_rate'] }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Main Chart -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Performance Over Time') }}</h3>
                            <div class="flex gap-4 text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-1.5 order-1">
                                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                                    Opens
                                </span>
                                <span class="flex items-center gap-1.5 order-2">
                                    <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                                    Clicks
                                </span>
                            </div>
                        </div>
                        <div class="relative h-80">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Opened List -->
                <div x-show="activeTab === 'opened'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('Subscriber') }}</x-table.th>
                                    <x-table.th>{{ __('Status') }}</x-table.th>
                                    <x-table.th>{{ __('Delivered At') }}</x-table.th>
                                    <x-table.th class="text-right">{{ __('Openings') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                                @forelse($campaign->mails->where('openings', '>', 0) as $mail)
                                    <x-table.tr>
                                        <x-table.td>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-900 dark:text-white text-sm">{{ $mail->subscriber->name }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $mail->subscriber->email }}</span>
                                            </div>
                                        </x-table.td>
                                        <x-table.td>
                                            <div class="flex gap-2">
                                                <span class="inline-flex items-center rounded-md bg-indigo-50 dark:bg-indigo-900/30 px-2 py-1 text-xs font-medium text-indigo-700 dark:text-indigo-300 ring-1 ring-inset ring-indigo-700/10">Opened</span>
                                                @if($mail->clicks > 0)
                                                    <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-blue-700 dark:text-blue-300 ring-1 ring-inset ring-blue-700/10">Clicked</span>
                                                @else
                                                    <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-700 px-2 py-1 text-xs font-medium text-gray-500 dark:text-gray-400 ring-1 ring-inset ring-gray-700/10 opacity-50">Not Clicked</span>
                                                @endif
                                            </div>
                                        </x-table.td>
                                        <x-table.td class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $mail->sent_at ? $mail->sent_at->format('M d, H:i') : 'N/A' }}
                                        </x-table.td>
                                        <x-table.td class="text-right text-sm font-medium text-indigo-600 dark:text-indigo-400">
                                            {{ $mail->openings }}
                                        </x-table.td>
                                    </x-table.tr>
                                @empty
                                    <x-table.tr>
                                        <x-table.td colspan="4" class="text-center py-4 text-gray-500">{{ __('No opens tracked yet.') }}</x-table.td>
                                    </x-table.tr>
                                @endforelse
                            </x-table.tbody>
                        </x-table>
                    </div>
                </div>

                <!-- Tab Content: Clicked List -->
                <div x-show="activeTab === 'clicked'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('Subscriber') }}</x-table.th>
                                    <x-table.th>{{ __('Clicks') }}</x-table.th>
                                    <x-table.th class="text-right">{{ __('Delivered At') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                                @forelse($campaign->mails->where('clicks', '>', 0) as $mail)
                                    <x-table.tr>
                                        <x-table.td>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-900 dark:text-white text-sm">{{ $mail->subscriber->name }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $mail->subscriber->email }}</span>
                                            </div>
                                        </x-table.td>
                                        <x-table.td>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2.5 py-0.5 text-sm font-medium text-blue-700 dark:text-blue-300 ring-1 ring-inset ring-blue-700/10">
                                                    {{ $mail->clicks }} {{ str('click')->plural($mail->clicks) }}
                                                </span>
                                            </div>
                                        </x-table.td>
                                        <x-table.td class="text-right text-sm text-gray-500 dark:text-gray-400">
                                            {{ $mail->sent_at ? $mail->sent_at->format('M d, H:i') : 'N/A' }}
                                        </x-table.td>
                                    </x-table.tr>
                                @empty
                                    <x-table.tr>
                                        <x-table.td colspan="4" class="text-center py-4 text-gray-500">{{ __('No clicks tracked yet.') }}</x-table.td>
                                    </x-table.tr>
                                @endforelse
                            </x-table.tbody>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const isDarkMode = document.documentElement.classList.contains('dark');
            
            const textColor = isDarkMode ? '#9ca3af' : '#6b7280';
            const gridColor = isDarkMode ? 'rgba(75, 85, 99, 0.2)' : 'rgba(229, 231, 235, 0.5)';

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [
                        {
                            label: 'Opens',
                            data: {!! json_encode($chartData['opens']) !!},
                            borderColor: '#6366f1',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#6366f1',
                        },
                        {
                            label: 'Clicks',
                            data: {!! json_encode($chartData['clicks']) !!},
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#3b82f6',
                        }
                    ]
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
                                }
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
