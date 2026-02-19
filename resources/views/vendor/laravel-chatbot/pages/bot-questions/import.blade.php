<x-admin-layout>
    <x-slot name="header">
        Import Bot Questions
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
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Import Questions from JSON</h2>
            <p class="text-gray-600 dark:text-gray-400">Import multiple bot questions at once using a JSON file or by pasting JSON content.</p>
        </div>

        @if(session('import_errors'))
            <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                <h3 class="text-sm font-semibold text-yellow-800 dark:text-yellow-200 mb-2">Import Errors:</h3>
                <ul class="list-disc list-inside text-sm text-yellow-700 dark:text-yellow-300 space-y-1">
                    @foreach(session('import_errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bot-questions.import.process') }}" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf

            <!-- Import Type Selection -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                    Import Type <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="import_type" value="file" class="mr-2 text-blue-600 focus:ring-blue-500" 
                               onchange="toggleImportType('file')" checked>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Upload JSON File</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="import_type" value="paste" class="mr-2 text-blue-600 focus:ring-blue-500" 
                               onchange="toggleImportType('paste')">
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Paste JSON Content</span>
                    </label>
                </div>
            </div>

            <!-- File Upload Section -->
            <div id="file-upload-section" class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    JSON File <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-blue-500 dark:hover:border-blue-400 transition">
                    <input type="file" name="json_file" id="json_file" 
                           accept=".json,.txt" 
                           class="hidden" 
                           onchange="handleFileSelect(this)">
                    <label for="json_file" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            <span class="font-semibold text-blue-600 dark:text-blue-400">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500">JSON or TXT file (MAX. 10MB)</p>
                    </label>
                    <p id="file-name" class="mt-2 text-sm text-gray-700 dark:text-gray-300 font-medium hidden"></p>
                </div>
                @if(isset($errors) && $errors->has('json_file'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('json_file') }}</p>
                @endif
            </div>

            <!-- Paste JSON Section -->
            <div id="paste-json-section" class="mb-6 hidden">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    JSON Content <span class="text-red-500">*</span>
                </label>
                <textarea name="json_content" id="json_content" rows="15" 
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white font-mono text-sm p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder='Paste your JSON array here...&#10;&#10;Example:&#10;[&#10;  {&#10;    "question": "What is your name?",&#10;    "keywords": ["name", "who"],&#10;    "logic_operator": "OR",&#10;    "answer": "My name is Bot.",&#10;    "priority": 0,&#10;    "is_active": true&#10;  }&#10;]'></textarea>
                @if(isset($errors) && $errors->has('json_content'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('json_content') }}</p>
                @endif
            </div>

            <!-- JSON Structure Guide -->
            <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        JSON Structure Guide
                    </h3>
                    <button type="button" onclick="copyJsonExample()" 
                            class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded transition">
                        Copy Example
                    </button>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm text-blue-800 dark:text-blue-200 mb-3">
                        The JSON must be an <strong>array of question objects</strong>. Each object should contain:
                    </p>
                    <pre class="bg-gray-900 dark:bg-gray-950 text-gray-100 p-4 rounded-lg overflow-x-auto text-xs"><code>[
  {
    "question": "What is your return policy?",
    "keywords": ["return", "refund", "policy"],
    "logic_operator": "OR",
    "answer": "We offer a 30-day return policy. You can return items...",
    "priority": 10,
    "is_active": true,
    "buttons": [
      {
        "label": "Learn More",
        "url": "https://example.com/returns",
        "style": "primary",
        "target": "_blank"
      }
    ],
    "conditions": {
      "user.role": {
        "==": "premium"
      }
    }
  }
]</code></pre>
                </div>

                <div class="border-t border-blue-200 dark:border-blue-700 pt-4">
                    <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-100 mb-2">Field Descriptions:</h4>
                    <ul class="text-xs text-blue-800 dark:text-blue-200 space-y-1 list-disc list-inside">
                        <li><strong>question</strong> (required): The question text</li>
                        <li><strong>keywords</strong> (required): Array of keywords for matching (e.g., ["hello", "hi"])</li>
                        <li><strong>logic_operator</strong> (optional): "AND" or "OR" (default: "OR")</li>
                        <li><strong>answer</strong> (required): The bot's response text</li>
                        <li><strong>priority</strong> (optional): Integer, higher = more priority (default: 0)</li>
                        <li><strong>is_active</strong> (optional): true/false (default: true)</li>
                        <li><strong>buttons</strong> (optional): Array of button objects with label, url, style, target</li>
                        <li><strong>conditions</strong> (optional): Object with dot-notation keys and operator/value pairs</li>
                    </ul>
                </div>
            </div>

            <!-- AI Prompt Section -->
            <div class="mb-6 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-900 dark:text-purple-100 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    AI Prompt for Generating JSON
                </h3>
                <div class="bg-white dark:bg-gray-800 rounded p-4 mb-3">
                    <p class="text-sm text-purple-800 dark:text-purple-200 mb-2">
                        Use this prompt with AI tools (ChatGPT, Claude, etc.) to generate the JSON format:
                    </p>
                    <div class="bg-gray-100 dark:bg-gray-900 rounded p-3 font-mono text-xs text-gray-800 dark:text-gray-200" id="ai-prompt">
Generate a JSON array for a Laravel chatbot Q&A system. Each object must have:
- "question" (string, required): The question text
- "keywords" (array of strings, required): Keywords for matching user messages
- "logic_operator" (string, optional): "AND" or "OR" (default "OR")
- "answer" (string, required): The bot's response text
- "priority" (integer, optional): Higher numbers = higher priority (default 0)
- "is_active" (boolean, optional): Whether the question is active (default true)
- "buttons" (array, optional): Array of objects with "label" (string), "url" (string), "style" ("primary" or "secondary"), "target" ("_blank" or "_self")
- "conditions" (object, optional): Object where keys are dot-notation paths (e.g., "user.role") and values are objects with operators ("==", "!=", ">", ">=", "<", "<=") and their values

CRITICAL KEYWORD GUIDELINES:
1. Keywords should be words or short phrases that users are likely to type when asking about this topic
2. Use lowercase, common variations, and synonyms (e.g., ["arduino", "programming", "language"] not ["Arduino", "programming language", "code"] if "code" isn't essential)
3. Choose "OR" logic (default) for most cases - matches if ANY keyword is found. Use "AND" only when ALL keywords must be present (be careful - if one keyword is missing, the question won't match)
4. Avoid including keywords that aren't essential to the question. For example, if asking "Which programming language is used for Arduino?", don't include "code" unless users commonly type it
5. Include 3-5 relevant keywords per question. More keywords = better matching, but only include words users will actually type
6. Use specific terms from the question (e.g., "programming language", "arduino", "c++") rather than generic words
7. Consider common misspellings or alternative phrasings users might use

IMPORTANT - AVOID OVERLY BROAD KEYWORDS:
- DO NOT use single common words that appear in many queries (e.g., "arduino", "laravel" alone) unless the question is specifically about that single topic
- For comparison questions (e.g., "difference between X and Y"), you MUST use "AND" logic with individual words, NOT phrases
- Example: For "What is the difference between Arduino and Laravel?", use: {"keywords": ["difference", "arduino", "laravel"], "logic_operator": "AND"}
- DO NOT use phrases like "compare laravel codeigniter" or "arduino vs laravel" in AND logic - use individual words instead
- When using AND logic, each keyword should be a single word or very short phrase (2 words max)
- Questions about a single topic should have specific keywords that won't match unrelated queries

EXAMPLES:
Good: {"keywords": ["arduino", "programming", "language"], "logic_operator": "OR"} - matches "What language does Arduino use?"
Good: {"keywords": ["difference", "arduino", "laravel"], "logic_operator": "AND"} - matches "difference between arduino and laravel" but NOT "install laravel"
Good: {"keywords": ["difference", "laravel", "codeigniter"], "logic_operator": "AND"} - matches comparison questions about Laravel and CodeIgniter
Bad: {"keywords": ["arduino", "laravel"], "logic_operator": "OR"} - matches EVERYTHING mentioning either word, causing wrong answers
Bad: {"keywords": ["difference", "laravel", "codeigniter", "compare laravel codeigniter"], "logic_operator": "AND"} - phrase "compare laravel codeigniter" won't match, causing failure
Bad: {"keywords": ["arduino", "programming language", "code", "language"], "logic_operator": "AND"} - won't match if user doesn't type "code"

Generate [NUMBER] questions about [TOPIC]. For each question, carefully select 3-5 keywords that users are most likely to type. For comparison questions, use "AND" logic or include comparison terms. Avoid single-word keywords that are too common. Return only valid JSON, no markdown formatting.
                    </div>
                    <button type="button" onclick="copyAIPrompt()" 
                            class="mt-2 text-sm bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded transition">
                        Copy AI Prompt
                    </button>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('bot-questions.index') }}" 
                   class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition font-medium">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium shadow-md hover:shadow-lg">
                    Import Questions
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleImportType(type) {
            const fileSection = document.getElementById('file-upload-section');
            const pasteSection = document.getElementById('paste-json-section');
            const fileInput = document.getElementById('json_file');
            const jsonContent = document.getElementById('json_content');

            if (type === 'file') {
                fileSection.classList.remove('hidden');
                pasteSection.classList.add('hidden');
                jsonContent.removeAttribute('required');
                fileInput.setAttribute('required', 'required');
            } else {
                fileSection.classList.add('hidden');
                pasteSection.classList.remove('hidden');
                fileInput.removeAttribute('required');
                jsonContent.setAttribute('required', 'required');
            }
        }

        function handleFileSelect(input) {
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileName.textContent = 'Selected: ' + input.files[0].name;
                fileName.classList.remove('hidden');
            } else {
                fileName.classList.add('hidden');
            }
        }

        function copyJsonExample() {
            const example = `[
  {
    "question": "What is your return policy?",
    "keywords": ["return", "refund", "policy"],
    "logic_operator": "OR",
    "answer": "We offer a 30-day return policy. You can return items in original condition within 30 days of purchase.",
    "priority": 10,
    "is_active": true,
    "buttons": [
      {
        "label": "Learn More",
        "url": "https://example.com/returns",
        "style": "primary",
        "target": "_blank"
      }
    ]
  },
  {
    "question": "How do I contact support?",
    "keywords": ["contact", "support", "help", "customer service"],
    "logic_operator": "OR",
    "answer": "You can contact our support team via email at support@example.com or call us at 1-800-123-4567.",
    "priority": 5,
    "is_active": true
  }
]`;
            navigator.clipboard.writeText(example).then(() => {
                alert('JSON example copied to clipboard!');
            });
        }

        function copyAIPrompt() {
            const prompt = document.getElementById('ai-prompt').textContent;
            navigator.clipboard.writeText(prompt).then(() => {
                alert('AI prompt copied to clipboard!');
            });
        }
    </script>
</x-admin-layout>

