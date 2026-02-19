<x-admin-layout>
    <x-slot name="header">
        Bot Question Details
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('bot-questions.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">← Back to List</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $botQuestion->question }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keywords</label>
                <p class="text-gray-900 dark:text-gray-100">{{ implode(', ', $botQuestion->keywords ?? []) }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logic Operator</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $botQuestion->logic_operator }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priority</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $botQuestion->priority }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $botQuestion->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' }}">
                    {{ $botQuestion->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Answer</label>
                <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $botQuestion->answer }}</p>
            </div>

            @if($botQuestion->buttons)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Buttons</label>
                <div class="space-y-2">
                    @foreach($botQuestion->buttons as $button)
                        <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded">
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $button['label'] }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $button['url'] }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                Style: {{ $button['style'] ?? 'primary' }} | 
                                Target: {{ $button['target'] ?? '_self' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($botQuestion->conditions)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Conditions</label>
                <pre class="bg-gray-50 dark:bg-gray-900 p-4 rounded text-sm text-gray-900 dark:text-gray-100 overflow-x-auto">{{ json_encode($botQuestion->conditions, JSON_PRETTY_PRINT) }}</pre>
            </div>
            @endif

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Created</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $botQuestion->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('bot-questions.edit', $botQuestion) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">Edit</a>
            <a href="{{ route('bot-questions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">Back to List</a>
        </div>
    </div>
</x-admin-layout>