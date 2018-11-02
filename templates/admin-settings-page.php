<div class="wrap">
    <h1>Settings</h1>
    <?php settings_errors(); ?>

    <form method="POST" action="options.php">
        <?php
            settings_fields( 'job_listing_option_group' );
            do_settings_sections( 'rcit_job_listings' );
            submit_button();
        ?>
    </form>
</div>