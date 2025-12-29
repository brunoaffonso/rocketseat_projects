<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-h2 class="mb-0">
                {{ __('My Lists') }}
            </x-h2>
            <x-link-button href="{{ route('email-list.create') }}">
                {{ __('Create Email List') }}
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-card class="p-0 overflow-hidden">
            <x-table>
                <x-table.thead>
                    <x-table.tr>
                        <x-table.th>{{ __('Title') }}</x-table.th>
                        <x-table.th>{{ __('Subscribers') }}</x-table.th>
                        <x-table.th>{{ __('Created At') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Actions') }}</x-table.th>
                    </x-table.tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($emailLists as $emailList)
                        <x-table.tr>
                            <x-table.td>{{ $emailList->title }}</x-table.td>
                            <x-table.td>{{ $emailList->subscribers_count }}</x-table.td>
                            <x-table.td>{{ $emailList->created_at->format('d/m/Y H:i') }}</x-table.td>
                            <x-table.td class="text-right">
                                <!-- Actions like Edit/Delete can be added here -->
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="4" class="text-center py-8 text-gray-500">
                                {{ __('No email lists found.') }}
                            </x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </x-card>

        <div class="mt-4">
            {{ $emailLists->links() }}
        </div>
        </div>
    </div>
</x-layouts.app>
