define(['vendor/domready', 'jquery'], function(domReady, $) {

    var module = {

        ajaxCall: function(action, ajaxData, responseFunction) {

            ajaxData.action = action;

            $.ajax({

                type: 'POST',
                data: ajaxData

            }).done(function(response) {

                var data = response;

                responseFunction(data);

            }).fail(function(xhr, ajaxOptions, thrownError) {

                console.log(thrownError);

            });

        }
    };
    return module;
});