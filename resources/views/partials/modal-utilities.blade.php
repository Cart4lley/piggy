<!-- Modal Utilities Script -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.add('show');
    
    // Initialize modal-specific setup
    if (modalId === 'sendMoneyModal') {
        setupSendMoneyForm();
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
    
    // Reset modal-specific forms
    if (modalId === 'sendMoneyModal') {
        resetSendMoneyForm();
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('show');
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => modal.classList.remove('show'));
    }
});
</script>
