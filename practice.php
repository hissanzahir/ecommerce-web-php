<form onsubmit="return validateForm()">
    <input type="email" id="email" required>
    <input type="password" id="password" required>
    <button type="submit">Sign Up</button>
</form>
<script>
    function validateForm() {
        let password = document.getElementById('password').value;
        if (password.length < 6) {
            alert('Password must be at least 6 characters');
            return false;
        }
        return true;
    }
</script>