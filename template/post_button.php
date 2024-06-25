<?php if(isset($_SESSION['username'])): ?>
    <a href="post_creation.php" class="post-button-a">
        <button id="post-button" type="button">
            <em class="fa-solid fa-pencil post-creation"></em>
        </button>
    </a>
    <script src="js/post_button.js"></script>
<?php endif; ?>
