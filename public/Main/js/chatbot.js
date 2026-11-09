const FanHelperBot = {
  // These now start empty and get filled in from chatbot-data.json
  faqData: {},
  keywordRules: [],
  fallbackAnswer: "I’m a simple Fan Helper, so I can only answer questions about this website and its main features.",

  // Path to the JSON data file, resolved relative to this script's own location
  // so it keeps working no matter which folder/domain the app is deployed under.
  dataUrl: (() => {
    const thisScript = document.currentScript;
    if (thisScript && thisScript.src) {
      return new URL("chatbot-data.json", thisScript.src).href;
    }
    return "chatbot-data.json";
  })(),

  async init() {
    await this.loadData();
    this.createWidgetHTML();
    this.bindEvents();
  },

  async loadData() {
    try {
      const response = await fetch(this.dataUrl, { cache: "no-cache" });
      if (!response.ok) {
        throw new Error(`Failed to load chatbot data: HTTP ${response.status}`);
      }
      const data = await response.json();

      this.faqData = data.faqData || {};
      this.keywordRules = data.keywordRules || [];
      if (data.fallbackAnswer) {
        this.fallbackAnswer = data.fallbackAnswer;
      }
    } catch (err) {
      console.error("FanHelperBot: could not load chatbot-data.json", err);
      // Keep faqData/keywordRules empty; the bot will still open and
      // simply fall back to fallbackAnswer for every question.
    }
  },

  createWidgetHTML() {
    const wrapper = document.createElement("div");
    wrapper.id = "fanhubHelperWidget";
    wrapper.innerHTML = `
      <!-- Floating Trigger Button -->
      <button id="chatbotToggleBtn" class="chatbot-toggle-btn" aria-label="Open Fan Helper Chat">
        <i class="bi bi-chat-dots-fill fs-5"></i>
        <span>Ask Here</span>
      </button>

      <!-- Chat Window Panel -->
      <div id="chatbotContainer" class="chatbot-container" role="dialog" aria-labelledby="chatbotTitle">
        <!-- Header -->
        <div class="chatbot-header">
          <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light rounded-circle p-1" style="width: 10px; height: 10px;"></span>
            <div>
              <div id="chatbotTitle" class="fw-bold text-white fs-6">Fan Helper</div>
              <div class="text-white-50" style="font-size: 0.72rem;">Website FAQ Assistant</div>
            </div>
          </div>
          <button id="chatbotCloseBtn" class="btn btn-sm btn-link text-white p-0" aria-label="Close Chat">
            <i class="bi bi-x-lg fs-5"></i>
          </button>
        </div>

        <!-- Messages Body -->
        <div id="chatbotBody" class="chatbot-body">
          <!-- Initial Bot Greeting -->
          <div class="chat-bubble bot">
            <div>Hi! I’m Fan Helper. What would you like to explore?</div>
            <div class="quick-questions mt-2" id="quickQuestionsContainer"></div>
          </div>
        </div>

        <!-- Input Footer -->
        <div class="chatbot-footer">
          <form id="chatbotForm" class="d-flex gap-2">
            <input type="text" id="chatbotInput" class="form-control form-control-sm search-input-box" 
                   placeholder="Ask about categories, events, bookmarks..." autocomplete="off">
            <button type="submit" class="btn btn-sm btn-brand px-3">
              <i class="bi bi-send-fill"></i>
            </button>
          </form>
        </div>
      </div>
    `;

    document.body.appendChild(wrapper);
    this.renderQuickQuestions();
  },

  renderQuickQuestions() {
    const container = document.getElementById("quickQuestionsContainer");
    if (!container) return;

    container.innerHTML = "";
    Object.keys(this.faqData).forEach(q => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "quick-btn";
      btn.textContent = q;
      btn.addEventListener("click", () => {
        this.handleUserQuestion(q, this.faqData[q]);
      });
      container.appendChild(btn);
    });
  },

  bindEvents() {
    const toggleBtn = document.getElementById("chatbotToggleBtn");
    const closeBtn = document.getElementById("chatbotCloseBtn");
    const container = document.getElementById("chatbotContainer");
    const form = document.getElementById("chatbotForm");
    const input = document.getElementById("chatbotInput");

    if (toggleBtn && container) {
      toggleBtn.addEventListener("click", () => {
        container.classList.toggle("active");
        if (container.classList.contains("active") && input) {
          input.focus();
        }
      });
    }

    if (closeBtn && container) {
      closeBtn.addEventListener("click", () => {
        container.classList.remove("active");
      });
    }

    if (form && input) {
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const text = input.value.trim();
        if (!text) return;
        input.value = "";
        this.processUserInput(text);
      });
    }
  },

  handleUserQuestion(question, answer) {
    this.appendMessage(question, "user");
    setTimeout(() => {
      this.appendMessage(answer, "bot");
    }, 250);
  },

  processUserInput(text) {
    this.appendMessage(text, "user");

    const lower = text.toLowerCase();
    let reply = "";

    // 1. Direct match with FAQ
    for (const [q, a] of Object.entries(this.faqData)) {
      if (lower.includes(q.toLowerCase())) {
        reply = a;
        break;
      }
    }

    // 2. Keyword match
    if (!reply) {
      for (const rule of this.keywordRules) {
        if (rule.keywords.some(k => lower.includes(k))) {
          reply = rule.answer;
          break;
        }
      }
    }

    // 3. Fallback
    if (!reply) {
      reply = this.fallbackAnswer;
    }

    setTimeout(() => {
      this.appendMessage(reply, "bot");
    }, 300);
  },

  appendMessage(text, sender) {
    const body = document.getElementById("chatbotBody");
    if (!body) return;

    const bubble = document.createElement("div");
    bubble.className = `chat-bubble ${sender}`;
    bubble.textContent = text;
    body.appendChild(bubble);

    // Auto-scroll to bottom
    body.scrollTop = body.scrollHeight;
  }
};

// Initialize chatbot when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  FanHelperBot.init();
});
