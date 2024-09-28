/*Thay đổi số lượng sản phẩm trong giỏ hàng*/

$(document).ready(function() {
    $('.tbody-cart input[type="number"]').change(function() {
        var idProduct = $(this).attr('name').replace('quantity[', '').replace(']', '');
        var newQuantity = $(this).val();

        $.ajax({
            url: 'cart.php',
            method: 'POST',
            data: {
                id_product: idProduct,
                new_quantity: newQuantity
            },
            success: function(response) {
                location.reload();
            }
        });
    });
});


/*Hủy đơn hàng*/

$(document).ready(function() {
  $('.cancel-order-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const donhang = $(this).closest('tr').find('td').eq(0);

    if (donhang.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn hủy đơn hàng "${donhang.text()}" không?`
      );
    }

    $('#cancel-confirm').modal('show'); // Hiển thị modal

    $('#cancel-confirm').on('click', '#cancel', function() {
      form.submit(); // Nếu nhấn nút Đồng ý, submit form
    });

    
  });
});

//Xóa sản phẩm
$(document).ready(function() {
  $('.delete-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const sanpham = $(this).closest('tr').find('td').eq(1);

    if (sanpham.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa "${sanpham.text()}" không?`
      );
    }

    $('#delete-confirm').modal('show'); // Hiển thị modal

    $('#delete-confirm').on('click', '#delete', function() {
      form.submit();
    });

  });
});

//Thêm và sửa sản phẩm
// hiện hình ảnh
$(document).ready(function() {
    const imgInput = $('#img');
    const previewimg = $('#product-preview');

    imgInput.change(function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {

                const imgDataURL = reader.result;
                previewimg.attr('src', imgDataURL);
                previewimg.show();
            };
        }
    });
});