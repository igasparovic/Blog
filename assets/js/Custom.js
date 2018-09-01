(function($) {

    //Avatar label update
        $('#file').on('change', function (e) {
            var $input = $(this),
                $label = $input.next('label'),
                labelVal = $label.html();

            var fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });

})(jQuery);