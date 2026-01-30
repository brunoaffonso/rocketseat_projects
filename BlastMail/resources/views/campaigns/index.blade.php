<x-layouts.app>
    <x-slot name="header">
        <x-h2 class="mb-0">
            {{ __('Campaigns') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card class="p-0 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                    
                    <x-link-button href="{{ route('campaigns.create') }}">
                        {{ __('Create Campaign') }}
                    </x-link-button>

                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <form x-data="{ 
                                search: '{{ request('search') }}',
                                trashed: {{ request('trashed') ? 'true' : 'false' }},
                                submit() {
                                    $el.submit();
                                }
                            }" action="{{ route('campaigns.index') }}" method="GET" class="flex items-center gap-2 w-full">
                            
                            <label class="inline-flex items-center whitespace-nowrap">
                                <input type="checkbox" name="trashed" value="1" x-model="trashed" @change="submit" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show Deleted') }}</span>
                            </label>

                            <div class="relative w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input name="search" x-model="search" x-on:input.debounce.500ms="submit"
                                    placeholder="{{ __('Search campaigns...') }}" class="w-full pl-10" />
                            </div>
                        </form>
                    </div>
                </div>

                @if (session('status'))
                    <div class="p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 border-b border-green-200 dark:border-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                <x-table class="table-fixed w-full">
                    <x-table.thead>
                        <x-table.tr>
                            <x-table.th class="w-[5%]">#</x-table.th>
                            <x-table.th class="w-[20%]">{{ __('Name') }}</x-table.th>
                            <x-table.th class="w-[25%]">{{ __('Subject') }}</x-table.th>
                            <x-table.th class="w-[20%] whitespace-nowrap">{{ __('Scheduled For') }}</x-table.th>
                            <x-table.th class="w-[10%] whitespace-nowrap">{{ __('Status') }}</x-table.th>
                            <x-table.th class="w-[10%] whitespace-nowrap">{{ __('Performance') }}</x-table.th>
                            <x-table.th class="w-[20%] text-right whitespace-nowrap">{{ __('Actions') }}</x-table.th>
                        </x-table.tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse ($campaigns as $campaign)
                            <x-table.tr class="{{ $campaign->trashed() ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                                <x-table.td class="whitespace-nowrap align-top font-medium text-gray-900 dark:text-gray-100">
                                    {{ $campaign->id }}
                                </x-table.td>
                                <x-table.td class="!whitespace-normal !break-words align-top">
                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $campaign->name }}</div>
                                    @if($campaign->trashed())
                                        <span class="text-xs text-red-600 dark:text-red-400">{{ __('Deleted') }}</span>
                                    @endif
                                </x-table.td>
                                <x-table.td class="!whitespace-normal !break-words align-top text-gray-500 dark:text-gray-400">{{ $campaign->subject }}</x-table.td>
                                <x-table.td class="whitespace-nowrap align-top text-gray-500 dark:text-gray-400">
                                    {{ $campaign->send_at ? $campaign->send_at->format('M d, Y H:i') : 'Not scheduled' }}
                                </x-table.td>
                                <x-table.td class="whitespace-nowrap align-top">
                                    @if($campaign->trashed())
                                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Deleted</span>
                                    @elseif($campaign->send_at && $campaign->send_at->isPast())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Sent</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Scheduled</span>
                                    @endif
                                </x-table.td>
                                <x-table.td class="whitespace-nowrap align-top">
                                    <div class="flex flex-col text-xs space-y-1">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-medium whitespace-nowrap">
                                            Opens: {{ $campaign->statistics['open_rate'] }}%
                                        </span>
                                        <span class="text-blue-600 dark:text-blue-400 font-medium whitespace-nowrap">
                                            Clicks: {{ $campaign->statistics['click_rate'] }}%
                                        </span>
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-right whitespace-nowrap align-top">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('campaigns.show', $campaign) }}">
                                             <x-secondary-button type="button">
                                                {{ __('View') }}
                                            </x-secondary-button>
                                        </a>

                                        @if(!$campaign->trashed())
                                            <x-form :delete="route('campaigns.destroy', $campaign)" class="m-0">
                                                <x-danger-button type="submit" onclick="return confirm('{{ __('Are you sure you want to delete this campaign?') }}')">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </x-form>
                                        @else
                                             <!-- Restore functionality could be added here later -->
                                             <span class="text-gray-400 cursor-not-allowed">{{ __('Deleted') }}</span>
                                        @endif
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="5" class="text-center py-8 text-gray-500">
                                    {{ __('No campaigns found.') }}
                                </x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table>
            </x-card>

            <div class="mt-4">
                {{ $campaigns->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
