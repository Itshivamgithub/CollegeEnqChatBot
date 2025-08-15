document.addEventListener('DOMContentLoaded', () => {
    const chatContainer = document.getElementById('chat');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');

    // Add message to chat
    function addMessage(text, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        contentDiv.textContent = text;
        
        messageDiv.appendChild(contentDiv);
        chatContainer.appendChild(messageDiv);
        
        // Auto-scroll to bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Handle message sending
    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        addMessage(message, true);
        userInput.value = '';

        try {
            const response = await fetch('../chatbot_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `message=${encodeURIComponent(message)}`
            });
            
            const data = await response.json();
            addMessage(data.response, false);
            
        } catch (error) {
            addMessage("Sorry, I'm having trouble connecting.", false);
            console.error('Error:', error);
        }
    }

    // Event Listeners
    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
});