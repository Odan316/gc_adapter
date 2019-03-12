$(document).ready(function () {
    $(document).on('click', '.addJcGroup', function () {
        var count = $('.jcTable tbody tr').length;
        var $row = $('.exampleRow tr').clone();

        var $jcInput = $row.find('.jcField');
        $jcInput.attr('name', $jcInput.attr('name') + '[' + count + ']');
        var $gcInput = $row.find('.gcField');
        $gcInput.attr('name', $gcInput.attr('name') + '[' + count + '][]');
        $row.find('.num').text(count);

        $('.jcTable tbody')
            .append($row);
    });

    $(document).on('click', '.addGcGroup', function () {
        var $formGroup = $('.exampleGroup div').clone();
        $formGroup
            .find('input')
            .attr('name', $(this)
                .parents('tr')
                .find('.gcField').attr('name'));
        $(this)
            .parents('tr')
            .find('.inputsGroup')
            .append($formGroup);
    });
});