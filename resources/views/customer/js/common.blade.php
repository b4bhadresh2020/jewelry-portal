<script>
    $(document).ready(function () {
        if($('#address-country').length > 0){
            $('#address-country').on('change', function () {
                if($(this).attr('data-ajax')  == "true"){
                    var country_id = this.value;
                    $("#state-dropdown").html('Loading...');
                    $.ajax({
                        url: "{{__url('states-by-country')}}",
                        type: "POST",
                        data: {
                            country_id: country_id,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#address-state').html('<option value="">Select a state...</option>');
                            $.each(result.states, function (key, value) {
                                $("#address-state").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $('#address-city').html('<option value="">Select State First</option>');
                        }
                    });
                }
            });
        }

        if($('#address-state').length > 0){
            $('#address-state').on('change', function () {
                if($(this).attr('data-ajax')  == "true"){
                    var state_id = this.value;
                    $("#city-dropdown").html('Loading...');
                    $.ajax({
                        url: "{{__url('cities-by-state')}}",
                        type: "POST",
                        data: {
                            state_id: state_id,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#address-city').html('<option value="">Select a city...</option>');
                            $.each(result.cities, function (key, value) {
                                $("#address-city").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        }

        $("#newsletter-submit-button").click(function(e){
            e.preventDefault();
            let formData = new FormData(document.getElementById("newsletter-form"));
            $.ajax({
                url: "{{__url('subscribe')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (result) {
                    $("#newsletter-form").trigger('reset');
                    toastr.success("Subscribe Successfully.");
                }
            });
        });
    });
</script>
