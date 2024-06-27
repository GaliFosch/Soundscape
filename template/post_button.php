<?php if(checkLogin($dbh)): ?>
    <button id="post-button" type="button">
        <em class="fa-solid fa-pencil post-creation"></em>
        <strong id="post-button-text">Create a post</strong>
    </button>
    <script src="js/post_button.js"></script>
<?php endif; ?>
