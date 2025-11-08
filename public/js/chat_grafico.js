function toggleChat() {
  const chatBox = document.getElementById('chat-box');
  const chatToggle = document.getElementById('chat-toggle');

  const isHidden = chatBox.classList.contains('d-none');

  chatBox.classList.toggle('d-none', !isHidden);
  chatToggle.classList.toggle('d-none', isHidden);
}
