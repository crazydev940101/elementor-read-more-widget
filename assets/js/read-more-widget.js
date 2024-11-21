jQuery(document).ready(function($) {
    $('.read-more-toggle').click(function(e) {
        e.preventDefault();
        var $container = $(this).closest('.read-more-container');
        var $longContent = $container.find('.long-content');
        var $toggleButton = $(this);
        var readMoreText = $toggleButton.data('read-more');
        var readLessText = $toggleButton.data('read-less');

        if ($longContent.is(':visible')) {
            $longContent.slideUp();
            $toggleButton.text(readMoreText);
        } else {
            $longContent.slideDown();
            $toggleButton.text(readLessText);
        }
    });
});