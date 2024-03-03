// (function ($) {
//   class LoadMore {
//     constructor() {
//       this.ajaxUrl = siteConfig?.ajaxUrl ?? "";
//       this.ajaxNonce = siteConfig?.ajax_nonce ?? "";
//     }
//     handleLoadMorePosts(params) {
//       $.ajax({
//         url: this.ajaxUrl,
//         type: "post",
//         data:{
//             ajax_nonce: this.ajaxNonce
//         },
//         success: (response) => {

//         },
//         error: (response) =>{

//         }
//       });
//     }
//   }
// });

$(document).ready(function ($) {
  // Bạn có thể muốn kiểm tra xem phần tử .page-numbers và .page-number có tồn tại hay không trước khi thao tác
  // let pageNumbers = $(".page-numbers .page-number");
  // let pageNext = $(".prev-next-links .next");
  // let pagePrev =  $(".prev-next-links .prev");

  // function productPage(page){
  //   $.ajax({
  //     url: siteConfig.ajaxUrl,
  //     type: "post",
  //     data: {
  //       action: "pagination",
  //       nonce: siteConfig.ajax_nonce,
  //       page: page,
  //     },
  //     success: function (response) {
  //       if (response) {
  //         $('.products').html("");
  //         $(".products").append(response);
  //         page++;
  //       }
  //     },
  //   });
  // }
  // pageNext.click(function(){
  //   currentPage = pageNumbers.filter(".current");
  //   currentPage.removeClass("current");
  //   currentPage.next().addClass("current")
  //   productPage(+currentPage.text() + 1 )

  // })
  // pageNumbers.click(function () {
  //   pageNumbers.removeClass("current");
  //   $(this).addClass("current");
  //   productPage($(this).text());
  // });


    // Popup Product
    const popUpContainer = $(".popup_container");
    const btnView = $(".product_card .product button");
    const loading = '<span class="loader"></span>';
    let popUpProduct = "";
    
    function showPopupProduct(id) {
      popUpContainer.html("");
      popUpContainer.append(loading);
      popUpContainer.show();
    
      $.ajax({
        url: siteConfig.ajaxUrl,
        type: "post",
        data: {
          action: "quickView",
          id: id,
        },
        success: function (response) {
          if (response) {
            popUpContainer.show();
            const waitForTimeout = () => {
              return new Promise(resolve => {
                  setTimeout(() => {
                      resolve();
                  }, 500);
              });
          };
          waitForTimeout().then(() => {
              popUpContainer.html("");
              popUpContainer.html(response);
              updatePopupProductThumbnailHeight();
              popUpProduct = $(".popup_product");
              $(document).off("click").on("click", handleDocumentClick);
          });
          }
        },
      });
    }
    
    btnView.click(function (e) {
      e.preventDefault();
      const id = $(this).parents("li").attr("product_id");
      showPopupProduct(id);
    });
    
    function handleDocumentClick(event) {
      if (popUpContainer.is(":visible")) {
        if (!popUpProduct.is(event.target) && popUpProduct.has(event.target).length === 0) {
          popUpContainer.hide();
        }
      }
    }
    
    function updatePopupProductThumbnailHeight() {
      $(".popup_product-thumbnail").height($(".popup_product").height());
    }
    popUpContainer.on("click", ".popup_product .close", function () {
      popUpContainer.hide();
  });
  
    //Delete product in the cart
    $('.cart_container').on('click', '.mini_cart_item button.remove_button',function(e){
      e.preventDefault();
      let productId = $(this).attr('data-product_id');
      let cartItemKey = $(this).attr('data-cart_item_key');
      let productContainer = $(this).parents('.cart_container');
      productContainer.append(`<div class ="loading">${loading}</div>`)
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: siteConfig.ajaxUrl,
        data:{
          action: "product_remove",
          product_id: productId,
          cart_item_key: cartItemKey
        },
        success: function(response){
          if(!response || response.error){
            return;
          }
          var fragments = response.fragments;
          if(fragments){
            $.each(fragments, function(key, value){
              $(key).replaceWith(value);
            })
          }
          productContainer.html('')
          productContainer.append(response.fragments.widget_shopping_cart_content);
        }
      })
    })



    // Sự kiện của document
});




