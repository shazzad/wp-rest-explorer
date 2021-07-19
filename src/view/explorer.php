<div class="wpre-rest-explorer">
    <div class="wpre-header">
        <?php if ( ! empty( $args['title'] ) ) : ?>
            <div class="wpre-title"><?php echo $args['title']; ?></div>
        <?php endif; ?>
        <div class="wpre-subtitle"><?php echo $api_url; ?></div>
    </div>
    <div class="wpre-body">
        <?php include dirname( __FILE__ ) . '/routes.php'; ?>
        <?php include dirname( __FILE__ ) . '/docs.php'; ?>
    </div>
    <?php include dirname( __FILE__ ) . '/footer.php'; ?>
</div>