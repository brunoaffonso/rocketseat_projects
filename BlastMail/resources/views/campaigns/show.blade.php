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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Campaign Setup Details -->
            <x-card>
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
            </x-card>

            <!-- Email Body Preview -->
             <x-card>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Email Content Preview') }}</h3>
                <div class="prose dark:prose-invert max-w-none border rounded-md p-4 bg-gray-50 dark:bg-gray-900">
                    {!! $campaign->body !!}
                </div>
            </x-card>

            <!-- Tracking Placeholder -->
            <x-card>
                 <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Tracking Data') }}</h3>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">Coming Soon</span>
                </div>
                
                <div class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Tracking Analytics</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Detailed open and click statistics will be displayed here once the campaign is sent.</p>
                </div>
            </x-card>

        </div>
    </div>
</x-layouts.app>
