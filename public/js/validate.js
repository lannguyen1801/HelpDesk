$.validator.addMethod("dateFormat",
    function(value, element) {
        return value.match(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
    },
    "Nhập đúng định dạng dd-mm-yyyy.");
$(function(){
  $("#formadd").validate({
    rules :{
      ma_nhan_vien:{
        required :true,
        remote : 'checkid.php'
      },
      ten_nhan_vien:{
        required :true
      },
      email :{
        email:true,
        required: true,
      },
      ngaysinh :{
        dateFormat:true
      },
      user :{
        required:true,
        remote : 'checkuser.php'
      },
      pass :{
        required:true,
        minlength: 3
      },
      repass :{
         equalTo: "#pass"
      }
    }, messages :{
        ma_nhan_vien : {
          remote : "Mã nhân viên bị trùng",
          required: "Không được bỏ trống",
        },ten_nhan_vien :{
          required:"Không được bỏ trống",
        },
        email:{
          email: "Nhập sai định dạng",
          required: "Đây là trường bắt buộc"
        },
        user:{
          required: "Không được bỏ trống",
          remote : "Tài khoản bị trùng",
        },
        pass:{
            required :"Băt buộc nhập mật khẩu",
            minlength : "Mật khẩu tối thiểu 6 ký tự",
        },
        repass:{
          equalTo:"Nhập lại mật khẩu sai"
        }
    }
  });
});
