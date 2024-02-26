//Main
$(document).ready(function () {
  //Show Search
  let iconSearch = $(".heading nav li.search");
  let formSearch = $(".form_search");
  iconSearch.click(() => {
    if (parseFloat(formSearch.css("top")) < 0) {
      formSearch.css({
        top: "140%",
      });
    } else
      formSearch.css({
        top: "-100%",
      });
  });
  $(window).scroll(() => {
    formSearch.css({
      top: "-100%",
    });
  });
});
//Home
$(document).ready(
  (function () {
    //Sliders
    let list = $(".list-top");
    let items = $(".list-top .item");
    let dots = $(".dots li");
    let prev = $("#prevBtn");
    let next = $("#nextBtn");
    let active = 0;
    let lengthItems = items.length - 1;
    let refreshSlide = setInterval(() => {
      next.click();
    }, 2000);
    const reloadSlider = () => {
      let checkLeft = items[active].offsetLeft;
      list.css("left", `-${checkLeft}px`);
      let lastActive = $(".dots li.active-dot");
      lastActive.removeClass("active-dot");
      $(dots[active]).addClass("active-dot");
      clearInterval(refreshSlide);
      refreshSlide = setInterval(() => {
        next.click();
      }, 2000);
    };
    next.click(() => {
      if (active + 1 > lengthItems) active = 0;
      else active++;
      reloadSlider();
    });
    prev.click(() => {
      if (active - 1 < 0) active = lengthItems;
      else active--;
      reloadSlider();
    });

    dots.each((index, dot) => {
      $(dot).click(() => {
        active = index;
        reloadSlider();
      });
    });
  })(jQuery)
);

//Product
$(document).ready(function () {
  //Show/Hide description product
  let rotate = 0;
  $(".description_heading").click(function () {
    $(this)
      .children("svg")
      .css("transform", `rotate(${(rotate += 180)}deg)`);
    $(".description_container .description").slideToggle();
  });
  //Input quantity product
  let btnDecrease = $(".quantity button:first-child");
  let btnIncrease = $(".quantity button:last-child");
  let inputQuantity = $(".quantity input");
  let quantity = parseInt(inputQuantity.val());
  btnIncrease.click(() => {
    quantity++;
    inputQuantity.val(quantity);
  });
  btnDecrease.click(() => {
    quantity--;
    if (quantity < 1) quantity = 1;
    inputQuantity.val(quantity);
  });

  //Show Img Product
  let img_show = $(".detail_product img");
  let img_product = $(".img_detail .activated img").attr("src");
  let img_products = $(".img_detail img").toArray(); // hoặc $(".img_detail img").get();
  $(".img_detail > div").click(function () {
    $(".img_detail > div").removeClass("activated");
    $(this).addClass("activated");
    img_product = $(this).children("img").attr("src");
    img_show.attr("src", newSrc);
  });
  $(".img_detail > div").mouseenter(function () {
    img_show.attr("src", $(this).children("img").attr("src"));
    $(".img_detail > div").addClass("hover");
    $(this).removeClass("hover");
  });
  $(".img_detail > div").mouseleave(function () {
    img_show.attr("src", img_product);
    $(".img_detail > div").removeClass("hover");
  });
});

//Cart
(function ($) {
  let mini_cart = $("div.cart");
  let mini_cart_box = $("div.cart .cart_container");
  mini_cart.css("height", `calc(100vh - ${$("header").css("height")})`);
  $(".heading nav li.mini_cart").click(() => {
    $(mini_cart).toggle();
  });
  // $(document).click((e) =>{
  //   if(mini_cart.css("display") != "none"){
  //     if(!mini_cart_box.is(e.target) && !$(".icon_cart").is(e.target)) $(mini_cart).toggle();
  //   }
  // })
})(jQuery);
