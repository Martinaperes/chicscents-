<div id="lc-floating-chat-root" style="all: initial;">
    <style>
        #lc-floating-chat {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .lc-fc-button {
            width: 56px; height: 56px; border-radius: 50%;
            background: linear-gradient(135deg, #c5a059 0%, #764ba2 100%);
            border: none; color: #fff; cursor: pointer;
            box-shadow: 0 10px 25px rgba(102,126,234,.35);
            display: flex; align-items: center; justify-content: center;
        }
        .lc-fc-button:hover { filter: brightness(1.05); }
        .lc-fc-panel {
            position: absolute; right: 0; bottom: 70px; width: 320px; 
            max-height: calc(100vh - 100px);
            background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; 
            box-shadow: 0 20px 40px rgba(0,0,0,.12);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }
        .lc-fc-header {
            padding: 12px; background: linear-gradient(135deg, #c5a059 0%, #764ba2 100%); color: #fff;
            font-weight: 600; font-size: 14px;
            flex-shrink: 0;
        }
        .lc-fc-body { 
            background: #f9fafb; 
            height: 300px; /* Default height */
            max-height: 40vh; /* Responsive max height */
            overflow-y: auto; 
            padding: 10px;
            flex-grow: 1;
        }
        .lc-fc-footer { 
            padding: 12px; border-top: 1px solid #eee; background: #fff; 
            flex-shrink: 0;
        }
        .lc-fc-input { width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; box-sizing: border-box; }
        .lc-fc-send { margin-top: 8px; width: 100%; padding: 10px 12px; border: none; border-radius: 8px; background: #c5a059; color: #fff; cursor: pointer; font-weight: 500; }
        .lc-fc-msg { display: flex; margin-bottom: 8px; }
        .lc-fc-msg .bubble { max-width: 78%; padding: 8px 10px; border-radius: 14px; font-size: 13px; line-height: 1.4; }
        .lc-fc-msg.user { justify-content: flex-end; }
        .lc-fc-msg.user .bubble { background: #c5a059; color: #fff; border-bottom-right-radius: 4px; }
        .lc-fc-msg.bot .bubble { background: #fff; border: 1px solid #e5e7eb; border-bottom-left-radius: 4px; }
        .lc-fc-buttons { display: flex; flex-direction: column; gap: 8px; margin-top: 6px; }
        .lc-fc-buttons a { text-decoration: none; text-align: center; padding: 10px 12px; border-radius: 8px; font-weight: 500; border: 1px solid #c5a059; color: #c5a059; background: #fff; }
        .lc-fc-buttons a.btn-primary { background: #c5a059; color: #fff; border-color: #c5a059; }
    </style>

    <div id="lc-floating-chat">
        <div class="lc-fc-panel" id="lcFcPanel">
            <div class="lc-fc-header">ChatBot</div>
            <div class="lc-fc-body" id="lcFcBody">
                <div class="lc-fc-msg bot"><div class="bubble">{{ config('laravel-chatbot.welcome_message', 'Hello! How can I help you today?') }}</div></div>
            </div>
            <div class="lc-fc-footer">
                <input id="lcFcInput" class="lc-fc-input" type="text" placeholder="Type a message...">
                <button id="lcFcSend" class="lc-fc-send">Send</button>
            </div>
        </div>
        <button type="button" class="lc-fc-button" id="lcFcToggle" aria-label="Open chat" title="Chat">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V5a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
        </button>
    </div>

    <script>
        (function(){
            const panel = document.getElementById('lcFcPanel');
            const toggle = document.getElementById('lcFcToggle');
            const body = document.getElementById('lcFcBody');
            const input = document.getElementById('lcFcInput');
            const send = document.getElementById('lcFcSend');

            function appendMessage(text, type, buttons = []) {
                const row = document.createElement('div');
                row.className = 'lc-fc-msg ' + type;
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.textContent = text;
                row.appendChild(bubble);
                body.appendChild(row);

                if (type === 'bot' && buttons.length) {
                    const btns = document.createElement('div');
                    btns.className = 'lc-fc-buttons';
                    buttons.forEach(b => {
                        const a = document.createElement('a');
                        a.textContent = b.label;
                        a.href = b.url; a.target = b.target || '_self';
                        a.className = b.style === 'secondary' ? '' : 'btn-primary';
                        if (b.target === '_blank') a.rel = 'noopener noreferrer';
                        btns.appendChild(a);
                    });
                    body.appendChild(btns);
                }

                body.scrollTop = body.scrollHeight;
            }

            toggle.addEventListener('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                const open = panel.style.display === 'flex';
                panel.style.display = open ? 'none' : 'flex';
                if (!open) input.focus();
            });

            function sendMessage(){
                const text = input.value.trim();
                if (!text) return;
                appendMessage(text, 'user');
                input.value = '';
                fetch('{{ route('botman.web-chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ message: text })
                })
                .then(r => r.json())
                .then(data => {
                    appendMessage(data.text || '...', 'bot', data.buttons || []);
                })
                .catch(() => appendMessage('Sorry, something went wrong.', 'bot'));
            }

            send.addEventListener('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                sendMessage();
            });
            input.addEventListener('keydown', function(e){
                if (e.key === 'Enter') {
                    e.preventDefault();
                    e.stopPropagation();
                    sendMessage();
                }
            });
        })();
    </script>
</div>


