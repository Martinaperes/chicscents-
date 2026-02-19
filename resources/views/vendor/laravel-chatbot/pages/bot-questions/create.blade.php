<x-admin-layout>
    <x-slot name="header">
        Create Bot Question
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('bot-questions.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-8">
        <form action="{{ route('bot-questions.store') }}" method="POST" id="bot-question-form">
            @include('laravel-chatbot::pages.bot-questions._form')
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('bot-questions.index') }}" class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition font-medium">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium shadow-md hover:shadow-lg">
                    Create Question
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>