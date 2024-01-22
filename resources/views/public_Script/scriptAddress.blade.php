{{-- <script>
  $(function () {
    $('[data-mask]').inputmask()
  });
</script> --}}

{{-- ที่อยู่ --}}
<script>
    $(function() {

        // 

        $('.houseZone').change(function() { //เลือกภาค
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 1;
                var Flag = 1;
                var _token = $('input[name="_token"]').val();

                $('.houseProvince,.houseDistrict,.houseTambon').empty();
                $('.houseProvince').append($('<option/>').attr("selected", "").val('').text(
                    "--- จังหวัด ---"));
                $('.houseDistrict').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));
                $(".Postal").val('');

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseProvince').append($('<option/>').attr("value", result
                                .Province_pro).text(result.Province_pro));
                        }
                    }
                })
            }
        });
        $('.houseProvince').change(function() { //เลือกจังหวัด
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 1;
                var Flag = 2;
                var _token = $('input[name="_token"]').val();

                $('.houseDistrict,.houseTambon').empty();
                $('.Postal').val('');
                $('.houseDistrict').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseDistrict').append($('<option/>').attr("value", result
                                .District_pro).text(result.District_pro));
                        }
                    }
                })
            }
        });
        $('.houseDistrict').change(function() { //เลือกอำเภอ
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 1;
                var Flag = 3;
                var _token = $('input[name="_token"]').val();

                $('.houseTambon').empty();
                $('.Postal').val('');
                $('.houseTambon').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseTambon').append($('<option/>').attr("value", result
                                .Tambon_pro).text(result.Tambon_pro));
                        }
                    }
                })
            }
        });
        $('.houseTambon').change(function() { //เลือกตำบล
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 1;
                var Flag = 4;
                var Province = $('.houseProvince').val();
                var District = $('.houseDistrict').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        Province: Province,
                        District: District,
                        _token: _token
                    },

                    success: function(data) {
                        $('.Postal').val(data.Postcode_pro);
                        $(document).trigger(
                        'postal-class-update'); // ***** ส่งทริกเกอร์ว่าโหลดเสร็จแล้ว *****
                    }
                })
            }
        });


        $('.houseZone1').change(function() { //เลือกภาค
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 2;
                var Flag = 1;
                var _token = $('input[name="_token"]').val();

                $('.houseProvince1,.houseDistrict1,.houseTambon1').empty();
                $('.houseProvince1').append($('<option/>').attr("selected", "").val('').text(
                    "--- จังหวัด ---"));
                $('.houseDistrict1').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon1').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));
                $(".Postal1").val('');

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseProvince1').append($('<option/>').attr("value", result
                                .Province_pro).text(result.Province_pro));
                        }
                    }
                })
            }
        });
        $('.houseProvince1').change(function() { //เลือกจังหวัด
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 2;
                var Flag = 2;
                var _token = $('input[name="_token"]').val();

                $('.houseDistrict1,.houseTambon1').empty();
                $('.Postal1').val('');
                $('.houseDistrict1').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon1').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseDistrict1').append($('<option/>').attr("value", result
                                .District_pro).text(result.District_pro));
                        }
                    }
                })
            }
        });
        $('.houseDistrict1').change(function() { //เลือกอำเภอ
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 2;
                var Flag = 3;
                var _token = $('input[name="_token"]').val();

                $('.houseTambon1').empty();
                $('.Postal1').val('');
                $('.houseTambon1').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseTambon1').append($('<option/>').attr("value", result
                                .Tambon_pro).text(result.Tambon_pro));
                        }
                    }
                })
            }
        });
        $('.houseTambon1').change(function() { //เลือกตำบล
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 2;
                var Flag = 4;
                var Province = $('.houseProvince1').val();
                var District = $('.houseDistrict1').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        Province: Province,
                        District: District,
                        _token: _token
                    },

                    success: function(data) {
                        $('.Postal1').val(data.Postcode_pro);
                        $(document).trigger(
                        'postal-class-update'); // ***** ส่งทริกเกอร์ว่าโหลดเสร็จแล้ว *****
                    }
                })
            }
        });

        $('.houseZone2').change(function() { //เลือกภาค
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 3;
                var Flag = 1;
                var _token = $('input[name="_token"]').val();

                $('.houseProvince2,.houseDistrict2,.houseTambon2').empty();
                $('.houseProvince2').append($('<option/>').attr("selected", "").val('').text(
                    "--- จังหวัด ---"));
                $('.houseDistrict2').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon2').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));
                $(".Postal2").val('');

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseProvince2').append($('<option/>').attr("value", result
                                .Province_pro).text(result.Province_pro));
                        }
                    }
                })
            }
        });
        $('.houseProvince2').change(function() { //เลือกจังหวัด
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 3;
                var Flag = 2;
                var _token = $('input[name="_token"]').val();

                $('.houseDistrict2,.houseTambon2').empty();
                $('.Postal2').val('');
                $('.houseDistrict2').append($('<option/>').attr("selected", "").val('').text(
                    "--- อำเภอ ---"));
                $('.houseTambon2').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseDistrict2').append($('<option/>').attr("value", result
                                .District_pro).text(result.District_pro));
                        }
                    }
                })
            }
        });
        $('.houseDistrict2').change(function() { //เลือกอำเภอ
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 3;
                var Flag = 3;
                var _token = $('input[name="_token"]').val();

                $('.houseTambon2').empty();
                $('.Postal2').val('');
                $('.houseTambon2').append($('<option/>').attr("selected", "").val('').text(
                    "--- ตำบล ---"));

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        _token: _token
                    },

                    success: function(data) {
                        for (var i = 0, len = data.length; i < len; ++i) {
                            var result = data[i];
                            $('.houseTambon2').append($('<option/>').attr("value", result
                                .Tambon_pro).text(result.Tambon_pro));
                        }
                    }
                })
            }
        });
        $('.houseTambon2').change(function() { //เลือกตำบล
            if ($(this).val() != '') {
                var value = $(this).val();
                var type = 3;
                var Flag = 4;
                var Province = $('.houseProvince2').val();
                var District = $('.houseDistrict2').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('Cus.SearchData') }}",
                    method: "POST",
                    data: {
                        type: type,
                        Flag: Flag,
                        value: value,
                        Province: Province,
                        District: District,
                        _token: _token
                    },

                    success: function(data) {
                        $('.Postal2').val(data.Postcode_pro);
                        $(document).trigger(
                        'postal-class-update'); // ***** ส่งทริกเกอร์ว่าโหลดเสร็จแล้ว *****
                    }
                })
            }
        });


    })
</script>
