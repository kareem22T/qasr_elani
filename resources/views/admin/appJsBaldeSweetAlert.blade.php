<script>
    $('document').ready(function () {
        $('#myTable').on('click', 'a.conf', function (e) {
            runConf($(this), e, 'c');
        });

        $('input.conf').click(function (e) {
            runConf($(this), e, 'v', hasAttr('justStatus'));
        });

        $('a.delete').click(function (e) {
            runConf($(this), e, 'c');
        });

        function runConf($thisItm, e, type) {

            // Now You Can Add Multi Colors For Btn Confirm xD: ^&^
            var myArray = shuffle(['#519e57', 'e85423', '#000', '#999']);

            // e    param => event
            // type param => type source c from controller has h-ref v view from index

            e.preventDefault();
            $ifTherejustChangeStatus = $thisItm.data("val");
            $txt = (!$ifTherejustChangeStatus == true) ? "{{trans('sweet.txt')}}" : '';
            $msg = ($ifTherejustChangeStatus == true) ? "{{trans('sweet.msgForStatus') }}" : "{{trans('sweet.msg') }}";
            $confMsg = ($ifTherejustChangeStatus == true) ? "{{trans('sweet.confMsgForStatus')}}" : "{{trans('sweet.confMsg')}}";

            $cancMsg = "{{trans('sweet.cancMsg')}}";

            $href = $thisItm.attr('href');
            var x = swal({
                    title: $msg,
                    text: $txt,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: myArray[0], /*e85423*/
                    confirmButtonText: $confMsg,
                    cancelButtonText: $cancMsg,
                    closeOnConfirm: false,
                    animation: true
                },

                function (isConfirm) {
                    if (isConfirm) {
                        if (type == 'v')
                            $($thisItm).parent('form').submit();
                        else
                            window.location.href = $href;
                    } else
                        swal("Cancelled", "OK", "error");

                });

        }

        // Shuffle My Array
        function shuffle(array) {
            let counter = array.length;

            // While there are elements in the array
            while (counter > 0) {
                // Pick a random index
                let index = Math.floor(Math.random() * counter);

                // Decrease counter by 1
                counter--;

                // And swap the last element with it
                let temp = array[counter];
                array[counter] = array[index];
                array[index] = temp;
            }

            return array;
        }

    });
</script>
