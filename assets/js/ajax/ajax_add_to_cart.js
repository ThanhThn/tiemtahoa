let loading = '<span class="loader"></span>';
var notyf = new Notyf({
  duration: 1000,
  position: {x: 'center', y: 'top' },
}
);
$(document).on('click', '.single_add_to_cart_button', function(e) {
    e.preventDefault();
    $thisButton = $(this),
    $form = $thisButton.closest('form.cart'),
    id = $thisButton.val(),
    product_qty = $form.find('input[name=quantity]').val() || 1,
    product_id = $form.find('input[name=product_id]').val() || id,
    variation_id = $form.find('input[name=variation_id]').val() || 0;
    var data = {
        action: 'product_add',
        product_id: product_id,
        product_sku: '',
        quantity: product_qty,
        variation_id: variation_id,
    };
    let productContainer = $('.cart_container');
    productContainer.append(`<div class ="loading">${loading}</div>`)
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: siteConfig.ajaxUrl ,
        data: data,
        success: function (response) { 
            if(!response || response.error){
                return;
              } 
              notyf.success({
                message:"Sản phẩm đã được thêm vào giỏ hàng"
              })
              var fragments = response.fragments;
              if(fragments){
                $.each(fragments, function(key, value){
                  $(key).replaceWith(value);
                })
              }
              productContainer.html('')
              productContainer.append(response.fragments.widget_shopping_cart_content);
        }, 
    }); 
 }); 