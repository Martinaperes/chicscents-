@csrf

<!-- Message Card -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow ring-1 ring-gray-200 dark:ring-gray-700 p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Message</h3>
        <button type="button" id="help-toggle" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-200 hover:bg-blue-100 dark:hover:bg-blue-900/50">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10A8 8 0 11.001 10 8 8 0 0118 10zM9 7a1 1 0 112 0 1 1 0 01-2 0zm2 3a1 1 0 10-2 0v3a1 1 0 102 0v-3z" clip-rule="evenodd" /></svg>
            Help
        </button>
    </div>
    <div id="help-panel" class="hidden mb-6 rounded-lg border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 p-4 text-sm text-blue-800 dark:text-blue-200">
        <div class="font-semibold mb-2">How to use</div>
        <ul class="list-disc pl-5 space-y-1">
            <li>Type your main question or scenario in the Question field.</li>
            <li>Add multiple <strong>keywords</strong>; press Enter or comma to add a tag.</li>
            <li>Choose <strong>OR</strong> (any keyword) or <strong>AND</strong> (all keywords) matching.</li>
            <li>Use variables in the answer: <code class="px-1 rounded bg-blue-100 dark:bg-blue-800">@{{user.name}}</code>, <code class="px-1 rounded bg-blue-100 dark:bg-blue-800">@{{user.email}}</code>, <code class="px-1 rounded bg-blue-100 dark:bg-blue-800">@{{session.deal_count}}</code>.</li>
            <li>Add optional buttons for quick actions below.</li>
        </ul>
    </div>
    <div class="space-y-8">
    <!-- Question -->
    <div>
        <label for="question" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Question <span class="text-red-500">*</span>
        </label>
        <textarea name="question" id="question" 
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('question') border-red-500 ring-red-500 @enderror" 
                  rows="3" placeholder="Enter the question or scenario this bot response handles..." required>{{ old('question', $botQuestion->question ?? '') }}</textarea>
        @error('question')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">This question helps identify what scenario this response handles.</p>
    </div>

    <!-- Keywords with Tag Input -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Keywords <span class="text-red-500">*</span>
        </label>
        
        <!-- Hidden input for form submission -->
        <input type="hidden" name="keywords" id="keywords-hidden" 
               value="{{ old('keywords', isset($botQuestion) ? implode(', ', $botQuestion->keywords ?? []) : '') }}" required>
        
        <!-- Tag Input Container -->
        <div class="min-h-[60px] p-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 dark:focus-within:ring-blue-800 @error('keywords') border-red-500 @enderror">
            <div id="keywords-tags" class="flex flex-wrap gap-2 mb-2">
                @php
                    $keywords = old('keywords', isset($botQuestion) && $botQuestion->keywords ? $botQuestion->keywords : []);
                    if (is_string($keywords)) {
                        $keywords = array_filter(array_map('trim', explode(',', $keywords)));
                    }
                @endphp
                @foreach($keywords as $keyword)
                    @if(!empty($keyword))
                        <span class="keyword-tag inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ trim($keyword) }}
                            <button type="button" onclick="removeKeyword(this)" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </span>
                    @endif
                @endforeach
            </div>
            <input type="text" 
                   id="keywords-input" 
                   class="w-full bg-transparent border-none outline-none text-gray-900 dark:text-white placeholder-gray-400"
                   placeholder="Type a keyword and press Enter or comma to add..." 
                   autocomplete="off">
        </div>
        
        @error('keywords')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Add multiple keywords. Press Enter or comma to add each keyword.</p>
    </div>

    <!-- Logic Operator -->
    {{-- <div>
        <label for="logic_operator" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Logic Operator <span class="text-red-500">*</span>
        </label>
        <div class="grid grid-cols-2 gap-4">
            <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'OR' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-300 dark:border-gray-600' }}">
                <input type="radio" name="logic_operator" value="OR" 
                       {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'OR' ? 'checked' : '' }}
                       class="sr-only" required>
                <div class="flex-1">
                    <div class="font-medium text-gray-900 dark:text-gray-100">OR</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Any keyword matches</div>
                </div>
                <svg class="w-5 h-5 text-blue-500 {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'OR' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </label>
            <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'AND' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-300 dark:border-gray-600' }}">
                <input type="radio" name="logic_operator" value="AND" 
                       {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'AND' ? 'checked' : '' }}
                       class="sr-only" required>
                <div class="flex-1">
                    <div class="font-medium text-gray-900 dark:text-gray-100">AND</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">All keywords must match</div>
                </div>
                <svg class="w-5 h-5 text-blue-500 {{ old('logic_operator', $botQuestion->logic_operator ?? 'OR') === 'AND' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </label>
        </div>
        @error('logic_operator')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div> --}}

    <!-- Answer -->
    <div>
        <label for="answer" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Answer <span class="text-red-500">*</span>
        </label>
        <textarea name="answer" id="answer" 
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('answer') border-red-500 ring-red-500 @enderror" 
                  rows="6" placeholder="Enter the bot's response message..." required>{{ old('answer', $botQuestion->answer ?? '') }}</textarea>
        @error('answer')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
            <p class="text-xs font-medium text-blue-800 dark:text-blue-300 mb-1">Variable Support:</p>
            <p class="text-xs text-blue-700 dark:text-blue-400">Use @{{user.name}}, @{{user.email}}, @{{session.deal_count}} for dynamic content.</p>
    </div>
    </div>

    <!-- Buttons Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow ring-1 ring-gray-200 dark:ring-gray-700 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Buttons</h3>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Buttons</label>
        <div id="buttons-container" class="space-y-4">
            @php
                $buttons = old('buttons', isset($botQuestion) && $botQuestion->buttons ? $botQuestion->buttons : []);
                if (empty($buttons)) {
                    $buttons = [['label' => '', 'url' => '', 'style' => 'primary', 'target' => '_self']];
                }
            @endphp
            @foreach($buttons as $index => $button)
                <div class="button-row p-5 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900/50" data-index="{{ $index }}">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Button {{ $index + 1 }}</span>
                        @if($index > 0 || !empty($button['label']) || !empty($button['url']))
                            <button type="button" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium remove-button" onclick="removeButton(this)">
                                Remove
                            </button>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Label</label>
                            <input type="text" name="buttons[{{ $index }}][label]" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Button Text" value="{{ $button['label'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">URL</label>
                            <input type="url" name="buttons[{{ $index }}][url]" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" 
                                   placeholder="https://example.com" value="{{ $button['url'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Style</label>
                            <select name="buttons[{{ $index }}][style]" 
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <option value="primary" {{ ($button['style'] ?? 'primary') === 'primary' ? 'selected' : '' }}>Primary</option>
                                <option value="secondary" {{ ($button['style'] ?? 'primary') === 'secondary' ? 'selected' : '' }}>Secondary</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Open In</label>
                            <select name="buttons[{{ $index }}][target]" 
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <option value="_self" {{ ($button['target'] ?? '_self') === '_self' ? 'selected' : '' }}>Same Tab</option>
                                <option value="_blank" {{ ($button['target'] ?? '_self') === '_blank' ? 'selected' : '' }}>New Tab</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="mt-3 flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium" onclick="addButton()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Button
        </button>
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Add interactive buttons to bot responses. URLs support variables.</p>
    </div>

    <!-- Conditions Card -->
    {{-- <div class="bg-white dark:bg-gray-800 rounded-xl shadow ring-1 ring-gray-200 dark:ring-gray-700 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Conditions</h3>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Conditions</label>
        <div id="conditions-container" class="space-y-3">
            @php
                $conditions = old('conditions', []);
                if (empty($conditions) && isset($botQuestion) && $botQuestion->conditions) {
                    foreach ($botQuestion->conditions as $key => $condition) {
                        foreach ($condition as $operator => $value) {
                            $conditions[] = ['key' => $key, 'operator' => $operator, 'value' => $value];
                        }
                    }
                }
                if (empty($conditions)) {
                    $conditions = [];
                }
            @endphp
            @foreach($conditions as $index => $condition)
                <div class="condition-row p-4 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900/50" data-index="{{ $index }}">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Condition {{ $index + 1 }}</span>
                        <button type="button" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium" onclick="removeCondition(this)">
                            Remove
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-5">
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Variable Key</label>
                            <input type="text" name="conditions[{{ $index }}][key]" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" 
                                   placeholder="session.deal_count" value="{{ $condition['key'] ?? '' }}">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Operator</label>
                            <select name="conditions[{{ $index }}][operator]" 
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <option value="==" {{ ($condition['operator'] ?? '==') === '==' ? 'selected' : '' }}>==</option>
                                <option value="!=" {{ ($condition['operator'] ?? '==') === '!=' ? 'selected' : '' }}>!=</option>
                                <option value=">" {{ ($condition['operator'] ?? '==') === '>' ? 'selected' : '' }}>></option>
                                <option value=">=" {{ ($condition['operator'] ?? '==') === '>=' ? 'selected' : '' }}>>=</option>
                                <option value="<" {{ ($condition['operator'] ?? '==') === '<' ? 'selected' : '' }}><</option>
                                <option value="<=" {{ ($condition['operator'] ?? '==') === '<=' ? 'selected' : '' }}><=</option>
                            </select>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Value</label>
                            <input type="text" name="conditions[{{ $index }}][value]" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Value" value="{{ $condition['value'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if(empty($conditions))
            <div class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                No conditions set. Messages will match based on keywords only.
            </div>
        @endif
        <button type="button" class="mt-3 flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium" onclick="addCondition()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Condition
        </button>
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Set conditions based on session/user data. Leave empty if no conditions needed.</p>
    </div> --}}

    <!-- Settings Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow ring-1 ring-gray-200 dark:ring-gray-700 p-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Settings</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Priority</label>
            <input type="number" name="priority" id="priority" 
                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('priority') border-red-500 ring-red-500 @enderror" 
                   value="{{ old('priority', $botQuestion->priority ?? 0) }}" min="0" required>
            @error('priority')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Higher priority questions are matched first. Default: 0</p>
        </div>

        <!-- Active -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <label class="flex items-center p-4 border-2 border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <input type="checkbox" name="is_active" id="is_active" 
                       class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" 
                       value="1" {{ old('is_active', isset($botQuestion) ? $botQuestion->is_active : true) ? 'checked' : '' }}>
                <div class="ml-3">
                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Active</span>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Only active questions are matched</p>
                </div>
            </label>
        </div>
    </div>
    </div>
</div>

<script>
// Keyword Tag Management
const keywordsInput = document.getElementById('keywords-input');
const keywordsHidden = document.getElementById('keywords-hidden');
const keywordsTags = document.getElementById('keywords-tags');

function updateKeywordsHidden() {
    const tags = Array.from(keywordsTags.querySelectorAll('.keyword-tag')).map(tag => {
        const text = tag.cloneNode(true);
        text.querySelector('button')?.remove();
        return text.textContent.trim();
    }).filter(t => t !== '');
    keywordsHidden.value = tags.join(', ');
}

function addKeyword(value) {
    value = value.trim();
    if (!value || value === '') return;
    
    // Check if keyword already exists
    const existing = Array.from(keywordsTags.querySelectorAll('.keyword-tag')).some(tag => {
        const text = tag.cloneNode(true);
        text.querySelector('button')?.remove();
        return text.textContent.trim() === value;
    });
    if (existing) return;
    
    const tag = document.createElement('span');
    tag.className = 'keyword-tag inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
    tag.innerHTML = `
        ${value}
        <button type="button" onclick="removeKeyword(this)" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    `;
    keywordsTags.appendChild(tag);
    keywordsInput.value = '';
    updateKeywordsHidden();
}

function removeKeyword(btn) {
    btn.closest('.keyword-tag').remove();
    updateKeywordsHidden();
}

keywordsInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        const value = this.value.trim();
        if (value) {
            addKeyword(value);
        }
    }
});

// Initialize from existing keywords
document.addEventListener('DOMContentLoaded', function() {
    // Help toggle
    const helpToggle = document.getElementById('help-toggle');
    const helpPanel = document.getElementById('help-panel');
    if (helpToggle && helpPanel) {
        helpToggle.addEventListener('click', function() {
            helpPanel.classList.toggle('hidden');
        });
    }
    const existing = keywordsHidden.value;
    if (existing) {
        existing.split(',').forEach(keyword => {
            const trimmed = keyword.trim();
            if (trimmed) addKeyword(trimmed);
        });
    }
    
    // Validate keywords before form submission
    const form = document.getElementById('bot-question-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            updateKeywordsHidden();
            const keywords = keywordsHidden.value.trim();
            if (!keywords || keywords === '') {
                e.preventDefault();
                alert('Please add at least one keyword.');
                keywordsInput.focus();
                return false;
            }
        });
    }
});

// Logic Operator Radio Styling
document.querySelectorAll('input[name="logic_operator"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('input[name="logic_operator"]').forEach(r => {
            const label = r.closest('label');
            const svg = label.querySelector('svg');
            if (r.checked) {
                label.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
                label.classList.remove('border-gray-300', 'dark:border-gray-600');
                if (svg) svg.classList.remove('hidden');
            } else {
                label.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
                label.classList.add('border-gray-300', 'dark:border-gray-600');
                if (svg) svg.classList.add('hidden');
            }
        });
    });
});

// Button Management
function addButton() {
    const container = document.getElementById('buttons-container');
    const index = container.children.length;
    const html = `
        <div class="button-row p-5 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900/50" data-index="${index}">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Button ${index + 1}</span>
                <button type="button" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium remove-button" onclick="removeButton(this)">
                    Remove
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Label</label>
                    <input type="text" name="buttons[${index}][label]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" placeholder="Button Text">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">URL</label>
                    <input type="url" name="buttons[${index}][url]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" placeholder="https://example.com">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Style</label>
                    <select name="buttons[${index}][style]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="primary">Primary</option>
                        <option value="secondary">Secondary</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Open In</label>
                    <select name="buttons[${index}][target]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="_self">Same Tab</option>
                        <option value="_blank">New Tab</option>
                    </select>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}

function removeButton(btn) {
    btn.closest('.button-row').remove();
    const container = document.getElementById('buttons-container');
    Array.from(container.children).forEach((row, index) => {
        row.querySelector('.text-sm').textContent = `Button ${index + 1}`;
        row.querySelectorAll('input, select').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
        });
    });
}

// Condition Management
function addCondition() {
    const container = document.getElementById('conditions-container');
    const index = container.children.length;
    const html = `
        <div class="condition-row p-4 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900/50" data-index="${index}">
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Condition ${index + 1}</span>
                <button type="button" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium" onclick="removeCondition(this)">
                    Remove
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-5">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Variable Key</label>
                    <input type="text" name="conditions[${index}][key]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" placeholder="session.deal_count">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Operator</label>
                    <select name="conditions[${index}][operator]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="==">==</option>
                        <option value="!=">!=</option>
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="<"><</option>
                        <option value="<="><=</option>
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Value</label>
                    <input type="text" name="conditions[${index}][value]" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500" placeholder="Value">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}

function removeCondition(btn) {
    btn.closest('.condition-row').remove();
    const container = document.getElementById('conditions-container');
    Array.from(container.children).forEach((row, index) => {
        row.querySelector('.text-sm').textContent = `Condition ${index + 1}`;
        row.querySelectorAll('input, select').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
        });
    });
}
</script>
</script>