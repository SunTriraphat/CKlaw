<script>
  $(document).ready(function() {
    $(".SearchCredoScore").click(function(ev){
      var Credo_Code = $('#Credo_Code').val();
      var IdTag = $('.IdTag').val();
      var Flagpage = $(this).data('page');
      var type = 3;
      var _token = $('input[name="_token"]').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url:"{{ route('ControlCenter.SearchData') }}",
        method:"POST",
        data:{type:type,Credo_Code:Credo_Code,IdTag:IdTag,Flagpage:Flagpage,_token:_token},

        success:function(data){
          $(".Credo_Score").val(data);
          if (data != '') {
            var icons = 'success';
            var texts = 'เชื่อมต่อสำเร็จ';

            if (data != 0) {
              $('.SearchCredoScore').addClass('btn-outline-success');
              $('.CredoStatus').val('ลงสำเร็จ');
            }else{
              $('.SearchCredoScore').removeClass('btn-outline-warning');
            }
          }else{
            var icons = 'warning';
            var texts = 'เชื่อมต่อล้มเหลว';
          }

          Swal.fire({
            icon: icons,
            title: texts,
            text: "โปรดระบุสถานะ Credo ต่อไปนี้ !",
            input: 'select',
            inputOptions: {
              'CD-0001': '(CD-0001) - ใช้ IOS',
              'CD-0002': '(CD-0002) - ลงโปรแกรมไม่ได้',
              'CD-0003': '(CD-0003) - สัญญาณของ Credo',
              'CD-0004': '(CD-0004) - ใช้ Huawei',
              'CD-0005': '(CD-0005) - ลงสำเร็จ',
              'CD-0006': '(CD-0006) - ไม่ได้ใช้เลข Credo'
            },
            inputPlaceholder: 'Select Status',
            showCancelButton: false,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value != '') {
                  var type = 8;
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });

                  $.ajax({
                    url:"{{ route('ControlCenter.SearchData') }}",
                    method:"POST",
                    data:{type:type,IdTag:IdTag,value:value},

                    success:function(data){
                      $('.CredoStatus').val(data);
                    }
                  })

                  resolve()
                  $(".btn_Calculates").prop("disabled",false);
                } else {
                  resolve('กรุณาเลือกสถานะข้างต้น :)')
                }
              })
            }
          })


        }
      })

      // Swal.fire({
      //   icon: 'warning',
      //   title: 'โปรดระบุสถานะ Credo ต่อไปนี้ !',
      //   text: "โปรดระบุสถานะ Credo ต่อไปนี้ !",
      //   input: 'select',
      //   inputOptions: {
      //     'CD-0001': 'ใช้ IOS',
      //     'CD-0002': 'ลงโปรแกรมไม่ได้',
      //     'CD-0003': 'สัญญาณของ Credo',
      //     'CD-0004': 'ใช้ Huawei',
      //     'CD-0005': 'ลงสำเร็จ',
      //     'CD-0006': 'ไม่ได้ใช้เลข Credo'
      //   },
      //   inputPlaceholder: 'Select Status',
      //   showCancelButton: true,
      //   inputValidator: (value) => {
      //     return new Promise((resolve) => {
      //       if (value != '') {
      //         resolve()

      //       } else {
      //         resolve('กรุณาเลือกสถานะข้างต้น :)')
      //       }
      //     })
      //   }
      // })

      // $.ajax({
      //   url:"{{ route('ControlCenter.SearchData') }}",
      //   method:"POST",
      //   data:{type:type,Credo_Code:Credo_Code,IdTag:IdTag,Flagpage:Flagpage,_token:_token},

      //   success:function(data){
      //     $(".Credo_Score").val(data);
      //     if (data != '') {
      //       swal({
      //         icon: "success",
      //         title: "เชื่อมต่อสำเร็จ",
      //         text: "การเชื่อม Credo สำเร็จ.",
      //         buttons: false,
      //         timer: 2000
      //       });

      //       if (data != 0) {
      //         $('.tagPart_SearchCredo').addClass('btn-outline-success');
      //       }else{
      //         $('#tagPart_SearchCredo').removeClass('btn-outline-warning');
      //       }
      //     }else{
      //       swal({
      //         closeOnClickOutside: false,
      //         icon: "warning",
      //         title: "เชื่อมต่อล้มเหลว",
      //         text: "การเชื่อมต่อล้มเหลว หรืออาจเกินจากอุปกรณ์ไม่รองรับ.",
      //       });
      //     }
      //   }
      // })
    });
  });
</script>